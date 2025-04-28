<?php

namespace App\Model\Facades;

use Illuminate\Support\Facades\Facade;

class FeedFacade extends Facade {

    protected static function getFacadeAccessor() { return 'feed'; }

}