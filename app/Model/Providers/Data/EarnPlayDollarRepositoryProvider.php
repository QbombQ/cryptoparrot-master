<?php

namespace App\Model\Providers\Data;

use Illuminate\Support\ServiceProvider;

class EarnPlayDollarRepositoryProvider extends ServiceProvider{

	public function boot(){}

	public function register()
	{
		$this->app->bind('App\Model\Contracts\Interfaces\Data\EarnPlayDollarRepositoryInterface', 'App\Model\Data\Repositories\EarnPlayDollarRepository');
	}
}