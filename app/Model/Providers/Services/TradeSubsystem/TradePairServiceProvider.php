<?php

namespace App\Model\Providers\Services\TradeSubsystem;

use Illuminate\Support\ServiceProvider;

class TradePairServiceProvider extends ServiceProvider{

	public function boot(){}

	public function register()
	{
		$this->app->bind('App\Model\Contracts\Interfaces\Services\TradeSubsystem\TradePairServiceInterface', 'App\Model\Services\TradeSubsystem\TradePairService');
	}
}