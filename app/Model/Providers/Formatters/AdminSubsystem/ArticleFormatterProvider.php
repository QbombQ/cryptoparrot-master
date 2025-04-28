<?php

namespace App\Model\Providers\Formatters\AdminSubsystem;

use Illuminate\Support\ServiceProvider;

class ArticleFormatterProvider extends ServiceProvider{

	public function boot(){}

	public function register()
	{
		$this->app->bind('App\Model\Contracts\Interfaces\Formatters\AdminSubsystem\ArticleFormatterInterface', 'App\Model\Formatters\AdminSubsystem\ArticleFormatter');
	}
}