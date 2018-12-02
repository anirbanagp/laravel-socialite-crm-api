<?php

namespace App\Http\Middleware;

use Closure;
use App\Http\Traits\Auth\Authentication;
use Illuminate\Support\Facades\Session;

/**
 *  This is a Middleware which will validate all frontend request.
 *
 *  @author Anirban Saha
 */

class FrontendGuest
{
	use Authentication;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
		if(!$this->isLoggedIn($request)){
            return $next($request);
        }
        else
        {
			return redirect(route('company.profile'));
        };
    }
}
