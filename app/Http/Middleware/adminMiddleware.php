<?php

namespace App\Http\Middleware;

use App\User;
use Auth;
use Closure;

class adminMiddleware {
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next) {
		$user = Auth::user();
		if ($user) {
			if ($user->user_type == 2) {
				$response = $next($request);
				return $response->header('Cache-Control', 'nocache, no-store, max-age=0, must-revalidate')
					->header('Pragma', 'no-cache')
					->header('Expires', 'Fri, 01 Jan 1990 00:00:00 GMT');
			} else if ($user->user_type == 1) {
				return redirect('userDashboard');
			} else {
				return redirect()->back()->withError('Invalid Access');
			}
		} else {
			return redirect('login')->withError('Invalid Access');
		}
	}
}
