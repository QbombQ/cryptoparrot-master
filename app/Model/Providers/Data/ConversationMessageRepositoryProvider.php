<?php

namespace App\Model\Providers\Data;

use Illuminate\Support\ServiceProvider;

class ConversationMessageRepositoryProvider extends ServiceProvider{

	public function boot(){}

	public function register()
	{
		$this->app->bind('App\Model\Contracts\Interfaces\Data\ConversationMessageRepositoryInterface', 'App\Model\Data\Repositories\ConversationMessageRepository');
	}
}