<?php

namespace App\Model\Providers\Formatters\TradeSubsystem;

use Illuminate\Support\ServiceProvider;

class InvitedUserFormatterProvider extends ServiceProvider{

	public function boot(){}

	public function register()
	{
		$this->app->bind('App\Model\Contracts\Interfaces\Formatters\TradeSubsystem\InvitedUserFormatterInterface', 'App\Model\Formatters\TradeSubsystem\InvitedUserFormatter');
	}
}