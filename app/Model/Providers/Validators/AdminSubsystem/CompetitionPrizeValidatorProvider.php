<?php

namespace App\Model\Providers\Validators\AdminSubsystem;

use Illuminate\Support\ServiceProvider;

class CompetitionPrizeValidatorProvider extends ServiceProvider{

	public function boot(){}

	public function register()
	{
		$this->app->bind('App\Model\Contracts\Interfaces\Validators\AdminSubsystem\CompetitionPrizeValidatorInterface', 'App\Model\Validators\AdminSubsystem\CompetitionPrizeValidator');
	}
}