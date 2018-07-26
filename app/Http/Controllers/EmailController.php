<?php
// created by Dhrumi 24 march 2018
namespace App\Http\Controllers;

use App\Model\EmailTemplate;
use DB;
use Exception;
use Illuminate\Http\Request;
use Redirect;
use Validator;

class EmailController extends Controller {

	public function __construct() {
		$this->middleware(function ($request, $next) {
			if ($request->user()->authorizeRoles([env('USER_ROLE_ADMIN')])) {
				if ($request->user()->is_active == 1) {
					return $next($request);
				}
				flash(trans('app.access_denied'))->info()->important();
				return redirect()->route('errors');
			}
			flash(trans('app.permission'))->error()->important();
			return redirect()->route('errors');
		});
	}

	public function index() {
		$email = EmailTemplate::all();
		return view('admin.email.index', compact('email'));
	}

	public function put($id) {
		$email = EmailTemplate::where('id', $id)->first();
		return view('admin.email.put', compact('email'));
	}

	public function edit(Request $request) {
		DB::beginTransaction();
		try {

			$validator = Validator::make($request->all(), [
				'emat_email_name' => 'required|unique:email_template,emat_email_name,' . base64_decode($request->email_id),
				'emat_email_subject' => 'required',
				'emat_email_message' => 'required',
			], [
				'emat_email_name.required' => 'Please enter email name.',
				'emat_email_name.unique' => 'This email name is already exists.',
				'emat_email_subject.required' => 'Please enter email subject.',
				'emat_email_message.required' => 'Please enter email message content.',
			]);

			if ($validator->fails()) {
				return redirect()->back()->withErrors($validator)->withInput();
			}

			$email = EmailTemplate::where('id', base64_decode($request->email_id))->update(['emat_email_name' => $request->emat_email_name, 'emat_email_subject' => $request->emat_email_subject, 'emat_email_message' => $request->emat_email_message]);

			if ($email) {
				DB::commit();
				flash('Email updated successfully')->success();
				return redirect()->route('email_management');
			} else {
				DB::rollback();
				flash('Email edit fail')->error()->important();
				return redirect()->back();
			}

		} catch (Exception $e) {
			DB::rollback();
			flash($e->getMessage())->error()->important();
			return redirect()->back();
		}
	}
}
?>