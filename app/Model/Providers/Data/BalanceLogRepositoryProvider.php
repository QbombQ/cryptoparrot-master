<?php

namespace App\Model\Providers\Data;

use Illuminate\Support\ServiceProvider;

class BalanceLogRepositoryProvider extends ServiceProvider{

	public function boot(){}

	public function register()
	{
		$this->app->bind('App\Model\Contracts\Interfaces\Data\BalanceLogRepositoryInterface', 'App\Model\Data\Repositories\BalanceLogRepository');
	}
}