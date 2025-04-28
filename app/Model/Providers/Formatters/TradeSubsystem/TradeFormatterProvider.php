<?php

namespace App\Model\Providers\Formatters\TradeSubsystem;

use Illuminate\Support\ServiceProvider;

class TradeFormatterProvider extends ServiceProvider
{

    public function boot()
    {



    }

    public function register()
    {

        $this->app->bind('App\Model\Contracts\Interfaces\Formatters\TradeSubsystem\TradeFormatterInterface', 'App\Model\Formatters\TradeSubsystem\TradeFormatter');

    }
	
}