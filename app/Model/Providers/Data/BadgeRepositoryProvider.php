<?php

namespace App\Model\Providers\Data;

use Illuminate\Support\ServiceProvider;

class BadgeRepositoryProvider extends ServiceProvider{

	public function boot(){}

	public function register()
	{
		$this->app->bind('App\Model\Contracts\Interfaces\Data\BadgeRepositoryInterface', 'App\Model\Data\Repositories\BadgeRepository');
	}
}