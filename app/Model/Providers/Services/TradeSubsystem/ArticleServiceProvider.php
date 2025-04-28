<?php

namespace App\Model\Providers\Services\TradeSubsystem;

use Illuminate\Support\ServiceProvider;

class ArticleServiceProvider extends ServiceProvider{

	public function boot(){}

	public function register()
	{
		$this->app->bind('App\Model\Contracts\Interfaces\Services\TradeSubsystem\ArticleServiceInterface', 'App\Model\Services\TradeSubsystem\ArticleService');
	}
}