<?php

namespace App\Model\Providers\Data;

use Illuminate\Support\ServiceProvider;

class CompetitionBadgeRepositoryProvider extends ServiceProvider{

	public function boot(){}

	public function register()
	{
		$this->app->bind('App\Model\Contracts\Interfaces\Data\CompetitionBadgeRepositoryInterface', 'App\Model\Data\Repositories\CompetitionBadgeRepository');
	}
}