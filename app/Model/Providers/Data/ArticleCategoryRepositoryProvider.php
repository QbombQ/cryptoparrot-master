<?php

namespace App\Model\Providers\Data;

use Illuminate\Support\ServiceProvider;

class ArticleCategoryRepositoryProvider extends ServiceProvider{

	public function boot(){}

	public function register()
	{
		$this->app->bind('App\Model\Contracts\Interfaces\Data\ArticleCategoryRepositoryInterface', 'App\Model\Data\Repositories\ArticleCategoryRepository');
	}
}