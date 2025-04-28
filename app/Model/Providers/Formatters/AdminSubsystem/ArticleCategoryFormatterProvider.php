<?php

namespace App\Model\Providers\Formatters\AdminSubsystem;

use Illuminate\Support\ServiceProvider;

class ArticleCategoryFormatterProvider extends ServiceProvider{

	public function boot(){}

	public function register()
	{
		$this->app->bind('App\Model\Contracts\Interfaces\Formatters\AdminSubsystem\ArticleCategoryFormatterInterface', 'App\Model\Formatters\AdminSubsystem\ArticleCategoryFormatter');
	}
}