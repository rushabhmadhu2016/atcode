<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TransactionHases extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		//
		Schema::create('transaction_hashes', function (Blueprint $table) {
			$table->increments('id');
			$table->bigInteger('user_id');
			$table->string('currency');
			$table->string('tx_hash');
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
		//Transaction_hashes
		Schema::dropIfExists('transaction_hashes');
	}
}
