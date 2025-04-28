<?php

namespace App\Model\Facades;

use Illuminate\Support\Facades\Facade;

class PaginationFacade extends Facade {

    protected static function getFacadeAccessor() { return 'pagination'; }

}