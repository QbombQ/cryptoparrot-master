<?php

namespace App\Model\Providers\Validators\AdminSubsystem;

use Illuminate\Support\ServiceProvider;

class EmailValidatorProvider extends ServiceProvider{

	public function boot(){}

	public function register()
	{
		$this->app->bind('App\Model\Contracts\Interfaces\Validators\AdminSubsystem\EmailValidatorInterface', 'App\Model\Validators\AdminSubsystem\EmailValidator');
	}
}