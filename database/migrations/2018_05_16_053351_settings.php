<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Settings extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		//
		Schema::create('settings', function (Blueprint $table) {
			$table->increments('id');
			$table->string('title');
			$table->string('token_price_neo')->default(0);
			$table->string('token_price_bth')->default(0);
			$table->string('token_price_eth')->default(0);
			$table->string('token_price_usd')->default(0);
			$table->string('r1_start_bouns_amount')->default(0);
			$table->string('r1_end_bouns_amount')->default(0);
			$table->string('r2_start_bouns_amount')->default(0);
			$table->string('r2_end_bouns_amount')->default(0);
			$table->string('r3_start_bouns_amount')->default(0);
			$table->string('r3_end_bouns_amount')->default(0);
			$table->string('referral_bouns_amount')->default(0);
			$table->string('btc_price')->default(0);
			$table->string('eth_price')->default(0);
			$table->string('admin_email');
			$table->string('developer_email');
			$table->integer('status')->default(0);
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		//
		Schema::dropIfExists('settings');
	}
}
