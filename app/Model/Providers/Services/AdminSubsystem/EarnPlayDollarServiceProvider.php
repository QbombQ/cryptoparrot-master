<?php

namespace App\Model\Providers\Services\AdminSubsystem;

use Illuminate\Support\ServiceProvider;

class EarnPlayDollarServiceProvider extends ServiceProvider{

	public function boot(){}

	public function register()
	{
		$this->app->bind('App\Model\Contracts\Interfaces\Services\AdminSubsystem\EarnPlayDollarServiceInterface', 'App\Model\Services\AdminSubsystem\EarnPlayDollarService');
	}
}