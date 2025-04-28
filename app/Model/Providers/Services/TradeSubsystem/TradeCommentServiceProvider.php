<?php

namespace App\Model\Providers\Services\TradeSubsystem;

use Illuminate\Support\ServiceProvider;

class TradeCommentServiceProvider extends ServiceProvider
{

    public function boot()
    {



    }

    public function register()
    {

        $this->app->bind('App\Model\Contracts\Interfaces\Services\TradeSubsystem\TradeCommentServiceInterface', 'App\Model\Services\TradeSubsystem\TradeCommentService');

    }
	
}