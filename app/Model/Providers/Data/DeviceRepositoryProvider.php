<?php

namespace App\Model\Providers\Data;

use Illuminate\Support\ServiceProvider;

class DeviceRepositoryProvider extends ServiceProvider{

	public function boot(){}

	public function register()
	{
		$this->app->bind('App\Model\Contracts\Interfaces\Data\DeviceRepositoryInterface', 'App\Model\Data\Repositories\DeviceRepository');
	}
}