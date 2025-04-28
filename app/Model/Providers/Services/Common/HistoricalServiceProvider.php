<?php

namespace App\Model\Providers\Services\Common;

use Illuminate\Support\ServiceProvider;

class HistoricalServiceProvider extends ServiceProvider{

	public function boot(){}

	public function register()
	{
		$this->app->bind('App\Model\Contracts\Interfaces\Services\Common\HistoricalServiceInterface', 'App\Model\Services\Common\HistoricalService');
	}
}