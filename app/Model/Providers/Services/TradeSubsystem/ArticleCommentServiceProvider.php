<?php

namespace App\Model\Providers\Services\TradeSubsystem;

use Illuminate\Support\ServiceProvider;

class ArticleCommentServiceProvider extends ServiceProvider{

	public function boot(){}

	public function register()
	{
		$this->app->bind('App\Model\Contracts\Interfaces\Services\TradeSubsystem\ArticleCommentServiceInterface', 'App\Model\Services\TradeSubsystem\ArticleCommentService');
	}
}