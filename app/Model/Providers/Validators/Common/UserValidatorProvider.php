<?php

namespace App\Model\Providers\Validators\Common;

use Illuminate\Support\ServiceProvider;

class UserValidatorProvider extends ServiceProvider
{

    public function boot()
    {



    }

    public function register()
    {

        $this->app->bind('App\Model\Contracts\Interfaces\Validators\Common\UserValidatorInterface', 'App\Model\Validators\Common\UserValidator');

    }
	
}