<?php

namespace App\Model\Providers\Data;

use Illuminate\Support\ServiceProvider;

class InvitedUserRepositoryProvider extends ServiceProvider{

	public function boot(){}

	public function register()
	{
		$this->app->bind('App\Model\Contracts\Interfaces\Data\InvitedUserRepositoryInterface', 'App\Model\Data\Repositories\InvitedUserRepository');
	}
}