<?php

namespace App\Model\Providers\Services\Common;

use Illuminate\Support\ServiceProvider;

class BadgeServiceProvider extends ServiceProvider{

	public function boot(){}

	public function register()
	{
		$this->app->bind('App\Model\Contracts\Interfaces\Services\Common\BadgeServiceInterface', 'App\Model\Services\Common\BadgeService');
	}
}