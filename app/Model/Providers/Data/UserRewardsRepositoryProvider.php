<?php

namespace App\Model\Providers\Data;

use Illuminate\Support\ServiceProvider;

class UserRewardsRepositoryProvider extends ServiceProvider{

	public function boot(){}

	public function register()
	{
		$this->app->bind('App\Model\Contracts\Interfaces\Data\UserRewardsRepositoryInterface', 'App\Model\Data\Repositories\UserRewardsRepository');
	}
}