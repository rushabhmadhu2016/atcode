<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pre_sale extends Model {
	//
	protected $fillable = ['start_time', 'end_time', 'bonus', 'bonus2', 'is_completed'];

}
