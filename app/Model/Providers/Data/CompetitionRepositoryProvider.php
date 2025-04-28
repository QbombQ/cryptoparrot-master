<?php

namespace App\Model\Providers\Data;

use Illuminate\Support\ServiceProvider;

class CompetitionRepositoryProvider extends ServiceProvider{

	public function boot(){}

	public function register()
	{
		$this->app->bind('App\Model\Contracts\Interfaces\Data\CompetitionRepositoryInterface', 'App\Model\Data\Repositories\CompetitionRepository');
	}
}