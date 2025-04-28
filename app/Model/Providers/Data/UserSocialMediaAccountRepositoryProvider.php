<?php

namespace App\Model\Providers\Data;

use Illuminate\Support\ServiceProvider;

class UserSocialMediaAccountRepositoryProvider extends ServiceProvider
{

    public function boot()
    {



    }

    public function register()
    {

        $this->app->bind('App\Model\Contracts\Interfaces\Data\UserSocialMediaAccountRepositoryInterface', 'App\Model\Data\Repositories\UserSocialMediaAccountRepository');

    }
	
}