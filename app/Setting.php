<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model {
	//
	protected $fillable = ['title', 'token_price_neo', 'token_price_btc', 'token_price_eth', 'token_price_usd', 'admin_email', 'developer_email', 'r1_start_bouns_amount', 'r1_end_bouns_amount', 'r2_start_bouns_amount', 'r2_end_bouns_amount', 'r3_start_bouns_amount', 'r3_end_bouns_amount', 'referral_bouns_amount', 'btc_price', 'eth_price', 'status'];
}
