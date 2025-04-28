<?php

namespace App\Model\Providers\Data;

use Illuminate\Support\ServiceProvider;

class UserRepositoryProvider extends ServiceProvider
{

    public function boot()
    {



    }

    public function register()
    {

        $this->app->bind('App\Model\Contracts\Interfaces\Data\UserRepositoryInterface', 'App\Model\Data\Repositories\UserRepository');

    }
	
}