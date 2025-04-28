<?php

namespace App\Model\Facades;

use Illuminate\Support\Facades\Facade;

class NumberFacade extends Facade {

    protected static function getFacadeAccessor() { return 'number'; }

}