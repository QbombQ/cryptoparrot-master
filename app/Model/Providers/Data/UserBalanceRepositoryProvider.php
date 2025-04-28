<?php

namespace App\Model\Providers\Data;

use Illuminate\Support\ServiceProvider;

class UserBalanceRepositoryProvider extends ServiceProvider
{

    public function boot()
    {



    }

    public function register()
    {

        $this->app->bind('App\Model\Contracts\Interfaces\Data\UserBalanceRepositoryInterface', 'App\Model\Data\Repositories\UserBalanceRepository');

    }
	
}