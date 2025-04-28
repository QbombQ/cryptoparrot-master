<?php

namespace App\Model\Data\Models;

use Illuminate\Database\Eloquent\Model;

class UserBadge extends Model
{

	protected $guarded = ['id'];
    protected $table = 'user_badges';
  
    public function user()
    {
        return $this->belongsTo('App\Model\Data\Models\User', 'user_id');
    } 
    
    public function badge()
    {
        return $this->belongsTo('App\Model\Data\Models\Badge', 'badge_id');
	}    
	
}