<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DynamicEmail extends Mailable {
	use Queueable, SerializesModels;

	/**
	 * Create a new message instance.
	 *
	 * @return void
	 */
	public function __construct($content) {
		$this->content = $content;
	}

	/**
	 * Build the message.
	 *
	 * @return $this
	 */
	public function build() {
		if (isset($this->content['attachment']) && !empty($this->content['attachment'])) {
			return $this->subject($this->content['subject'])
				->markdown('emails.dynamic_email')
				->attach($this->content['attachment'])
				->with('content', $this->content);
		} else {
			return $this->subject($this->content['subject'])
				->markdown('emails.dynamic_email')
				->with('content', $this->content);
		}
	}
}