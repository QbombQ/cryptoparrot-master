<?php

namespace App\Model\Providers\Facades;

use Illuminate\Support\ServiceProvider;

class MediaFacadeProvider extends ServiceProvider{

	public function boot(){}

	public function register()
	{
		$this->app->bind('media', 'App\Model\Facades\MediaFacade');
	}
}