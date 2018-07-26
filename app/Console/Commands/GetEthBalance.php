<?php

namespace App\Console\Commands;

use App\Http\Controllers\SendMailController;
use DB;
use Exception;
use Illuminate\Console\Command;

class GetEthBalance extends Command {
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'GetEthBalance:getethbalance';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'GetEthBalance Balance Call API';
	protected $user_email_template_id = 3;
	protected $admin_email_template_id = 5;
	protected $user_success_email_template_id = 6;
	protected $admin_success_email_template_id = 7;
	protected $developer_email_template_id = 9;
	protected $settings;
	protected $currency = 'ETH';
	protected $pricesInUSD;
	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct() {
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function handle() {
		$insertData = array();
		$insertData['cron_title'] = 'GetEthBalance';
		$insertData['cron_date'] = date('Y-m-d H:i:s');
		$insertData['status'] = 1;
		$date = date('Y-m-d H:i:s');

		$this->pricesInUSD = $this->getUSDPrices();
		$this->settings = DB::table('settings')->first();

		$block_data = DB::table('block_data')->where('currency', $this->currency)->first();
		$last_block = $block_data->block_number;
		$last_block++;
		$latest_block = hexdec(substr($this->getLatestBlockHeight(), 2));
		echo "Current latest Block" . $latest_block;

		$ethMonitoringAddresses = DB::table('monitorings')->where('currency_type', $this->currency)->where('status', 1)->orderBy('other')->get();
		DB::beginTransaction();
		$ethAddresses = array();
		try {
			$date = date('Y-m-d H:i:s');
			foreach ($ethMonitoringAddresses as $monitoringAddress) {
				$ethAddresses[$monitoringAddress->address] = $monitoringAddress;
			}
			$params = ["jsonrpc" => "2.0", "method" => "eth_getBlockByNumber", "params" => array("0x5a156f", true), "id" => 1];
			$addressOnly = array_keys($ethAddresses);
			for ($i = $last_block, $j = 1; $i < ($latest_block - 3) && $j < 5; $j++, $i++) {
				echo $i . " is loop counter";
				$params["params"][0] = '0x' . dechex($i);
				$currentBlock = json_decode($this->callRPC($params), 1);
				$blockTransactions = $currentBlock["result"]["transactions"];

				if (count($blockTransactions) > 0) {
					DB::table('cron_logs')->insert(array('cron_title' => 'GetEthBalance' . $i, 'cron_date' => $date, 'status' => 1));
				}

				foreach ($blockTransactions as $tx) {
					$transaction_amount = hexdec(substr($tx["value"], 2));
					if ($transaction_amount > 0) {
						$transaction_amount = ($transaction_amount / 1000000000000000000);
						if (in_array($tx["to"], $addressOnly)) {
							if (($transaction_amount - $ethAddresses[$tx["to"]]->last_balance) > 0) {
								$this->handleTransaction($tx["value"], $ethAddresses[$tx["to"]]);
							}
						}
					}
				}
			}
			DB::table('block_data')->where('id', 2)->update(['block_number' => $i]);
			DB::commit();
		} catch (Exception $e) {
			DB::rollback();
			$mailParams = array();
			$mailParams['filename'] = 'GetEthBalance.php';
			$mailParams['module'] = 'Handle method of Eth cron';
			$mailParams['title'] = 'Cron job failed in Ether auto transaction detection with handle method - Transaction will be rollbacked';
			echo $mailParams['description'] = $e->getMessage();
			$this->sendMail($mailParams, $this->developer_email_template_id);
		}
	}

	public function handleTransaction($amount, $monitoringAddress) {
		$old_balance = $monitoringAddress->last_balance;
		echo "welcome to handleTransaction";
		exit;
		if ($amount > 0) {
			if ($this->CheckAndValidateForLowAndUpBounds($amount) == 1) {
				echo "allocateToken will be called";
				$this->allocateToken($monitoringAddress->user_id, ($amount - $old_balance), $monitoringAddress->address, 'xxx');
			} else if ($this->CheckAndValidateForLowAndUpBounds($amount) == 2) {
				$this->storeInvalidTransaction($monitoringAddress->user_id, $monitoringAddress->address, ($amount - $old_balance), $this->currency, 0, $date);
			} else if ($this->CheckAndValidateForLowAndUpBounds($amount) == 0) {
				$this->storeInvalidTransaction($monitoringAddress->user_id, $monitoringAddress->address, ($amount - $old_balance), $this->currency, 0, $date);
			}
			DB::table('monitorings')->where('address', $monitoringAddress->address)->update(['last_balance' => $amount, 'other' => $monitoringAddress->other + 1]);
		}
	}

	public function getLatestBlockHeight() {
		$endpoint = 'http://5.101.139.166:8081/getLatestBlockHeight';
		$result = json_decode(file_get_contents($endpoint), 1);
		return $result["height"];
	}

	public function is_multi($a) {
		$rv = array_filter($a, 'is_array');
		if (count($rv) > 0) {
			return true;
		}
		return false;
	}

	public function getUSDPrices() {
		$endpoint = "https://min-api.cryptocompare.com/data/pricemulti?fsyms=BTC,ETH,NEO&tsyms=USD";
		$result = json_decode(file_get_contents($endpoint), 1);
		$output["BTC"] = $result["BTC"]["USD"];
		$output["ETH"] = $result["ETH"]["USD"];
		$output["NEO"] = $result["NEO"]["USD"];
		return $output;
	}

	public function storeInvalidTransaction($user_id, $address, $amount, $currency_type, $status, $date) {
		try {
			$insertData = array();
			$insertData['user_id'] = $user_id;
			$insertData['address'] = $address;
			$insertData['amount'] = $amount;
			$insertData['currency_type'] = $currency_type;
			$insertData['status'] = $status;
			$insertData['created_at'] = $date;
			DB::table('invalid_transactions')->insert($insertData);

			/*Send Email to User and Admin for Invalid*/
			$mailParams = array();
			$mailParams['address'] = $address;
			$mailParams['amount'] = $amount;
			$mailParams['currency'] = $currency_type;
			$mailParams['transaction_date'] = $date;
			$userData = DB::table('users')->where('id', $user_id)->first();
			$mailParams['email'] = $userData->email;
			$mailParams['fullname'] = $userData->fullname;
			$this->sendMail($mailParams, $this->user_email_template_id);

			$mailParams['address'] = $address;
			$mailParams['amount'] = $amount;
			$mailParams['currency'] = $currency_type;
			$mailParams['transaction_date'] = $date;
			$this->sendMail($mailParams, $this->admin_email_template_id);
		} catch (Exception $e) {
			$mailParams = array();
			$mailParams['filename'] = 'GetEthBalance.php';
			$mailParams['module'] = 'Cron job';
			$mailParams['title'] = 'Cron job failed in Ether auto transaction detection at storeInvalidTransaction';
			$mailParams['description'] = $e->getMessage();
			$this->sendMail($mailParams, $this->developer_email_template_id);
		}
	}

	public function getTokenAmountToSendAsPerETH($amount) {
		$settings = DB::table('settings')->first();
		$neo_price = $this->pricesInUSD["NEO"];
		$btc_price = $this->pricesInUSD["ETH"];
		$tokenAsPerSingleBTC = ($this->pricesInUSD["ETH"] * $settings->token_price_neo) / $this->pricesInUSD["NEO"];
		return $token = $tokenAsPerSingleBTC * $amount;
	}

	public function allocateToken($user_id, $amount, $receivingAddress, $sender_address = 'XXX', $tx = 'XXX') {
		$current_date = date('Y-m-d H:i:s');
		try {
			$settings = DB::table('settings')->first();
			$tokenToAllocate = $this->getTokenAmountToSendAsPerETH($amount);
			$bonus = ($this->getCurrentBonusRate($amount) * $tokenToAllocate) / 100;

			//Add Bonus amount to Bonus Table
			$insertBonusData = array();
			$insertBonusData["user_id"] = $user_id;
			$insertBonusData["bonus"] = $bonus;
			$insertBonusData["transaction_id"] = $tx;
			$insertBonusData["status"] = 0;
			$insertBonusData["created_at"] = $current_date;
			DB::table('bonus')->insert($insertBonusData);

			//Add Referral Bonus amount to Referral Bonus Table
			$hasReferrer = $this->GetReferrarId($user_id);
			if ($hasReferrer != NULL) {
				$insertReferralBonusData = array();
				$insertReferralBonusData["user_id"] = $hasReferrer;
				$insertReferralBonusData["bonus"] = (($tokenToAllocate * $settings->referral_bouns_amount) / 100);
				$insertReferralBonusData["transaction_id"] = $tx;
				$insertReferralBonusData["status"] = 0;
				$insertReferralBonusData["referrer_id"] = $user_id;
				$insertReferralBonusData["created_at"] = $current_date;
				DB::table('referral_bonus')->insert($insertReferralBonusData);
			}
			//Assign Bonus and Token to Users Table
			$userData = DB::table('users')->where('id', $user_id)->first();

			DB::table('users')->where('id', $user_id)->update(['token_balance' => $userData->token_balance + $tokenToAllocate, 'bonus_token_balance' => $userData->bonus_token_balance + $insertBonusData["bonus"]]);
			//Create Transaction for User
			$transactionData = array();
			$transactionData['user_id'] = $user_id;
			$transactionData['currency'] = $this->currency;
			$transactionData['sender_address'] = $sender_address;
			$transactionData['deposit_address'] = $receivingAddress;
			$transactionData['amount'] = $amount;
			$transactionData['token_to_allocate'] = $tokenToAllocate;
			$transactionData['discount'] = $bonus;
			$transactionData['net_token'] = $tokenToAllocate + $bonus;
			$transactionData['transaction_hash'] = base64_encode($this->currency . '|' . $amount);
			$transactionData['is_withdrawed'] = 0;
			$transactionData['status'] = 0;
			$transactionData['created_at'] = $current_date;
			DB::table('transactions')->insert($transactionData);

			/* Send Success mail to Admin and User */
			$mailParams = array();
			$mailParams['fullname'] = $userData->fullname;
			$mailParams['email'] = $userData->email;
			$mailParams['currency'] = $this->currency;
			$mailParams['amount'] = $amount;
			$mailParams['transaction_date'] = $current_date;
			$mailParams['token'] = $tokenToAllocate;
			$mailParams['bonus'] = $bonus;
			$mailParams['refferal_bonus'] = (($tokenToAllocate * $settings->referral_bouns_amount) / 100);
			$mailParams['address'] = $receivingAddress;
			$this->sendMail($mailParams, $this->user_success_email_template_id);

			//send success mail to admin
			$this->sendMail($mailParams, $this->admin_success_email_template_id);
		} catch (Exception $e) {
			//Send email to developer
			$mailParams = array();
			$mailParams['filename'] = 'GetEthBalance.php';
			$mailParams['module'] = 'Cron job';
			$mailParams['title'] = 'Cron job failed in Ether auto transaction detection';
			$mailParams['description'] = $e->getMessage();
			$this->sendMail($mailParams, $this->developer_email_template_id);
		}
	}

	public function getCurrentBonusRate($amount) {
		$date = date('Y-m-d');
		$settings = DB::table('settings')->first();
		$currentPreSale = DB::table('pre_sales')->where('is_completed', 1)->select('bonus', 'bonus2')->first();
		$token_price_neo = $settings->token_price_neo; //1NEO=368 AVR
		$neoAsPerETH = $this->pricesInUSD["ETH"] / $this->pricesInUSD["NEO"]; //1BTC=172.24 NEO
		$upperETHRange = $settings->r1_end_bouns_amount / $neoAsPerETH;
		return ($amount < $upperETHRange) ? $currentPreSale->bonus : $currentPreSale->bonus2;
	}

	public function GetReferrarId($user_id) {
		$userData = DB::table('users')->where('id', $user_id)->first();
		return $userData->referrar_id;
	}

	public function CheckAndValidateForLowAndUpBounds($value, $currency_type = 'ETH') {
		$settings = DB::table('settings')->first();
		$token_price_neo = $settings->token_price_neo;
		$neoAsPerETH = $this->pricesInUSD["ETH"] / $this->pricesInUSD["NEO"];
		$lowerETHRange = $settings->r1_start_bouns_amount / $neoAsPerETH;
		$upperETHRange = $settings->r2_end_bouns_amount / $neoAsPerETH;
		if ($value < $lowerETHRange) {
			return 0;
		} else if ($value > $upperETHRange) {
			return 2;
		} else {
			return 1;
		}
	}

	public static function callRPC($data) {
		$siteurl = 'https://mainnet.infura.io/GY00dyKPy72B8RZ5g979';
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => $siteurl,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_TIMEOUT => 30000,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_HTTPHEADER => array('Content-Type: application/json'),
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_POSTFIELDS => json_encode($data),
		));
		$response = curl_exec($curl);
		$err = curl_error($curl);
		return $response;
	}

	public function sendMail($data, $id) {
		$sc = SendMailController::dynamicEmail([
			'email_id' => $id,
			'user_id' => 1,
			'data' => $data,
		]);
	}
}
