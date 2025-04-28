<?php

namespace App\Model\Providers\Formatters\Common;

use Illuminate\Support\ServiceProvider;

class NumberFormatterProvider extends ServiceProvider
{

    public function boot()
    {



    }

    public function register()
    {

        $this->app->bind('App\Model\Contracts\Interfaces\Formatters\Common\NumberFormatterInterface', 'App\Model\Formatters\Common\NumberFormatter');

    }
	
}