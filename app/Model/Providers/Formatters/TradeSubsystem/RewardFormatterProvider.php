<?php

namespace App\Model\Providers\Formatters\TradeSubsystem;

use Illuminate\Support\ServiceProvider;

class RewardFormatterProvider extends ServiceProvider{

	public function boot(){}

	public function register()
	{
		$this->app->bind('App\Model\Contracts\Interfaces\Formatters\TradeSubsystem\RewardFormatterInterface', 'App\Model\Formatters\TradeSubsystem\RewardFormatter');
	}
}