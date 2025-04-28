<?php

namespace App\Model\Providers\Facades;

use Illuminate\Support\ServiceProvider;

class StringsFacadeProvider extends ServiceProvider{

	public function boot(){}

	public function register()
	{
		$this->app->bind('strings', 'App\Model\Facades\StringsFacade');
	}
}