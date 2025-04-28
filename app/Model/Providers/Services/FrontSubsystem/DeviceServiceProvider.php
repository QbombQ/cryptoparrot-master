<?php

namespace App\Model\Providers\Services\FrontSubsystem;

use Illuminate\Support\ServiceProvider;

class DeviceServiceProvider extends ServiceProvider{

	public function boot(){}

	public function register()
	{
		$this->app->bind('App\Model\Contracts\Interfaces\Services\FrontSubsystem\DeviceServiceInterface', 'App\Model\Services\FrontSubsystem\DeviceService');
	}
}