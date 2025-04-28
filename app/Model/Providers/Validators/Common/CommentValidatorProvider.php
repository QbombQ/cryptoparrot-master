<?php

namespace App\Model\Providers\Validators\Common;

use Illuminate\Support\ServiceProvider;

class CommentValidatorProvider extends ServiceProvider
{

    public function boot()
    {



    }

    public function register()
    {

        $this->app->bind('App\Model\Contracts\Interfaces\Validators\Common\CommentValidatorInterface', 'App\Model\Validators\Common\CommentValidator');

    }
	
}