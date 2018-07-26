<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Transactions extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		//
		Schema::create('transactions', function (Blueprint $table) {
			$table->increments('id');
			$table->bigInteger('user_id');
			$table->string('currency');
			$table->string('sender_address');
			$table->string('deposit_address');
			$table->double('amount');
			$table->double('token_to_allocate', 10, 4);
			$table->double('discount', 10, 4);
			$table->double('net_token', 10, 4);
			$table->string('transaction_hash')->nullled();
			$table->integer('is_withdrawed');
			$table->integer('status');
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
		Schema::dropIfExists('transactions');
	}
}
