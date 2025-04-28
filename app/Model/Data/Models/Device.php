<?php

namespace App\Model\Data\Models;

use Illuminate\Database\Eloquent\Model;

class Device extends Model{

	protected $guarded = ['id'];
	protected $table = 'devices';

	public function user()
    {

        return $this->belongsTo('App\Model\Data\Models\User');
        
    }

}