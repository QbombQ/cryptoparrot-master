<?php

namespace App\Model\Providers\Data;

use Illuminate\Support\ServiceProvider;

class SponsorRepositoryProvider extends ServiceProvider{

	public function boot(){}

	public function register()
	{
		$this->app->bind('App\Model\Contracts\Interfaces\Data\SponsorRepositoryInterface', 'App\Model\Data\Repositories\SponsorRepository');
	}
}