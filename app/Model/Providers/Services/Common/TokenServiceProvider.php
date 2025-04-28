<?php

namespace App\Model\Providers\Services\Common;

use Illuminate\Support\ServiceProvider;

class TokenServiceProvider extends ServiceProvider
{

    public function boot()
    {



    }

    public function register()
    {

        $this->app->bind('App\Model\Contracts\Interfaces\Services\Common\TokenServiceInterface', 'App\Model\Services\Common\TokenService');

    }
	
}