<?php

namespace App\Model\Providers\Formatters\TradeSubsystem;

use Illuminate\Support\ServiceProvider;

class UserFormatterProvider extends ServiceProvider
{

    public function boot()
    {



    }

    public function register()
    {

        $this->app->bind('App\Model\Contracts\Interfaces\Formatters\TradeSubsystem\UserFormatterInterface', 'App\Model\Formatters\TradeSubsystem\UserFormatter');

    }
	
}