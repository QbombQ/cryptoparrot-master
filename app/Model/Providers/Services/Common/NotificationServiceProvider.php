<?php

namespace App\Model\Providers\Services\Common;

use Illuminate\Support\ServiceProvider;

class NotificationServiceProvider extends ServiceProvider
{

    public function boot()
    {



    }

    public function register()
    {

        $this->app->bind('App\Model\Contracts\Interfaces\Services\Common\NotificationServiceInterface', 'App\Model\Services\Common\NotificationService');

    }
	
}