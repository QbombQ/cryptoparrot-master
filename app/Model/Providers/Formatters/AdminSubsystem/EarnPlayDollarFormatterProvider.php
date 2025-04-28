<?php

namespace App\Model\Providers\Formatters\AdminSubsystem;

use Illuminate\Support\ServiceProvider;

class EarnPlayDollarFormatterProvider extends ServiceProvider{

	public function boot(){}

	public function register()
	{
		$this->app->bind('App\Model\Contracts\Interfaces\Formatters\AdminSubsystem\EarnPlayDollarFormatterInterface', 'App\Model\Formatters\AdminSubsystem\EarnPlayDollarFormatter');
	}
}