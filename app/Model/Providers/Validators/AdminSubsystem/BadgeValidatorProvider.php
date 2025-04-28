<?php

namespace App\Model\Providers\Validators\AdminSubsystem;

use Illuminate\Support\ServiceProvider;

class BadgeValidatorProvider extends ServiceProvider{

	public function boot(){}

	public function register()
	{
		$this->app->bind('App\Model\Contracts\Interfaces\Validators\AdminSubsystem\BadgeValidatorInterface', 'App\Model\Validators\AdminSubsystem\BadgeValidator');
	}
}