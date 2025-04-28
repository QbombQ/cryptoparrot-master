<?php

namespace App\Model\Providers\Data;

use Illuminate\Support\ServiceProvider;

class ExchangeRepositoryProvider extends ServiceProvider{

	public function boot(){}

	public function register()
	{
		$this->app->bind('App\Model\Contracts\Interfaces\Data\ExchangeRepositoryInterface', 'App\Model\Data\Repositories\ExchangeRepository');
	}
}