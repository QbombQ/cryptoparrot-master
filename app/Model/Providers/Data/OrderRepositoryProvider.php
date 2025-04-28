<?php

namespace App\Model\Providers\Data;

use Illuminate\Support\ServiceProvider;

class OrderRepositoryProvider extends ServiceProvider{

	public function boot(){}

	public function register()
	{
		$this->app->bind('App\Model\Contracts\Interfaces\Data\OrderRepositoryInterface', 'App\Model\Data\Repositories\OrderRepository');
	}
}