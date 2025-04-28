<?php

namespace App\Model\Providers\Formatters\Common;

use Illuminate\Support\ServiceProvider;

class ConversationFormatterProvider extends ServiceProvider{

	public function boot(){}

	public function register()
	{
		$this->app->bind('App\Model\Contracts\Interfaces\Formatters\Common\ConversationFormatterInterface', 'App\Model\Formatters\Common\ConversationFormatter');
	}
}