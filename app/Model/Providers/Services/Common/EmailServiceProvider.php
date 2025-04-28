<?php

namespace App\Model\Providers\Services\Common;

use Illuminate\Support\ServiceProvider;

class EmailServiceProvider extends ServiceProvider
{

    public function boot()
    {



    }

    public function register()
    {

        $this->app->bind('App\Model\Contracts\Interfaces\Services\Common\EmailServiceInterface', 'App\Model\Services\Common\EmailService');

    }
	
}