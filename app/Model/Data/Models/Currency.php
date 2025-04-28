<?php

namespace App\Model\Data\Models;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{

	protected $guarded = ['id'];
    protected $table = 'currencies';
	
}