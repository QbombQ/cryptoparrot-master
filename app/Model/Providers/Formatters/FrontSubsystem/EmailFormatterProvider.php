<?php

namespace App\Model\Providers\Formatters\FrontSubsystem;

use Illuminate\Support\ServiceProvider;

class EmailFormatterProvider extends ServiceProvider
{

    public function boot()
    {



    }

    public function register()
    {

        $this->app->bind('App\Model\Contracts\Interfaces\Formatters\FrontSubsystem\EmailFormatterInterface', 'App\Model\Formatters\FrontSubsystem\EmailFormatter');

    }
	
}