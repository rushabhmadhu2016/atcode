<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CustomErrors extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('custom_errors', function (Blueprint $table) {
			$table->increments('id');
			$table->string('currency')->nullable();
			$table->string('generated_in')->nullable();
			$table->string('error_desc')->nullable();
			$table->string('address')->nullable();
			$table->string('other')->nullable();
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
		Schema::dropIfExists('custom_errors');
	}
}
