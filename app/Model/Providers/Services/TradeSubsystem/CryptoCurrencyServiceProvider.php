<?php

namespace App\Model\Providers\Services\TradeSubsystem;

use Illuminate\Support\ServiceProvider;

class CryptoCurrencyServiceProvider extends ServiceProvider{

	public function boot(){}

	public function register()
	{
		$this->app->bind('App\Model\Contracts\Interfaces\Services\TradeSubsystem\CryptoCurrencyServiceInterface', 'App\Model\Services\TradeSubsystem\CryptoCurrencyService');
	}
}