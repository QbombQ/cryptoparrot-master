<?php

namespace App\Model\Providers\Formatters\Common;

use Illuminate\Support\ServiceProvider;

class CompetitionPrizeFormatterProvider extends ServiceProvider{

	public function boot(){}

	public function register()
	{
		$this->app->bind('App\Model\Contracts\Interfaces\Formatters\Common\CompetitionPrizeFormatterInterface', 'App\Model\Formatters\Common\CompetitionPrizeFormatter');
	}
}