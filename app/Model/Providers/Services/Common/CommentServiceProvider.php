<?php

namespace App\Model\Providers\Services\Common;

use Illuminate\Support\ServiceProvider;

class CommentServiceProvider extends ServiceProvider
{

    public function boot()
    {



    }

    public function register()
    {

        $this->app->bind('App\Model\Contracts\Interfaces\Services\Common\CommentServiceInterface', 'App\Model\Services\Common\CommentService');

    }
	
}