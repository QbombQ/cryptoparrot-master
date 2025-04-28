<?php

namespace App\Model\Providers\Data;

use Illuminate\Support\ServiceProvider;

class UserEarnPlayDollarRepositoryProvider extends ServiceProvider{

	public function boot(){}

	public function register()
	{
		$this->app->bind('App\Model\Contracts\Interfaces\Data\UserEarnPlayDollarRepositoryInterface', 'App\Model\Data\Repositories\UserEarnPlayDollarRepository');
	}
}