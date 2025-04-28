<?php

namespace App\Model\Providers\Data;

use Illuminate\Support\ServiceProvider;

class UserNotificationSettingRepositoryProvider extends ServiceProvider{

	public function boot(){}

	public function register()
	{
		$this->app->bind('App\Model\Contracts\Interfaces\Data\UserNotificationSettingRepositoryInterface', 'App\Model\Data\Repositories\UserNotificationSettingRepository');
	}
}