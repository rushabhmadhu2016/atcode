<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Bonus extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		//
		Schema::create('bonus', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('user_id');
			$table->string('bonus')->default(0);
			$table->string('transaction_id')->default(0);
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
		Schema::dropIfExists('bonus');
	}
}
