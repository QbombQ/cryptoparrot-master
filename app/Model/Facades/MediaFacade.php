<?php

namespace App\Model\Facades;

use Illuminate\Support\Facades\Facade;

class MediaFacade extends Facade {

    protected static function getFacadeAccessor() { return 'media'; }

}