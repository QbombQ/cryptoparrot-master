<?php

namespace App\Model\Providers\Validators\Common;

use Illuminate\Support\ServiceProvider;

class TradeValidatorProvider extends ServiceProvider
{

    public function boot()
    {



    }

    public function register()
    {

        $this->app->bind('App\Model\Contracts\Interfaces\Validators\Common\TradeValidatorInterface', 'App\Model\Validators\Common\TradeValidator');

    }
	
}