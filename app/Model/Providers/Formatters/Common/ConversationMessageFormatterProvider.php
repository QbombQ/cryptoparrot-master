<?php

namespace App\Model\Providers\Formatters\Common;

use Illuminate\Support\ServiceProvider;

class ConversationMessageFormatterProvider extends ServiceProvider{

	public function boot(){}

	public function register()
	{
		$this->app->bind('App\Model\Contracts\Interfaces\Formatters\Common\ConversationMessageFormatterInterface', 'App\Model\Formatters\Common\ConversationMessageFormatter');
	}
}