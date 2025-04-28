<?php

namespace App\Model\Providers\Formatters\TradeSubsystem;

use Illuminate\Support\ServiceProvider;

class TradeConditionFormatterProvider extends ServiceProvider{

	public function boot(){}

	public function register()
	{
		$this->app->bind('App\Model\Contracts\Interfaces\Formatters\TradeSubsystem\TradeConditionFormatterInterface', 'App\Model\Formatters\TradeSubsystem\TradeConditionFormatter');
	}
}