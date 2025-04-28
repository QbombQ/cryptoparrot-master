<?php

namespace App\Model\Providers\Validators\Common;

use Illuminate\Support\ServiceProvider;

class ConversationMessageValidatorProvider extends ServiceProvider{

	public function boot(){}

	public function register()
	{
		$this->app->bind('App\Model\Contracts\Interfaces\Validators\Common\ConversationMessageValidatorInterface', 'App\Model\Validators\Common\ConversationMessageValidator');
	}
}