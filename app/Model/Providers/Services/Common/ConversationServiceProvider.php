<?php

namespace App\Model\Providers\Services\Common;

use Illuminate\Support\ServiceProvider;

class ConversationServiceProvider extends ServiceProvider{

	public function boot(){}

	public function register()
	{
		$this->app->bind('App\Model\Contracts\Interfaces\Services\Common\ConversationServiceInterface', 'App\Model\Services\Common\ConversationService');
	}
}