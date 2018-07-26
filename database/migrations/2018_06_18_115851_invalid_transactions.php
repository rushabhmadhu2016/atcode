<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InvalidTransactions extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		//
		if (!Schema::hasTable('invalid_transactions')) {
			Schema::create('invalid_transactions', function (Blueprint $table) {
				$table->increments('id');
				$table->integer('user_id');
				$table->string('address');
				$table->string('currency_type');
				$table->integer('amount');
				$table->integer('status');
				$table->timestamps();
			});
		}
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		//
		Schema::dropIfExists('invalid_transactions');
	}
}
