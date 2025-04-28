<?php

namespace App\Model\Providers\Formatters\TradeSubsystem;

use Illuminate\Support\ServiceProvider;

class EarnPlayDollarFormatterProvider extends ServiceProvider{

	public function boot(){}

	public function register()
	{
		$this->app->bind('App\Model\Contracts\Interfaces\Formatters\TradeSubsystem\EarnPlayDollarFormatterInterface', 'App\Model\Formatters\TradeSubsystem\EarnPlayDollarFormatter');
	}
}