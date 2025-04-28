<?php

namespace App\Model\Providers\Formatters\FrontSubsystem;

use Illuminate\Support\ServiceProvider;

class UserFormatterProvider extends ServiceProvider
{

    public function boot()
    {



    }

    public function register()
    {

        $this->app->bind('App\Model\Contracts\Interfaces\Formatters\FrontSubsystem\UserFormatterInterface', 'App\Model\Formatters\FrontSubsystem\UserFormatter');

    }
	
}