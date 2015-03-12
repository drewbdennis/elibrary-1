<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckIfAdmin {

	/**
	 * Check if the incoming request is being called by a user which is administrator
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
        if(!Auth::user()->administrator){
            return response('Unauthorized.', 401);
        }
        return $next($request);
	}

}
