<?php

namespace App\Model\Providers\Services\Common;

use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider
{

    public function boot()
    {



    }

    public function register()
    {

        $this->app->bind('App\Model\Contracts\Interfaces\Services\Common\UserServiceInterface', 'App\Model\Services\Common\UserService');

    }
	
}