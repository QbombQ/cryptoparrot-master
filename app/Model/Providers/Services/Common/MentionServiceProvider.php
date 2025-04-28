<?php

namespace App\Model\Providers\Services\Common;

use Illuminate\Support\ServiceProvider;

class MentionServiceProvider extends ServiceProvider{

	public function boot(){}

	public function register()
	{
		$this->app->bind('App\Model\Contracts\Interfaces\Services\Common\MentionServiceInterface', 'App\Model\Services\Common\MentionService');
	}
}