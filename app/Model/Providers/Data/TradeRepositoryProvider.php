<?php

namespace App\Model\Providers\Data;

use Illuminate\Support\ServiceProvider;

class TradeRepositoryProvider extends ServiceProvider{

	public function boot(){}

	public function register()
	{
		$this->app->bind('App\Model\Contracts\Interfaces\Data\TradeRepositoryInterface', 'App\Model\Data\Repositories\TradeRepository');
	}
}