<?php

namespace App\Model\Providers\Services\Common;

use Illuminate\Support\ServiceProvider;

class BroadcastServiceProvider extends ServiceProvider{

	public function boot(){}

	public function register()
	{
		$this->app->bind('App\Model\Contracts\Interfaces\Services\Common\BroadcastServiceInterface', 'App\Model\Services\Common\BroadcastService');
	}
}