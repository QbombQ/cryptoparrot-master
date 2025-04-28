<?php

namespace App\Model\Providers\Validators\AdminSubsystem;

use Illuminate\Support\ServiceProvider;

class TradeValidatorProvider extends ServiceProvider{

	public function boot(){}

	public function register()
	{
		$this->app->bind('App\Model\Contracts\Interfaces\Validators\AdminSubsystem\TradeValidatorInterface', 'App\Model\Validators\AdminSubsystem\TradeValidator');
	}
}