<?php

namespace App\Model\Providers\Formatters\TradeSubsystem;

use Illuminate\Support\ServiceProvider;

class TradeCommentFormatterProvider extends ServiceProvider
{

    public function boot()
    {



    }

    public function register()
    {

        $this->app->bind('App\Model\Contracts\Interfaces\Formatters\TradeSubsystem\TradeCommentFormatterInterface', 'App\Model\Formatters\TradeSubsystem\TradeCommentFormatter');

    }
	
}