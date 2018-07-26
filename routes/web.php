<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

//Route::get('generate_pdf', 'SendMailController@generatePDF');
//Route::get('/test', 'GeneralController@test');

Route::get('/', function () {
	return view('welcome');
});

Route::get('/terms', function () {
	return view('terms');
});

Route::get('/privacy', function () {
	return view('privacy');
});

Route::post('/save-contact', 'GeneralController@saveContactFrom');
Route::get('/thank-you', 'GeneralController@thankYou')->name('thank-you');
Route::get('/fetch-data', 'GeneralController@fetchData');
Route::get('/activate-account/{token}', 'GeneralController@activateAccount')->name('activate-account');

/*Email Routes*/
//Route::get('putemail/{id}', 'EmailController@put')->name('putemail');
//Route::post('editemail', 'EmailController@edit')->name('editemail');
/*Email Routes*/

Route::get('/saveQuickContact', 'GeneralController@saveQuickContact')->name('saveQuickContact');
Route::post('/saveNewsLetter', 'GeneralController@saveNewsLetter')->name('saveNewsLetter');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/update-profile', 'HomeController@getProfile')->name('update-profile');
Route::get('/update-kyc', 'HomeController@getKYC')->name('update-kyc');
Route::post('/update-profile-save', 'HomeController@updateProfile')->name('update-profile-save');
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::group(['middleware' => ['auth']], function () {
	Route::get('/referral/{id}', 'GeneralController@setReferral')->name('referral');
});

Route::group(['middleware' => ['user']], function () {
	Route::get('/userDashboard', 'UserController@userDashboard')->name('userDashboard');
	Route::get('/my-referrals', 'UserController@getUserReferrals')->name('my-referrals');
	Route::get('/user-profile', 'UserController@getUserProfile')->name('user-profile');
	Route::get('/user-wallet', 'UserController@getUserWallet')->name('user-wallet');
	Route::post('/update-profile', 'UserController@updateUserProfile')->name('update-profile');
	Route::get('/user-transactions', 'UserController@getTransactions')->name('user-transactions');
	Route::get('/changePassword', 'UserController@changePassword')->name('changePassword');
	Route::post('/updateUserPassword', 'UserController@updateUserPassword')->name('updateUserPassword');
	Route::get('/buy-token', 'UserController@buyToken')->name('buy-token');
	Route::post('/start_monitoring', 'UserController@placeOrder')->name('start_monitoring');
	Route::post('/update-withdrawal_request', 'UserController@updateWithdrawalRequest')->name('update-withdrawal_request');

});

Route::group(['middleware' => ['admin']], function () {
	Route::get('/adminDashboard', '\App\Http\Controllers\Admin\AdminHomeController@getDashboard')->name('adminDashboard');
	Route::get('/users', '\App\Http\Controllers\Admin\AdminHomeController@getUsers')->name('users');
	Route::get('/transactions', '\App\Http\Controllers\Admin\AdminHomeController@getTransactions')->name('transactions');

	Route::get('/kyc_pending', '\App\Http\Controllers\Admin\AdminHomeController@getPendingKycs')->name('kyc_pending');

	Route::get('/kyc_approved', '\App\Http\Controllers\Admin\AdminHomeController@getApprovedKycs')->name('kyc_approved');

	Route::get('/kycs', '\App\Http\Controllers\Admin\AdminHomeController@getAllKycs')->name('kycs');

	Route::get('/approve_kyc/{id}', '\App\Http\Controllers\Admin\AdminHomeController@approveKyc')->name('approve_kyc');

	Route::get('/reject_kyc/{id}', '\App\Http\Controllers\Admin\AdminHomeController@rejectKyc')->name('reject_kyc');

	Route::get('/neo_addresses', '\App\Http\Controllers\Admin\AdminHomeController@getAllNeoAddresses')->name('neo_addresses');

	Route::get('/btc_addresses', '\App\Http\Controllers\Admin\AdminHomeController@getAllBtcAddresses')->name('btc_addresses');

	Route::get('/eth_addresses', '\App\Http\Controllers\Admin\AdminHomeController@getAllEthAddresses')->name('eth_addresses');

	Route::get('/subscribers', '\App\Http\Controllers\Admin\AdminHomeController@getAllSubscribers')->name('subscribers');

	Route::get('/invalid_transactions', '\App\Http\Controllers\Admin\AdminHomeController@getAllInvalidTransactions')->name('invalid_transactions');

	Route::get('/pre_ico_sale', '\App\Http\Controllers\Admin\AdminHomeController@getAllIcoPreSaleDetails')->name('pre_ico_sale');

	Route::get('/manage_user_status', '\App\Http\Controllers\Admin\AdminProfileController@manageUserStatus')->name('manage-user-status');

	Route::get('/settings', '\App\Http\Controllers\Admin\AdminProfileController@getSettings')->name('settings');

	Route::get('/withdraw_requests', '\App\Http\Controllers\Admin\AdminProfileController@getAllWithdrawRequests')->name('withdraw_requests');

	Route::post('/settings', '\App\Http\Controllers\Admin\AdminProfileController@putSettings')->name('settingsSubmit');

	Route::get('/change-password', '\App\Http\Controllers\Admin\AdminProfileController@changePassword')->name('changePassword');

	Route::post('/change-password', '\App\Http\Controllers\Admin\AdminProfileController@updatePassword')->name('updatePassword');

	Route::get('/messages', '\App\Http\Controllers\Admin\AdminProfileController@getMessages')->name('messages');
	Route::get('/edit-presale/{id}', '\App\Http\Controllers\Admin\AdminProfileController@getPresaleData')->name('edit-presale');
	Route::post('/update-presale', '\App\Http\Controllers\Admin\AdminProfileController@updatePresaleData')->name('update-presale');

	Route::get('/emails', '\App\Http\Controllers\Admin\AdminProfileController@getEmails')->name('emails');
	Route::get('/editemail/{id}', '\App\Http\Controllers\Admin\AdminProfileController@getEmailData')->name('updatemail');
	Route::post('/editemail', '\App\Http\Controllers\Admin\AdminProfileController@saveEmailTemplate')->name('editemail');
	Route::post('/send-token', '\App\Http\Controllers\Admin\AdminProfileController@sendToken')->name('sendToken');
});