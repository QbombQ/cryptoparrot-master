<?php

namespace App\Http\Middleware\FrontSubsystem;

use Auth;
use Closure;

class HasNotSharedWithFriends
{

    /**
     * Handle an incoming request.
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

		if(session()->get('sharedWithFriends')) return redirect('/');        
        
        return $next($request);
    }
    
}