<?php

namespace App\Model\Facades;

use Illuminate\Support\Facades\Facade;

class BalanceFacade extends Facade {

    protected static function getFacadeAccessor() { return 'balance'; }

}