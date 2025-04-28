<?php

namespace App\Model\Providers\Services\Common;

use Illuminate\Support\ServiceProvider;

class CompetitionPrizeServiceProvider extends ServiceProvider{

	public function boot(){}

	public function register()
	{
		$this->app->bind('App\Model\Contracts\Interfaces\Services\Common\CompetitionPrizeServiceInterface', 'App\Model\Services\Common\CompetitionPrizeService');
	}
}