<?php

namespace App\Model\Providers\Services\Common;

use Illuminate\Support\ServiceProvider;

class HtmlParserServiceProvider extends ServiceProvider{

	public function boot(){}

	public function register()
	{
		$this->app->bind('App\Model\Contracts\Interfaces\Services\Common\HtmlParserServiceInterface', 'App\Model\Services\Common\HtmlParserService');
	}
}