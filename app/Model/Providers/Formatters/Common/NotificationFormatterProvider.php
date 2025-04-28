<?php

namespace App\Model\Providers\Formatters\Common;

use Illuminate\Support\ServiceProvider;

class NotificationFormatterProvider extends ServiceProvider{

	public function boot(){}

	public function register()
	{
		$this->app->bind('App\Model\Contracts\Interfaces\Formatters\Common\NotificationFormatterInterface', 'App\Model\Formatters\Common\NotificationFormatter');
	}
}