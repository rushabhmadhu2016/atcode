<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('users', function (Blueprint $table) {
			$table->increments('id');
			$table->string('fullname');
			$table->string('email')->unique();
			$table->string('password');
			$table->string('address')->nullable();
			$table->string('country')->nullable();
			$table->string('zip_code')->nullable();
			$table->string('phone_number')->nullable();
			$table->string('token_2fa')->nullable();
			$table->string('2fa_enabled')->default(0);
			$table->string('avtar_token')->nullable();
			$table->datetime('token_2fa_expiry')->nullable();
			$table->string('neo_wallet_detail')->nullable();
			$table->double('token_balance', 20, 8)->default(0);
			$table->double('bonus_token_balance', 20, 8)->default(0);
			$table->double('referral_bonus_token_balance', 20, 8)->default(0);
			$table->integer('kyc_status')->default(0);
			$table->integer('user_type')->default(1);
			$table->integer('status')->default(0);
			$table->string('referral_link')->nullable();
			$table->integer('referrar_id')->nullable();
			$table->integer('neo_balance')->default(0);
			$table->integer('neo_old_balance')->default(0);
			$table->integer('eth_balance')->default(0);
			$table->integer('eth_old_balance')->default(0);
			$table->integer('bth_balance')->default(0);
			$table->integer('btc_old_balance')->default(0);
			$table->integer('accept_terms')->default(0);
			$table->rememberToken();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('users');
	}
}
