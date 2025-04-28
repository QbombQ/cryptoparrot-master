<?php

namespace App\Model\Providers\Validators\Common;

use Illuminate\Support\ServiceProvider;

class TradeConditionValidatorProvider extends ServiceProvider{

	public function boot(){}

	public function register()
	{
		$this->app->bind('App\Model\Contracts\Interfaces\Validators\Common\TradeConditionValidatorInterface', 'App\Model\Validators\Common\TradeConditionValidator');
	}
}