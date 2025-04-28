<?php

namespace App\Model\Data\Models;

use Illuminate\Database\Eloquent\Model;

class Reward extends Model{

	protected $guarded = ['id'];
	protected $table = 'rewards';

	public function sponsor()
    {
        return $this->belongsTo('App\Model\Data\Models\Sponsor', 'sponsor_id');
	}  	

}