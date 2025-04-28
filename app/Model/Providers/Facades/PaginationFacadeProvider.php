<?php

namespace App\Model\Providers\Facades;

use Illuminate\Support\ServiceProvider;

class PaginationFacadeProvider extends ServiceProvider{

	public function boot(){}

	public function register()
	{
		$this->app->bind('pagination', 'App\Model\Facades\PaginationFacade');
	}
}