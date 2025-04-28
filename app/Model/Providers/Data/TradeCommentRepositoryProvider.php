<?php

namespace App\Model\Providers\Data;

use Illuminate\Support\ServiceProvider;

class TradeCommentRepositoryProvider extends ServiceProvider{

	public function boot(){}

	public function register()
	{
		$this->app->bind('App\Model\Contracts\Interfaces\Data\TradeCommentRepositoryInterface', 'App\Model\Data\Repositories\TradeCommentRepository');
	}
}