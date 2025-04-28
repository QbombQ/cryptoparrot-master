<?php

namespace App\Http\Middleware\Common;

use Auth;
use Closure;
use Carbon\Carbon;
use Cache;

class Activity
{

    /**
     * Handle an incoming request.
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if(Auth::check()) {

            $todayUsers = Cache::get('today-users');
            $thisWeekUsers = Cache::get('this-week-users');

            if(!$todayUsers) 
            {

                $todayUsers = [];

            }

            if(!$thisWeekUsers) 
            {

                $thisWeekUsers = [];

            }

            $todayUsers[Auth::user()->username] = Carbon::now();
            Cache::put('today-users', $todayUsers, Carbon::now()->addHours(24)); 

            $thisWeekUsers[Auth::user()->username] = Carbon::now();
            Cache::put('this-week-users', $thisWeekUsers, Carbon::now()->addHours(288));

        }

        return $next($request);
    }
    
}