<?php

namespace App\Model\Providers\Formatters\TradeSubsystem;

use Illuminate\Support\ServiceProvider;

class PortfolioFormatterProvider extends ServiceProvider{

	public function boot(){}

	public function register()
	{
		$this->app->bind('App\Model\Contracts\Interfaces\Formatters\TradeSubsystem\PortfolioFormatterInterface', 'App\Model\Formatters\TradeSubsystem\PortfolioFormatter');
	}
}