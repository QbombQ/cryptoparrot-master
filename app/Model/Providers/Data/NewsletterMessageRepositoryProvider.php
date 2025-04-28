<?php

namespace App\Model\Providers\Data;

use Illuminate\Support\ServiceProvider;

class NewsletterMessageRepositoryProvider extends ServiceProvider{

	public function boot(){}

	public function register()
	{
		$this->app->bind('App\Model\Contracts\Interfaces\Data\NewsletterMessageRepositoryInterface', 'App\Model\Data\Repositories\NewsletterMessageRepository');
	}
}