<?php

namespace App\Model\Providers\Facades;

use Illuminate\Support\ServiceProvider;

class BalanceFacadeProvider extends ServiceProvider{

	public function boot(){}

	public function register()
	{
		$this->app->bind('balance', 'App\Model\Facades\BalanceFacade');
	}
}