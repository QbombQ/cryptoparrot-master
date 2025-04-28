<?php

namespace App\Model\Providers\Facades;

use Illuminate\Support\ServiceProvider;

class FeedFacadeProvider extends ServiceProvider{

	public function boot(){}

	public function register()
	{
		$this->app->bind('feed', 'App\Model\Facades\FeedFacade');
	}
}