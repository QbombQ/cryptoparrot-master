<?php

namespace App\Model\Providers\Formatters\TradeSubsystem;

use Illuminate\Support\ServiceProvider;

class BlockedUserFormatterProvider extends ServiceProvider{

	public function boot(){}

	public function register()
	{
		$this->app->bind('App\Model\Contracts\Interfaces\Formatters\TradeSubsystem\BlockedUserFormatterInterface', 'App\Model\Formatters\TradeSubsystem\BlockedUserFormatter');
	}
}