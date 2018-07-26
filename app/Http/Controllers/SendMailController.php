<?php
// created by chetan 26-03-2018
// All mail dynamic template here to send mail

namespace App\Http\Controllers;
use App\EmailTemplate;
use App\Mail\DynamicEmail;
use App\User;
use DB;
use Illuminate\Mail\Markdown;
use Mail;
use PDF;

class SendMailController extends Controller {
	/*
		send dynamic mail
	*/
	public static function dynamicEmail($data) {

		$email_body = $email_subject = $user_email = $attachment = '';
		$email = EmailTemplate::findorfail($data['email_id']);
		$user = User::select('*')->where('id', $data['user_id'])->first();

		$manager_email = array();
		if ($email && $user) {
			$email_subject = $email->emat_email_subject;
			$email_body = $email->emat_email_message;

			$user_email = $user->email;
			$user_name = ucwords($user->fullname);

			// Get email template body content as per requirement
			switch ($email->id) {
			case 2:
				//New Registration by customer
				$link = route('activate-account', ['token' => $user->avtar_token]);
				$email_body = str_replace('{user_name}', $user_name, $email_body);
				$email_body = str_replace('{activation_link}', $link, $email_body);
				break;
			/*case 3:
				//New Registration by Delivery Manager/Finance Manager
				$email_body = str_replace('{user_name}', $user_name, $email_body);
				$email_body = str_replace('{email}', $user_email, $email_body);
				$email_body = str_replace('{password}', $data['password'], $email_body);
				break;*/
			case 3:
				//Send Invalid Transaction Details User
				$user_email = config('constant.admin_email');
				$email_body = str_replace('{fullname}', $data['data']['fullname'], $email_body);
				$email_body = str_replace('{email}', $data['data']['email'], $email_body);
				$email_body = str_replace('{currency}', $data['data']['currency'], $email_body);
				$email_body = str_replace('{amount}', $data['data']['amount'], $email_body);
				$email_body = str_replace('{address}', $data['data']['address'], $email_body);
				$email_body = str_replace('{transaction_date}', $data['data']['transaction_date'], $email_body);
				break;
			case 4:
				//Contact enquiry
				$user_email = config('constant.admin_email');
				$email_body = str_replace('{name}', $data['data']['name'], $email_body);
				$email_body = str_replace('{email}', $data['data']['email'], $email_body);
				$email_body = str_replace('{content}', $data['data']['content'], $email_body);
				break;
			case 5:
				//Send Invalid Transaction Details User
				$user_email = config('constant.admin_email');
				$email_body = str_replace('{fullname}', $data['data']['fullname'], $email_body);
				$email_body = str_replace('{email}', $data['data']['email'], $email_body);
				$email_body = str_replace('{currency}', $data['data']['currency'], $email_body);
				$email_body = str_replace('{amount}', $data['data']['amount'], $email_body);
				$email_body = str_replace('{address}', $data['data']['address'], $email_body);
				$email_body = str_replace('{transaction_date}', $data['data']['transaction_date'], $email_body);
				break;
			case 6:
				//Send Success Transaction Details User
				$user_email = config('constant.admin_email');
				$email_body = str_replace('{fullname}', $data['data']['fullname'], $email_body);
				$email_body = str_replace('{email}', $data['data']['email'], $email_body);
				$email_body = str_replace('{currency}', $data['data']['currency'], $email_body);
				$email_body = str_replace('{amount}', $data['data']['amount'], $email_body);
				$email_body = str_replace('{address}', $data['data']['address'], $email_body);
				$email_body = str_replace('{bonus}', $data['data']['bonus'], $email_body);
				$email_body = str_replace('{token}', $data['data']['token'], $email_body);
				$email_body = str_replace('{address}', $data['data']['address'], $email_body);
				$email_body = str_replace('{transaction_date}', $data['data']['transaction_date'], $email_body);
				$email_body = str_replace('{refferal_bonus}', $data['data']['refferal_bonus'], $email_body);

				if (!$attach = $this->generatePDF($data)) {
					if (file_exists(config('constant.customer_invoice_path') . $attach)) {
						$attachment = asset(config('constant.pdf_dir')) . '/' . $attach;
					}
				}
				break;
			case 7:
				//Send Success Transaction Details Admin
				$user_email = config('constant.admin_email');
				$email_body = str_replace('{fullname}', $data['data']['fullname'], $email_body);
				$email_body = str_replace('{email}', $data['data']['email'], $email_body);
				$email_body = str_replace('{currency}', $data['data']['currency'], $email_body);
				$email_body = str_replace('{amount}', $data['data']['amount'], $email_body);
				$email_body = str_replace('{address}', $data['data']['address'], $email_body);
				$email_body = str_replace('{bonus}', $data['data']['bonus'], $email_body);
				$email_body = str_replace('{token}', $data['data']['token'], $email_body);
				$email_body = str_replace('{address}', $data['data']['address'], $email_body);
				$email_body = str_replace('{transaction_date}', $data['data']['transaction_date'], $email_body);
				$email_body = str_replace('{refferal_bonus}', $data['data']['refferal_bonus'], $email_body);
				break;
			case 9:
				//Send Invalid Transaction Details User
				$user_email = config('constant.admin_email');
				$email_body = str_replace('{filename}', $data['data']['filename'], $email_body);
				$email_body = str_replace('{module}', $data['data']['module'], $email_body);
				$email_body = str_replace('{title}', $data['data']['title'], $email_body);
				$email_body = str_replace('{description}', $data['data']['description'], $email_body);
				break;
			default:
				$email_body = "No content";
				break;
			}

			// set data in content array to pass in view
			$content = [
				'subject' => $email_subject,
				'body' => $email_body,
				'attachment' => $attachment,
			];

			$receiverAddress = $user_email;
			if (isset($manager_email) && $manager_email != '') {
				Mail::to($receiverAddress)->cc($manager_email)->send(new DynamicEmail($content));
			} else {
				Mail::to($receiverAddress)->send(new DynamicEmail($content));
			}
		} else {
			return;
		}
		return;
	}

