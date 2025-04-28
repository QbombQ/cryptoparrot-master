<?php

namespace App\Model\Providers\Services\TradeSubsystem;

use Illuminate\Support\ServiceProvider;

class EarnPlayDollarServiceProvider extends ServiceProvider{

	public function boot(){}

	public function register()
	{
		$this->app->bind('App\Model\Contracts\Interfaces\Services\TradeSubsystem\EarnPlayDollarServiceInterface', 'App\Model\Services\TradeSubsystem\EarnPlayDollarService');
	}
}