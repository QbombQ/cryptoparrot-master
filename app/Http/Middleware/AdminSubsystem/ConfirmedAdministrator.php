<?php

namespace App\Http\Middleware\AdminSubsystem;

use Auth;
use Closure;

class ConfirmedAdministrator
{

    /**
     * Handle an incoming request.
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        

        if(!Auth::check()) abort(404);

		if(Auth::user()->type !== 'admin') abort(404);        
        
        return $next($request);

    }
    
}