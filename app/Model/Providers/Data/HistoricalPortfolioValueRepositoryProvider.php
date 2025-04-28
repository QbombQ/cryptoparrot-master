<?php

namespace App\Model\Providers\Data;

use Illuminate\Support\ServiceProvider;

class HistoricalPortfolioValueRepositoryProvider extends ServiceProvider{

	public function boot(){}

	public function register()
	{
		$this->app->bind('App\Model\Contracts\Interfaces\Data\HistoricalPortfolioValueRepositoryInterface', 'App\Model\Data\Repositories\HistoricalPortfolioValueRepository');
	}
}