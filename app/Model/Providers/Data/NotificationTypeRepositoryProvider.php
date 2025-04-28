<?php

namespace App\Model\Providers\Data;

use Illuminate\Support\ServiceProvider;

class NotificationTypeRepositoryProvider extends ServiceProvider{

	public function boot(){}

	public function register()
	{
		$this->app->bind('App\Model\Contracts\Interfaces\Data\NotificationTypeRepositoryInterface', 'App\Model\Data\Repositories\NotificationTypeRepository');
	}
}