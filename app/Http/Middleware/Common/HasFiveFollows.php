<?php

namespace App\Http\Middleware\Common;

use Auth;
use Closure;
use Carbon\Carbon;
use Cache;
use Cookie;

class HasFiveFollows
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
        if(Auth::user()->followings->count() < 1) return redirect('/app/follow-someone');

        return $next($request);
        
    }
    
}