<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PreSales extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		// pre_sales
		Schema::create('pre_sales', function (Blueprint $table) {
			$table->increments('id');
			$table->dateTime('start_time');
			$table->dateTime('end_time');
			$table->integer('bonus');
			$table->integer('bonus2');
			$table->integer('is_completed');
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
		Schema::dropIfExists('pre_sales');
	}
}
