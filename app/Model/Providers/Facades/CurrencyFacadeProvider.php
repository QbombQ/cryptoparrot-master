<?php

namespace App\Model\Providers\Facades;

use Illuminate\Support\ServiceProvider;

class CurrencyFacadeProvider extends ServiceProvider{

	public function boot(){}

	public function register()
	{
		$this->app->bind('currency', 'App\Model\Facades\CurrencyFacade');
	}
}