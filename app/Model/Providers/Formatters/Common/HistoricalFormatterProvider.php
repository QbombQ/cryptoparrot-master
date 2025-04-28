<?php

namespace App\Model\Providers\Formatters\Common;

use Illuminate\Support\ServiceProvider;

class HistoricalFormatterProvider extends ServiceProvider{

	public function boot(){}

	public function register()
	{
		$this->app->bind('App\Model\Contracts\Interfaces\Formatters\Common\HistoricalFormatterInterface', 'App\Model\Formatters\Common\HistoricalFormatter');
	}
}