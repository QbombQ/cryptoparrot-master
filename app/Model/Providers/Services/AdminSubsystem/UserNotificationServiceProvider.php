<?php

namespace App\Model\Providers\Services\AdminSubsystem;

use Illuminate\Support\ServiceProvider;

class UserNotificationServiceProvider extends ServiceProvider{

	public function boot(){}

	public function register()
	{
		$this->app->bind('App\Model\Contracts\Interfaces\Services\AdminSubsystem\UserNotificationServiceInterface', 'App\Model\Services\AdminSubsystem\UserNotificationService');
	}
}