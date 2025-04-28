<?php

namespace App\Model\Providers\Data;

use Illuminate\Support\ServiceProvider;

class CompetitionPrizeRepositoryProvider extends ServiceProvider{

	public function boot(){}

	public function register()
	{
		$this->app->bind('App\Model\Contracts\Interfaces\Data\CompetitionPrizeRepositoryInterface', 'App\Model\Data\Repositories\CompetitionPrizeRepository');
	}
}