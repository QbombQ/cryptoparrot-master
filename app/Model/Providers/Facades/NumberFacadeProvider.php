<?php

namespace App\Model\Providers\Facades;

use Illuminate\Support\ServiceProvider;

class NumberFacadeProvider extends ServiceProvider{

	public function boot(){}

	public function register()
	{
		$this->app->bind('number', 'App\Model\Facades\NumberFacade');
	}
}