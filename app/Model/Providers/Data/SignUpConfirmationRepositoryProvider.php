<?php

namespace App\Model\Providers\Data;

use Illuminate\Support\ServiceProvider;

class SignUpConfirmationRepositoryProvider extends ServiceProvider
{

    public function boot()
    {



    }

    public function register()
    {

        $this->app->bind('App\Model\Contracts\Interfaces\Data\SignUpConfirmationRepositoryInterface', 'App\Model\Data\Repositories\SignUpConfirmationRepository');

    }
	
}