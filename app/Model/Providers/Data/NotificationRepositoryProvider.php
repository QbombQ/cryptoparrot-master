<?php

namespace App\Model\Providers\Data;

use Illuminate\Support\ServiceProvider;

class NotificationRepositoryProvider extends ServiceProvider{

	public function boot(){}

	public function register()
	{
		$this->app->bind('App\Model\Contracts\Interfaces\Data\NotificationRepositoryInterface', 'App\Model\Data\Repositories\NotificationRepository');
	}
}