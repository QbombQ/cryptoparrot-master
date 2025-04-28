<?php

namespace App\Model\Providers\Data;

use Illuminate\Support\ServiceProvider;

class ArticleRepositoryProvider extends ServiceProvider{

	public function boot(){}

	public function register()
	{
		$this->app->bind('App\Model\Contracts\Interfaces\Data\ArticleRepositoryInterface', 'App\Model\Data\Repositories\ArticleRepository');
	}
}