<?php

namespace App\Model\Providers\Validators\Common;

use Illuminate\Support\ServiceProvider;

class ExchangeValidatorProvider extends ServiceProvider{

	public function boot(){}

	public function register()
	{
		$this->app->bind('App\Model\Contracts\Interfaces\Validators\Common\ExchangeValidatorInterface', 'App\Model\Validators\Common\ExchangeValidator');
	}
}