<?php

namespace App\Model\Providers\Data;

use Illuminate\Support\ServiceProvider;

class RewardOrderRepositoryProvider extends ServiceProvider{

	public function boot(){}

	public function register()
	{
		$this->app->bind('App\Model\Contracts\Interfaces\Data\RewardOrderRepositoryInterface', 'App\Model\Data\Repositories\RewardOrderRepository');
	}
}