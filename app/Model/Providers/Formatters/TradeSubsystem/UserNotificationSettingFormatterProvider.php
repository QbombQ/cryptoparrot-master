<?php

namespace App\Model\Providers\Formatters\TradeSubsystem;

use Illuminate\Support\ServiceProvider;

class UserNotificationSettingFormatterProvider extends ServiceProvider{

	public function boot(){}

	public function register()
	{
		$this->app->bind('App\Model\Contracts\Interfaces\Formatters\TradeSubsystem\UserNotificationSettingFormatterInterface', 'App\Model\Formatters\TradeSubsystem\UserNotificationSettingFormatter');
	}
}