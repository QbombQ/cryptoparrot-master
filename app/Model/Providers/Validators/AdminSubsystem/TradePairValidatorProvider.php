<?php

namespace App\Model\Providers\Validators\AdminSubsystem;

use Illuminate\Support\ServiceProvider;

class TradePairValidatorProvider extends ServiceProvider{

	public function boot(){}

	public function register()
	{
		$this->app->bind('App\Model\Contracts\Interfaces\Validators\AdminSubsystem\TradePairValidatorInterface', 'App\Model\Validators\AdminSubsystem\TradePairValidator');
	}
}