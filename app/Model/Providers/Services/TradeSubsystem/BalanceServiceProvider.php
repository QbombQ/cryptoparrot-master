<?php

namespace App\Model\Providers\Services\TradeSubsystem;

use Illuminate\Support\ServiceProvider;

class BalanceServiceProvider extends ServiceProvider
{

    public function boot()
    {



    }

    public function register()
    {

        $this->app->bind('App\Model\Contracts\Interfaces\Services\TradeSubsystem\BalanceServiceInterface', 'App\Model\Services\TradeSubsystem\BalanceService');

    }
	
}