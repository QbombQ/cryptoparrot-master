<?php

namespace App\Model\Providers\Data;

use Illuminate\Support\ServiceProvider;

class RewardRepositoryProvider extends ServiceProvider{

	public function boot(){}

	public function register()
	{
		$this->app->bind('App\Model\Contracts\Interfaces\Data\RewardRepositoryInterface', 'App\Model\Data\Repositories\RewardRepository');
	}
}