<?php

namespace App\Console\Commands;

use App\Http\Controllers\SendMailController;
use DB;
use Exception;
use Illuminate\Console\Command;

class GetNeoBalance extends Command {
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'GetNeoBalance:getneobalance';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Get NEO Balance API Call for All NEO Transaction Detection.';
	protected $user_email_template_id = 3;
	protected $admin_email_template_id = 5;
	protected $user_success_email_template_id = 6;
	protected $admin_success_email_template_id = 7;
	protected $developer_email_template_id = 9;
	protected $settings;
	protected $currency = 'NEO';
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
		$insertData['cron_title'] = 'GetNeoBalance';
		$insertData['cron_date'] = date('Y-m-d H:i:s');
		$insertData['status'] = 1;
		$date = date('Y-m-d H:i:s');

		$neoMonitoringAddresses = DB::table('monitorings')->where('currency_type', $this->currency)->where('status', 1)->orderBy('other')->get();

		DB::beginTransaction();
		$addressDataList = array();
		$neo_asset_id = '0xc56f33fc6ecfcd0c225c4ab356fee59390af8560be0e930faebe74a6daff7c9b';
		$addressListToMonitor = array();
		try {
			foreach ($neoMonitoringAddresses as $monitoringAddress) {
				$addressDataList[$monitoringAddress->address] = $monitoringAddress;
			}
			$addressListToMonitor = array_keys($addressDataList);
			echo "monitoring count: " . count($addressListToMonitor);

			$block_data = DB::table('block_data')->where('currency', $this->currency)->first();

			$params = ['jsonrpc' => "2.0", 'method' => "getblockcount", 'params' => [], 'id' => "1"];
			$heightObject = json_decode($this->callRPC($params), 1);
			$lastBlockHeight = $block_data->block_number; //2450689

			$neoLatestHeight = 0;
			if (isset($heightObject["result"])) {
				$neoLatestHeight = $heightObject["result"] - 5; //2450693
			} else {
				exit;
			}
			$lastBlockHeight++;
			$transactionAddresses = array();
			$neoTransactionsInBlocks = array();
			$totalTransactionFound = 0;
			DB::table('block_data')->where('currency', $this->currency)->update(['block_number' => $neoLatestHeight - 5]);
			echo "Checking in Block :" . $lastBlockHeight;
			for ($i = $lastBlockHeight; $i <= $neoLatestHeight; $i++) {
				$params1 = ['jsonrpc' => "2.0", 'method' => "getblock", 'params' => [intval($i), 1], 'id' => "1"];
				$block = json_decode($this->callRPC($params1), 1);
				if (isset($block["result"])) {
					if (count($block["result"]["tx"]) > 0) {
						DB::table('cron_logs')->insert(array('cron_title' => 'GetNeoBalance' . $i, 'cron_date' => $date, 'status' => 1));
					}
					foreach ($block["result"]["tx"] as $tx) {
						if (count($tx["vin"]) > 0 && count($tx["vout"]) > 0 && isset($tx["vout"][0]["asset"]) && $tx["vout"][0]["asset"] == $neo_asset_id) {
							if (isset($tx["vout"][0]["address"])) {
								if (in_array($tx["vout"][0]["address"], $addressListToMonitor)) {
									$transactionDetail = array("address" => $tx["vout"][0]["address"], "amount" => $tx["vout"][0]["value"], "tx" => $tx["vin"][0]["txid"]);
									$this->handleTransaction($transactionDetail, $addressDataList[$tx["vout"][0]["address"]]);
									$totalTransactionFound++;
								}
							}
						}
					}
				}
			}
			if ($totalTransactionFound > 0) {
				$result = array();
				$result["Total Transaction found"] = $totalTransactionFound;
				echo json_encode($result);
			}
			DB::commit();
		} catch (Exception $e) {
			$mailParams = array();
			$mailParams['filename'] = 'GetNeoBalance.php';
			$mailParams['module'] = 'Handle method of NEO cron';
			$mailParams['title'] = 'Cron job failed in NEO auto transaction detection with handle method - Transaction will be rollbacked';
			$mailParams['description'] = $e->getMessage();
			echo __FILE__ . __LINE__;
			$this->sendMail($mailParams, $this->developer_email_template_id);
		}
	}

	public function handleTransaction($transactionDetail, $monitoringAddress) {

		$neo_balance = $transactionDetail["amount"];
		$last_balance = $monitoringAddress->last_balance;
		$sender_address = 'xxx';
		$flag1 = $this->CheckAndValidateForLowAndUpBounds($last_balance + $neo_balance, $this->currency);

		if ($flag1 == 1) {
			$this->allocateToken($monitoringAddress->user_id, ($neo_balance - $monitoringAddress->last_balance), $monitoringAddress->address, $sender_address);
		} else if ($flag1 == 0) {
			$this->storeInvalidTransaction($monitoringAddress->user_id, $monitoringAddress->address, $neo_balance, $this->currency, 0, $date);
		} else if ($flag1 == 2) {
			$this->storeInvalidTransaction($monitoringAddress->user_id, $monitoringAddress->address, $neo_balance, $this->currency, 0, $date);
		}
		$udpatedLast_balance = $monitoringAddress->last_balance + $neo_balance;
		$other = ($monitoringAddress->other == NULL) ? 0 : $monitoringAddress->other;
		$other++;
		DB::table('monitorings')->where('address', $monitoringAddress->address)->update(['last_balance' => $udpatedLast_balance, 'other' => $other]);
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

			/*Send Email to User for Invalid*/
			$mailParams = array();
			$mailParams['address'] = $address;
			$mailParams['amount'] = $amount;
			$mailParams['currency'] = $currency_type;
			$mailParams['transaction_date'] = $date;
			$userData = DB::table('users')->where('id', $user_id)->first();
			$mailParams['email'] = $userData->email;
			$mailParams['fullname'] = $userData->fullname;
			echo __FILE__ . __LINE__;
			$this->sendMail($mailParams, $this->user_email_template_id);

			$this->sendMail($mailParams, $this->admin_email_template_id);
		} catch (Exception $e) {
			$mailParams = array();
			$mailParams['filename'] = 'GetNeoBalance.php';
			$mailParams['module'] = 'Handle method of Neo cron';
			$mailParams['title'] = 'Cron job failed in Neo auto transaction detection with storeInvalidTransaction method';
			echo $mailParams['description'] = $e->getMessage();
			echo __FILE__ . __LINE__;
			$this->sendMail($mailParams, $this->developer_email_template_id);
		}
	}

	public function allocateToken($user_id, $amount, $receivingAddress, $sender_address = 'XXX') {
		try {

			$current_date = date('Y-m-d H:i:s');
			$settings = DB::table('settings')->first();
			$token = $settings->token_price_neo * $amount;
			$bonus = (($token * $this->getCurrentBonusRate($amount)) / 100);
			//Add Bonus amount to Bonus Table
			$insertBonusData = array();
			$insertBonusData["user_id"] = $user_id;
			$insertBonusData["bonus"] = $bonus;
			$insertBonusData["transaction_id"] = base64_encode($insertBonusData["bonus"] . '|' . $user_id);
			$insertBonusData["status"] = 0;
			$insertBonusData["created_at"] = $current_date;
			DB::table('bonus')->insert($insertBonusData);

			//Add Referral Bonus amount to Referral Bonus Table
			$hasReferrer = $this->GetReferrarId($user_id);
			if ($hasReferrer != NULL) {
				$insertReferralBonusData = array();
				$insertReferralBonusData["user_id"] = $hasReferrer;
				$insertReferralBonusData["bonus"] = (($token * $settings->referral_bouns_amount) / 100);
				$insertReferralBonusData["transaction_id"] = base64_encode($bonus . '|' . $user_id);
				$insertReferralBonusData["status"] = 0;
				$insertReferralBonusData["referrer_id"] = $user_id;
				$insertReferralBonusData["created_at"] = $current_date;
				DB::table('referral_bonus')->insert($insertReferralBonusData);
			}
			//Assign Bonus and Token to Users Table
			$userData = DB::table('users')->where('id', $user_id)->first();

			DB::table('users')->where('id', $user_id)->update(['token_balance' => $userData->token_balance + $token, 'bonus_token_balance' => $userData->bonus_token_balance + $insertBonusData["bonus"]]);

			//Create Transaction for User
			$transactionData = array();
			$transactionData['user_id'] = $user_id;
			$transactionData['currency'] = $this->currency;
			$transactionData['sender_address'] = $sender_address;
			$transactionData['deposit_address'] = $receivingAddress;
			$transactionData['amount'] = $amount;
			$transactionData['token_to_allocate'] = $token;
			$transactionData['discount'] = $bonus;
			$transactionData['net_token'] = $token + $bonus;
			$transactionData['transaction_hash'] = base64_encode($this->currency . '|' . $amount);
			$transactionData['is_withdrawed'] = 0;
			$transactionData['status'] = 0;
			$transactionData['created_at'] = $current_date;
			DB::table('transactions')->insert($transactionData);

			//send success mail to investor
			$mailParams = array();
			$mailParams['fullname'] = $userData->fullname;
			$mailParams['email'] = $userData->email;
			$mailParams['currency'] = $this->currency;
			$mailParams['amount'] = $amount;
			$mailParams['transaction_date'] = $current_date;
			$mailParams['token'] = $token;
			$mailParams['bonus'] = $bonus;
			$mailParams['refferal_bonus'] = (($token * $settings->referral_bouns_amount) / 100);
			$mailParams['address'] = $receivingAddress;
			$this->sendMail($mailParams, $this->user_success_email_template_id);

			//send success mail to admin
			$this->sendMail($mailParams, $this->admin_success_email_template_id);
		} catch (Exception $e) {
			$mailParams = array();
			$mailParams['filename'] = 'GetNeoBalance.php';
			$mailParams['module'] = 'Handle method of NEO cron';
			$mailParams['title'] = 'Cron job failed in NEO cron auto transaction detection with allocateToken method';
			echo $mailParams['description'] = $e->getMessage();
			$this->sendMail($mailParams, $this->developer_email_template_id);
		}
	}

	public function GetReferrarId($user_id) {
		$userData = DB::table('users')->where('id', $user_id)->first();
		return $userData->referrar_id;
	}

	public function getCurrentBonusRate($amount) {
		$date = date('Y-m-d');
		$settings = DB::table('settings')->first();
		$currentPreSale = DB::table('pre_sales')->whereDate('start_time', '<', $date)->whereDate('end_time', '>=', $date)->select('bonus', 'bonus2')->first();
		return ($amount < $settings->r1_end_bouns_amount) ? $currentPreSale->bonus : $currentPreSale->bonus2;
	}

	public function CheckAndValidateForLowAndUpBounds($value, $currency_type) {
		$settings = DB::table('settings')->first();
		if ($value < $settings->r1_start_bouns_amount) {
			return 0;
		} else if ($value > $settings->r2_end_bouns_amount) {
			return 2;
		} else {
			return 1;
		}
	}

	public static function callRPC($data) {
		$runfile = 'http://5.101.139.166:10332';
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => $runfile,
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
		curl_close($curl);
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
