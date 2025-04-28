<?php

namespace App\Model\Providers\Services\Common;

use Illuminate\Support\ServiceProvider;

class FileServiceProvider extends ServiceProvider
{

    public function boot()
    {



    }

    public function register()
    {

        $this->app->bind('App\Model\Contracts\Interfaces\Services\Common\FileServiceInterface', 'App\Model\Services\Common\FileService');

    }
	
}