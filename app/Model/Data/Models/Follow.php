<?php

namespace App\Model\Data\Models;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{

	protected $guarded = ['id'];
    protected $table = 'follows';

    public function follower()
    {
        return $this->belongsTo('App\Model\Data\Models\User', 'follower_id');
    }   

    public function following()
    {
        return $this->belongsTo('App\Model\Data\Models\User', 'following_id');
    }      
	
}