	/*
		check view of email template before send email in browser
	*/
	public function markdownViewInBrowser() {

		$data = [
			'email_id' => 1,
			'user_id' => 6,
			'contact_id' => 9,
		];
		$email_body = $email_subject = $user_email = '';
		$email = EmailTemplate::findorfail($data['email_id']);
		$user = User::select('*', DB::raw("CONCAT_WS(' ',first_name,last_name)  AS user_name"))->where('id', $data['user_id'])->first();

		$manager_email = array();
		$manager_email[0] = 'rushabhmadhu@gmail.com';
		$manager_email[1] = 'rushabh.madhu@innvonix.com';
		if ($email && $user) {
			$email_subject = $email->emat_email_subject;
			$email_body = $email->emat_email_message;

			$user_email = $user->email;
			$user_name = ucwords($user->user_name);

			// Get email template body content as per requirement
			switch ($email->id) {
			case 1:
				$email_body = str_replace('{user_name}', $user_name, $email_body);
				break;
			default:
				$email_body = "No content";
				break;
			}
		}

		$content = [
			'body' => $email_body,
			'subject' => $email_subject,
		];

		// render view - your view name and pass content array
		$markdown = new Markdown(view(), config('mail.markdown'));

		// return $markdown->render('your view name', compact('content array'));
		return $markdown->render('emails.dynamic_email', compact('content'));
	}

	// Test mail
	public static function testEmail() {
		$content = [
			'title' => 'Hello ',
			'subject' => 'testing mail',
			'body' => 'testing mail',
		];

		$receiverAddress = 'chetan.kukadiya@innvonix.com';
		$m = Mail::to($receiverAddress)
			->send(new DynamicEmail($content));
		return $m;
	}

	public static function generatePDF($data) {
		// view html design
		//return view('pdf.generate_pdf');
		$pdf_name = 'invoice_' . date('dmYHis') . 'pdf';
		$pdf = PDF::loadView('pdf.generate_pdf', compact('data'))->save(config('constant.pdf_path') . $pdf_name);
		return $pdf_name;

		// if Download PDF
		// $pdf = PDF::loadView('pdf.generate_pdf', compact('data'));
		// return $pdf->download($pdf_name);
	}
}
