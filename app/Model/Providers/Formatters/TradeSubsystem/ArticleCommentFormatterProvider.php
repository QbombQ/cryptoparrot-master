<?php

namespace App\Model\Providers\Formatters\TradeSubsystem;

use Illuminate\Support\ServiceProvider;

class ArticleCommentFormatterProvider extends ServiceProvider{

	public function boot(){}

	public function register()
	{
		$this->app->bind('App\Model\Contracts\Interfaces\Formatters\TradeSubsystem\ArticleCommentFormatterInterface', 'App\Model\Formatters\TradeSubsystem\ArticleCommentFormatter');
	}
}