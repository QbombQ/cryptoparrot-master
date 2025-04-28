<?php

namespace App\Model\Providers\Data;

use Illuminate\Support\ServiceProvider;

class FollowRepositoryProvider extends ServiceProvider{

	public function boot(){}

	public function register()
	{
		$this->app->bind('App\Model\Contracts\Interfaces\Data\FollowRepositoryInterface', 'App\Model\Data\Repositories\FollowRepository');
	}
}