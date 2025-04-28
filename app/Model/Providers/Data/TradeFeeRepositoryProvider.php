<?php

namespace App\Model\Providers\Data;

use Illuminate\Support\ServiceProvider;

class TradeFeeRepositoryProvider extends ServiceProvider{

	public function boot(){}

	public function register()
	{
		$this->app->bind('App\Model\Contracts\Interfaces\Data\TradeFeeRepositoryInterface', 'App\Model\Data\Repositories\TradeFeeRepository');
	}
}