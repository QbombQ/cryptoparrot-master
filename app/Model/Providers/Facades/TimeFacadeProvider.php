<?php

namespace App\Model\Providers\Facades;

use Illuminate\Support\ServiceProvider;

class TimeFacadeProvider extends ServiceProvider{

	public function boot(){}

	public function register()
	{
		$this->app->bind('time', 'App\Model\Facades\TimeFacade');
	}
}