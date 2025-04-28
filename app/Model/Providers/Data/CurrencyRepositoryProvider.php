<?php

namespace App\Model\Providers\Data;

use Illuminate\Support\ServiceProvider;

class CurrencyRepositoryProvider extends ServiceProvider{

	public function boot(){}

	public function register()
	{
		$this->app->bind('App\Model\Contracts\Interfaces\Data\CurrencyRepositoryInterface', 'App\Model\Data\Repositories\CurrencyRepository');
	}
}