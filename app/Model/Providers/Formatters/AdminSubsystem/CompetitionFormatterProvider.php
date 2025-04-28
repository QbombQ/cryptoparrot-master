<?php

namespace App\Model\Providers\Formatters\AdminSubsystem;

use Illuminate\Support\ServiceProvider;

class CompetitionFormatterProvider extends ServiceProvider{

	public function boot(){}

	public function register()
	{
		$this->app->bind('App\Model\Contracts\Interfaces\Formatters\AdminSubsystem\CompetitionFormatterInterface', 'App\Model\Formatters\AdminSubsystem\CompetitionFormatter');
	}
}