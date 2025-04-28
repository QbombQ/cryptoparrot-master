<?php

namespace App\Model\Providers\Validators\AdminSubsystem;

use Illuminate\Support\ServiceProvider;

class RewardValidatorProvider extends ServiceProvider{

	public function boot(){}

	public function register()
	{
		$this->app->bind('App\Model\Contracts\Interfaces\Validators\AdminSubsystem\RewardValidatorInterface', 'App\Model\Validators\AdminSubsystem\RewardValidator');
	}
}