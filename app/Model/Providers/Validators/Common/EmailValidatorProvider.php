<?php

namespace App\Model\Providers\Validators\Common;

use Illuminate\Support\ServiceProvider;

class EmailValidatorProvider extends ServiceProvider
{

    public function boot()
    {



    }

    public function register()
    {

        $this->app->bind('App\Model\Contracts\Interfaces\Validators\Common\EmailValidatorInterface', 'App\Model\Validators\Common\EmailValidator');

    }
	
}