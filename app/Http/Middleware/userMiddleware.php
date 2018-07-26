<?php

namespace App\Http\Middleware;

use App\User;
use Auth;
use Closure;

class userMiddleware {
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
			if ($user->user_type == 1) {
				$response = $next($request);
				return $response->header('Cache-Control', 'nocache, no-store, max-age=0, must-revalidate')->header('Pragma', 'no-cache')->header('Expires', 'Fri, 01 Jan 1990 00:00:00 GMT');
			} else if ($user->user_type == 2) {
				return redirect('adminDashboard');
			}
		} else {
			return redirect('login');
		}
	}
}
