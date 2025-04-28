<?php

namespace App\Model\Data\Models;

use Illuminate\Database\Eloquent\Model;

class Exchange extends Model{

	protected $guarded = ['id'];
	protected $table = 'exchanges';

	public function user()
    {

        return $this->belongsTo('App\Model\Data\Models\User');
        
    }

}