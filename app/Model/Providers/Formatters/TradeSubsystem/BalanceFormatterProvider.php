<?php

namespace App\Model\Providers\Formatters\TradeSubsystem;

use Illuminate\Support\ServiceProvider;

class BalanceFormatterProvider extends ServiceProvider
{

    public function boot()
    {



    }

    public function register()
    {

        $this->app->bind('App\Model\Contracts\Interfaces\Formatters\TradeSubsystem\BalanceFormatterInterface', 'App\Model\Formatters\TradeSubsystem\BalanceFormatter');

    }
	
}