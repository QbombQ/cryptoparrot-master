<?php

namespace App\Model\Providers\Services\TradeSubsystem;

use Illuminate\Support\ServiceProvider;

class TradeServiceProvider extends ServiceProvider
{

    public function boot()
    {



    }

    public function register()
    {

        $this->app->bind('App\Model\Contracts\Interfaces\Services\TradeSubsystem\TradeServiceInterface', 'App\Model\Services\TradeSubsystem\TradeService');

    }
	
}