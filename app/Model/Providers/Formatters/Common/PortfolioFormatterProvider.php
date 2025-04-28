<?php

namespace App\Model\Providers\Formatters\Common;

use Illuminate\Support\ServiceProvider;

class PortfolioFormatterProvider extends ServiceProvider{

	public function boot(){}

	public function register()
	{
		$this->app->bind('App\Model\Contracts\Interfaces\Formatters\Common\PortfolioFormatterInterface', 'App\Model\Formatters\Common\PortfolioFormatter');
	}
}