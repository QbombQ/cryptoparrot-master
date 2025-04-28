<?php

namespace App\Model\Providers\Data;

use Illuminate\Support\ServiceProvider;

class TradeCommentVoteRepositoryProvider extends ServiceProvider{

	public function boot(){}

	public function register()
	{
		$this->app->bind('App\Model\Contracts\Interfaces\Data\TradeCommentVoteRepositoryInterface', 'App\Model\Data\Repositories\TradeCommentVoteRepository');
	}
}