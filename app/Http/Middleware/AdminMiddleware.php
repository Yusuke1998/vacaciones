<?php

namespace App\Http\Middleware;

use Closure;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
    	if (\Auth::User()->rol==='administrador') {
        	return $next($request);
    	}else{
    		return redirect(url('/home'));
    	}
    }
}
