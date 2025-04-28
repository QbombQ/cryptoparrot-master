<?php

namespace App\Model\Providers\Services\AdminSubsystem;

use Illuminate\Support\ServiceProvider;

class CurrencyServiceProvider extends ServiceProvider{

	public function boot(){}

	public function register()
	{
		$this->app->bind('App\Model\Contracts\Interfaces\Services\AdminSubsystem\CurrencyServiceInterface', 'App\Model\Services\AdminSubsystem\CurrencyService');
	}
}