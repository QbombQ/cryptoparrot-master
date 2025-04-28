<?php

namespace App\Model\Providers\Data;

use Illuminate\Support\ServiceProvider;

class UserNotificationRepositoryProvider extends ServiceProvider
{

    public function boot()
    {



    }

    public function register()
    {

        $this->app->bind('App\Model\Contracts\Interfaces\Data\UserNotificationRepositoryInterface', 'App\Model\Data\Repositories\UserNotificationRepository');

    }
	
}