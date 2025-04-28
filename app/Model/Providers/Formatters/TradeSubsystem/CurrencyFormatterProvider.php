<?php

namespace App\Model\Providers\Formatters\TradeSubsystem;

use Illuminate\Support\ServiceProvider;

class CurrencyFormatterProvider extends ServiceProvider
{

    public function boot()
    {



    }

    public function register()
    {

        $this->app->bind('App\Model\Contracts\Interfaces\Formatters\TradeSubsystem\CurrencyFormatterInterface', 'App\Model\Formatters\TradeSubsystem\CurrencyFormatter');

    }
	
}