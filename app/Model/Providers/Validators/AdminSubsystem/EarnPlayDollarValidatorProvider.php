<?php

namespace App\Model\Providers\Validators\AdminSubsystem;

use Illuminate\Support\ServiceProvider;

class EarnPlayDollarValidatorProvider extends ServiceProvider{

	public function boot(){}

	public function register()
	{
		$this->app->bind('App\Model\Contracts\Interfaces\Validators\AdminSubsystem\EarnPlayDollarValidatorInterface', 'App\Model\Validators\AdminSubsystem\EarnPlayDollarValidator');
	}
}