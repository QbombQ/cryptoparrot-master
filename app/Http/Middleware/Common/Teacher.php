<?php

namespace App\Http\Middleware\Common;

use Auth;
use Closure;
use Carbon\Carbon;
use Cache;

class Teacher
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
        if(Auth::user()->type === 'admin') return $next($request);
        if(Auth::user()->status !== 'confirmed') return redirect('/');
        if(!Auth::user()->badges->contains('title', 'TRADER')) return redirect('/');

        return $next($request);
    }
    
}