<?php

namespace App\Model\Providers\Services\AdminSubsystem;

use Illuminate\Support\ServiceProvider;

class ArticleCategoryServiceProvider extends ServiceProvider{

	public function boot(){}

	public function register()
	{
		$this->app->bind('App\Model\Contracts\Interfaces\Services\AdminSubsystem\ArticleCategoryServiceInterface', 'App\Model\Services\AdminSubsystem\ArticleCategoryService');
	}
}