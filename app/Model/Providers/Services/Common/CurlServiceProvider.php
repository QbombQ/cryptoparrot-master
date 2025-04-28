<?php

namespace App\Model\Providers\Services\Common;

use Illuminate\Support\ServiceProvider;

class CurlServiceProvider extends ServiceProvider{

	public function boot(){}

	public function register()
	{
		$this->app->bind('App\Model\Contracts\Interfaces\Services\Common\CurlServiceInterface', 'App\Model\Services\Common\CurlService');
	}
}