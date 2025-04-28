<?php

namespace App\Http\Middleware\Common;

use Auth;
use Closure;
use Carbon\Carbon;
use Cache;
use Request;

class EmailVerified
{

    /**
     * Handle an incoming request.
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if(!Auth::check() || Auth::user()->status === 'unconfirmed') {

            if(Request::segment(2) == 'post')
            {

                return response([
                    'success' => false,
                    'message' => 'You have to verify your email to post comments'
                ]);

            }

            return redirect('verification-required');

        }

        return $next($request);
    }
    
}