<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmailTemplate extends Model {

	protected $table = "email_template";

	protected $fillable = [
		'emat_email_type', 'emat_email_name', 'emat_email_subject', 'emat_email_message', 'emat_is_active',
	];

}
?>