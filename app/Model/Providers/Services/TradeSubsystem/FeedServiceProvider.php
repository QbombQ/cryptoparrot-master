<?php

namespace App\Model\Providers\Services\TradeSubsystem;

use Illuminate\Support\ServiceProvider;

class FeedServiceProvider extends ServiceProvider
{

    public function boot()
    {


    }

    public function register()
    {

        $this->app->bind('App\Model\Contracts\Interfaces\Services\TradeSubsystem\FeedServiceInterface', 'App\Model\Services\TradeSubsystem\FeedService');

    }
	
}