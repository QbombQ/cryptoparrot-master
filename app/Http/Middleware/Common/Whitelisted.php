<?php

namespace App\Http\Middleware\Common;

use Auth;
use Closure;
use Carbon\Carbon;
use Cache;
use Cookie;

class Whitelisted
{

    /**
     * Handle an incoming request.
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $authenticated = Cookie::get('authenticated');

        if(!$authenticated) {
            return redirect('maintenance');
        }

        return $next($request);
    }
    
}