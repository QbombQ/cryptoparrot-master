<?php

namespace App\Model\Providers\Services\TradeSubsystem;

use Illuminate\Support\ServiceProvider;

class ExchangeServiceProvider extends ServiceProvider{

	public function boot(){}

	public function register()
	{
		$this->app->bind('App\Model\Contracts\Interfaces\Services\TradeSubsystem\ExchangeServiceInterface', 'App\Model\Services\TradeSubsystem\ExchangeService');
	}
}