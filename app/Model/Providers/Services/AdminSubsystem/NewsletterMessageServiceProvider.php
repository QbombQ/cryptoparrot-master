<?php

namespace App\Model\Providers\Services\AdminSubsystem;

use Illuminate\Support\ServiceProvider;

class NewsletterMessageServiceProvider extends ServiceProvider{

	public function boot(){}

	public function register()
	{
		$this->app->bind('App\Model\Contracts\Interfaces\Services\AdminSubsystem\NewsletterMessageServiceInterface', 'App\Model\Services\AdminSubsystem\NewsletterMessageService');
	}
}