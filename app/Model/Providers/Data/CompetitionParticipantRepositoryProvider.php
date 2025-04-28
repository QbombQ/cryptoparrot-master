<?php

namespace App\Model\Providers\Data;

use Illuminate\Support\ServiceProvider;

class CompetitionParticipantRepositoryProvider extends ServiceProvider{

	public function boot(){}

	public function register()
	{
		$this->app->bind('App\Model\Contracts\Interfaces\Data\CompetitionParticipantRepositoryInterface', 'App\Model\Data\Repositories\CompetitionParticipantRepository');
	}
}