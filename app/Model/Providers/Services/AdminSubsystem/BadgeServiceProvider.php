<?php

namespace App\Model\Providers\Services\AdminSubsystem;

use Illuminate\Support\ServiceProvider;

class BadgeServiceProvider extends ServiceProvider{

	public function boot(){}

	public function register()
	{
		$this->app->bind('App\Model\Contracts\Interfaces\Services\AdminSubsystem\BadgeServiceInterface', 'App\Model\Services\AdminSubsystem\BadgeService');
	}
}