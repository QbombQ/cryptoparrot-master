<?php

namespace App\Model\Providers\Formatters\TradeSubsystem;

use Illuminate\Support\ServiceProvider;

class FollowFormatterProvider extends ServiceProvider{

	public function boot(){}

	public function register()
	{
		$this->app->bind('App\Model\Contracts\Interfaces\Formatters\TradeSubsystem\FollowFormatterInterface', 'App\Model\Formatters\TradeSubsystem\FollowFormatter');
	}
}