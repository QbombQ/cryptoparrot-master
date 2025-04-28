<?php

namespace App\Http\Middleware\FrontSubsystem;

use Auth;
use Closure;

class NoUsernameOrEmail
{

    /**
     * Handle an incoming request.
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if(!Auth::check()) return redirect('/');

		if(Auth::user()->email && Auth::user()->username) return redirect('/app');        
        
        return $next($request);

    }
    
}