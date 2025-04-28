<?php

namespace App\Model\Providers\Formatters\AdminSubsystem;

use Illuminate\Support\ServiceProvider;

class InvitedUserFormatterProvider extends ServiceProvider{

	public function boot(){}

	public function register()
	{
		$this->app->bind('App\Model\Contracts\Interfaces\Formatters\AdminSubsystem\InvitedUserFormatterInterface', 'App\Model\Formatters\AdminSubsystem\InvitedUserFormatter');
	}
}