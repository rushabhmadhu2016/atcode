<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class RemoveAddressFromQueue extends Command {
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'RemoveAddressFromQueue:removeaddressfromqueue';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Remove Address from Queue of Checking balance of API.';

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
		//
		$insertData = array();
		$insertData['cron_title'] = 'RemoveAddressFromQueue';
		$insertData['cron_date'] = date('Y-m-d H:i:s');
		$insertData['status'] = 1;
		DB::table('cron_logs')->insert($insertData);
	}
}
