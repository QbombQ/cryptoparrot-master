<?php

namespace App\Http\Middleware\Common;

use Auth;
use Closure;
use Carbon\Carbon;
use Cache;
use Cookie;

class UsernameExists
{

    /**
     * Handle an incoming request.
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

       // if(!Auth::check()) abort(404);

        if(Auth::check()) {
            if(!Auth::user()->username || !Auth::user()->email) {
                return redirect('/pick-your-handle');
            }
        }

        return $next($request);
    }
    
}