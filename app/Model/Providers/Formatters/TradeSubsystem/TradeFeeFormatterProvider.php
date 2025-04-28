<?php

namespace App\Model\Providers\Formatters\TradeSubsystem;

use Illuminate\Support\ServiceProvider;

class TradeFeeFormatterProvider extends ServiceProvider{

	public function boot(){}

	public function register()
	{
		$this->app->bind('App\Model\Contracts\Interfaces\Formatters\TradeSubsystem\TradeFeeFormatterInterface', 'App\Model\Formatters\TradeSubsystem\TradeFeeFormatter');
	}
}