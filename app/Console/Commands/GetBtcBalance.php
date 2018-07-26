<?php
namespace App\Console\Commands;
use App\Http\Controllers\SendMailController;
use DB;
use Exception;
use Illuminate\Console\Command;

class GetBtcBalance extends Command {
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'GetBtcBalance:getbtcbalance';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'BTC Balance get API';
	protected $settings;
	protected $currency = 'BTC';
	protected $pricesInUSD;
	protected $user_email_template_id = 3;
	protected $admin_email_template_id = 5;
	protected $user_success_email_template_id = 6;
	protected $admin_success_email_template_id = 7;
	protected $developer_email_template_id = 9;
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
		$insertData['cron_title'] = 'GetBtcBalance';
		$insertData['cron_date'] = date('Y-m-d H:i:s');
		$insertData['status'] = 1;
		$block_data = DB::table('block_data')->where('currency', $this->currency)->first();
		$this->pricesInUSD = $this->getUSDPrices();
		try {
			DB::beginTransaction();
			// Get BTC monitoring Addresses
			$btcMonitoringAddresses = DB::table('monitorings')->where('currency_type', $this->currency)->where('status', 1)->orderBy('other')->get();
			$addressDataList = array();
			foreach ($btcMonitoringAddresses as $monitoringAddress) {
				$addressDataList[$monitoringAddress->address] = $monitoringAddress;
			}
			$addresses = array();
			$btcAddresList = array();
			$addressListToMonitor = array();
			$addressListToMonitor = array_keys($addressDataList);
			$latestBlock = "http://5.101.139.166:3003/latestBlock";
			$heightObject = json_decode($this->getLatestBlock($latestBlock), 1);
			$currentHeight = $heightObject["block"] - 1;
			if ($currentHeight > $block_data->block_number) {
				$currentHeightHash = $heightObject["hash"];
				$addressListToMonitor = array_keys($addressDataList);
				$currentHeightHashUrl = "http://5.101.139.166:3003/getBlockData/" . $currentHeightHash;
				$btcBlockData = $this->getCurrentBlockTransactions($currentHeightHashUrl);

				if (count($btcBlockData) > 0) {
					$insertData['cron_title'] = 'GetBtcBalance' . $currentHeight;
					DB::table('cron_logs')->insert($insertData);
				}

				foreach ($btcBlockData as $blocktx) {
					if (isset($blocktx["out"][0]["addr"])) {
						if (in_array($blocktx["out"][0]["addr"], $addressListToMonitor)) {
							$transactionAddress = $addressDataList[$blocktx["out"][0]["addr"]];
							$amount = $blocktx["out"][0]["value"] / 100000000;
							if ($amount > 0 && ($amount - $transactionAddress->last_balance) > 0) {
								$this->handleBTCTransactions($amount, $transactionAddress);
							}
						}
					}
				}
			} else {
				echo "No latest block found :" . date('Y-m-d H:i:s');
			}
			DB::table('block_data')->where('currency', $this->currency)->update(['block_number' => $currentHeight]);
			DB::commit();
		} catch (Exception $e) {
			$mailParams = array();
			$mailParams['filename'] = 'GetBtcBalance.php';
			$mailParams['module'] = 'Handle method of Bitcoin cron';
			$mailParams['title'] = 'Cron job failed in Bitcoin auto transaction detection with handle method - Transaction will be rollbacked';
			echo $mailParams['description'] = $e->getMessage();
			$this->sendMail($mailParams, $this->developer_email_template_id);
			DB::rollback();
		}
	}

	public function getCurrentBlockTransactions($url) {
		return json_decode(file_get_contents($url), 1);
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

	public function handleBTCTransactions($balance, $address_data) {
		$amount = $balance;
		$amount = $amount - $address_data->last_balance;
		$current_date = date('Y-m-d H:i:s');
		$sender_address = 'xxx';
		$transaction_id = 'xxx';
		if ($this->CheckAndValidateForLowAndUpBounds($amount) == 1) {
			//echo "allocateToken";var_dump($address_data);exit;
			$this->allocateToken($address_data->user_id, $amount, $address_data->address, $sender_address, $transaction_id);
		} else if ($this->CheckAndValidateForLowAndUpBounds($amount) == 2) {
			//echo "storeInvalidTransaction Higher Amount";exit;
			$this->storeInvalidTransaction($address_data->user_id, $address_data->address, $amount, $this->currency, 0, $current_date);
		} else if ($this->CheckAndValidateForLowAndUpBounds($amount) == 0) {
			//echo "storeInvalidTransaction Lower Amount";exit;
			$this->storeInvalidTransaction($address_data->user_id, $address_data->address, $amount, $this->currency, 0, $current_date);
		}
		$other = ($address_data->other == NULL) ? 0 : $address_data->other;
		$other++;
		DB::table('monitorings')->where('address', $address_data->address)->update(['last_balance' => $amount, 'other' => $other]);
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
			//throw new Exception("This is your error message");

			$userData = DB::table('users')->where('id', $user_id)->first();
			$mailParams = array();
			$mailParams['email'] = $userData->email;
			$mailParams['fullname'] = $userData->fullname;

			$mailParams['address'] = $address;
			$mailParams['amount'] = $amount;
			$mailParams['currency'] = $currency_type;
			$mailParams['transaction_date'] = $date;
			$this->sendMail($mailParams, $this->user_email_template_id);

			/*Send Email to Admin for Invalid*/
			$mailParams['address'] = $address;
			$mailParams['amount'] = $amount;
			$mailParams['currency'] = $currency_type;
			$mailParams['transaction_date'] = $date;
			$this->sendMail($mailParams, $this->admin_email_template_id);
		} catch (Exception $e) {
			/*Send Email to User for Invalid*/
			$mailParams = array();
			$mailParams['filename'] = 'GetBtcBalance.php';
			$mailParams['module'] = 'Cron job';
			$mailParams['title'] = 'Cron job failed in Bitcoin auto transaction detection';
			echo $mailParams['description'] = $e->getMessage();
			$this->sendMail($mailParams, $this->developer_email_template_id);
		}
	}

	public function getTokenAmountToSendAsPerBTC($amount) {
		$settings = DB::table('settings')->first();
		$neo_price = $this->pricesInUSD["NEO"];
		$btc_price = $this->pricesInUSD["BTC"];
		$tokenAsPerSingleBTC = ($this->pricesInUSD["BTC"] * $settings->token_price_neo) / $this->pricesInUSD["NEO"];
		return $token = $tokenAsPerSingleBTC * $amount;
	}

	public function allocateToken($user_id, $amount, $receivingAddress, $sender_address = 'XXX', $tx = 'XXX') {
		$current_date = date('Y-m-d H:i:s');
		try {
			$settings = DB::table('settings')->first();
			$tokenToAllocate = $this->getTokenAmountToSendAsPerBTC($amount);
			$bonus = ($this->getCurrentBonusRate($amount) * $tokenToAllocate) / 100;

			//Add Bonus amount to Bonus Table
			if ($bonus > 0) {
				$insertBonusData = array();
				$insertBonusData["user_id"] = $user_id;
				$insertBonusData["bonus"] = $bonus;
				$insertBonusData["transaction_id"] = $tx;
				$insertBonusData["status"] = 0;
				$insertBonusData["created_at"] = $current_date;
				DB::table('bonus')->insert($insertBonusData);
			}

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

			DB::table('users')->where('id', $user_id)->update(['token_balance' => $userData->token_balance + $tokenToAllocate, 'bonus_token_balance' => $userData->bonus_token_balance + $bonus]);

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
			/*Send Email to User for Invalid*/
			$mailParams = array();
			$mailParams['filename'] = 'GetBtcBalance.php';
			$mailParams['module'] = 'Allocate Token method';
			$mailParams['title'] = 'Cron job failed in Bitcoin auto transaction detection with allocateToken method';
			echo $mailParams['description'] = $e->getMessage();
			$this->sendMail($mailParams, $this->developer_email_template_id);
		}
	}

	public function getCurrentBonusRate($amount) {
		$date = date('Y-m-d');
		$settings = DB::table('settings')->first();
		$currentPreSale = DB::table('pre_sales')->where('is_completed', 1)->select('bonus', 'bonus2')->first();
		$token_price_neo = $settings->token_price_neo; //1NEO=368 AVR
		$neoAsPerBTC = $this->pricesInUSD["BTC"] / $this->pricesInUSD["NEO"]; //1BTC=172.24 NEO
		$upperBTCRange = $settings->r1_end_bouns_amount / $neoAsPerBTC;
		return ($amount < $upperBTCRange) ? $currentPreSale->bonus2 : $currentPreSale->bonus;
	}

	public function GetReferrarId($user_id) {
		$userData = DB::table('users')->where('id', $user_id)->first();
		return $userData->referrar_id;
	}

	public function CheckAndValidateForLowAndUpBounds($value, $currency_type = 'BTC') {
		$settings = DB::table('settings')->first();
		$token_price_neo = $settings->token_price_neo;
		$neoAsPerBTC = $this->pricesInUSD["BTC"] / $this->pricesInUSD["NEO"];
		$lowerBTCRange = 1 / $neoAsPerBTC;
		$upperBTCRange = $settings->r2_end_bouns_amount / $neoAsPerBTC;
		/*echo "Lower BTC:" . $lowerBTCRange; echo "Upper BTC:" . $upperBTCRange;*/
		if ($value < $lowerBTCRange) {
			//echo "if";exit;
			return 0;
		} else if ($value > $upperBTCRange) {
			//echo "else if";exit;
			return 2;
		} else {
			//echo "else";exit;
			return 1;
		}
	}

	public static function callRPC($data = '') {
		$randomId = rand(1, 5);
		/*$response = file_get_contents('http://5.101.139.166:3002/getBTCBalance/' . $data . '?id=' . $randomId);
			/*$curl = curl_init();
				curl_setopt_array($curl, array(
					CURLOPT_URL => $runfile,
					CURLOPT_RETURNTRANSFER => true,
					CURLOPT_ENCODING => "",
					CURLOPT_TIMEOUT => 30000,
					CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
					CURLOPT_CUSTOMREQUEST => "GET",
					CURLOPT_FOLLOWLOCATION => true,
					CURLOPT_POSTFIELDS => json_encode($data),
				));
				$response = curl_exec($curl);
				$err = curl_error($curl);
		*/
		//return $response;
		return '{"balance":1.0005}';
	}

	public function getLatestBlock($data) {
		return file_get_contents($data);
	}

	public function sendMail($data, $id) {
		$sc = SendMailController::dynamicEmail([
			'email_id' => $id,
			'user_id' => 1,
			'data' => $data,
		]);
	}
}
