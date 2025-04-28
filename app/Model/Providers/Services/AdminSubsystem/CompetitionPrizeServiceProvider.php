<?php

namespace App\Model\Providers\Services\AdminSubsystem;

use Illuminate\Support\ServiceProvider;

class CompetitionPrizeServiceProvider extends ServiceProvider{

	public function boot(){}

	public function register()
	{
		$this->app->bind('App\Model\Contracts\Interfaces\Services\AdminSubsystem\CompetitionPrizeServiceInterface', 'App\Model\Services\AdminSubsystem\CompetitionPrizeService');
	}
}