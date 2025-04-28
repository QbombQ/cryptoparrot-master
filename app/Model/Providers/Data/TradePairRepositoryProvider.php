<?php

namespace App\Model\Providers\Data;

use Illuminate\Support\ServiceProvider;

class TradePairRepositoryProvider extends ServiceProvider{

	public function boot(){}

	public function register()
	{
		$this->app->bind('App\Model\Contracts\Interfaces\Data\TradePairRepositoryInterface', 'App\Model\Data\Repositories\TradePairRepository');
	}
}