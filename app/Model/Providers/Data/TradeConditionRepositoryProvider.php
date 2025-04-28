<?php

namespace App\Model\Providers\Data;

use Illuminate\Support\ServiceProvider;

class TradeConditionRepositoryProvider extends ServiceProvider{

	public function boot(){}

	public function register()
	{
		$this->app->bind('App\Model\Contracts\Interfaces\Data\TradeConditionRepositoryInterface', 'App\Model\Data\Repositories\TradeConditionRepository');
	}
}