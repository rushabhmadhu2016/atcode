<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Addresses extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		//
		Schema::create('addresses', function (Blueprint $table) {
			$table->increments('id');
			$table->string('address')->unique();
			$table->string('currency_type')->nullable();
			$table->string('private_key')->nullable();
			$table->string('assigned_to')->nullable();
			$table->string('balance')->default(0);
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
		Schema::dropIfExists('addresses');
	}
}
