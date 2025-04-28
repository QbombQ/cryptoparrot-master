<?php

namespace App\Model\Providers\Data;

use Illuminate\Support\ServiceProvider;

class PortfolioRepositoryProvider extends ServiceProvider{

	public function boot(){}

	public function register()
	{
		$this->app->bind('App\Model\Contracts\Interfaces\Data\PortfolioRepositoryInterface', 'App\Model\Data\Repositories\PortfolioRepository');
	}
}