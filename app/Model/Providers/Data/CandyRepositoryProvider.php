<?php

namespace App\Model\Providers\Data;

use Illuminate\Support\ServiceProvider;

class CandyRepositoryProvider extends ServiceProvider{

	public function boot()
	{}

	public function register()
	{
		$this->app->bind('App\Model\Contracts\Interfaces\Data\CandyRepositoryInterface', 'App\Model\Data\Repositories\CandyRepository');
	}
}