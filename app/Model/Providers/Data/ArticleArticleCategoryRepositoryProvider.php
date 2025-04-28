<?php

namespace App\Model\Providers\Data;

use Illuminate\Support\ServiceProvider;

class ArticleArticleCategoryRepositoryProvider extends ServiceProvider{

	public function boot(){}

	public function register()
	{
		$this->app->bind('App\Model\Contracts\Interfaces\Data\ArticleArticleCategoryRepositoryInterface', 'App\Model\Data\Repositories\ArticleArticleCategoryRepository');
	}
}