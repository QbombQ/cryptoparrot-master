<?php

namespace App\Http\Middleware\Common;

use Closure;
use Illuminate\Support\Facades\Auth;

class NotBanned
{

    public function handle($request, Closure $next, $guard = null)
    {

        if (Auth::check() && Auth::user()->status === 'banned')
        {

            Auth::logout();
            return redirect('/banned');

        }

        return $next($request);

    }

}
