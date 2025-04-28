<?php

namespace App\Model\Providers\Validators\Common;

use Illuminate\Support\ServiceProvider;

class PortfolioValidatorProvider extends ServiceProvider{

	public function boot(){}

	public function register()
	{
		$this->app->bind('App\Model\Contracts\Interfaces\Validators\Common\PortfolioValidatorInterface', 'App\Model\Validators\Common\PortfolioValidator');
	}
}