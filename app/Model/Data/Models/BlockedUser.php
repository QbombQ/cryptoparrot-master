<?php

namespace App\Model\Data\Models;

use Illuminate\Database\Eloquent\Model;

class BlockedUser extends Model{

	protected $guarded = ['id'];
	protected $table = 'blocked_users';

	public function blockedUser()
    {

        return $this->belongsTo('App\Model\Data\Models\User', 'blocked_user_id');
        
	}
	
	public function blockedByUser()
    {

        return $this->belongsTo('App\Model\Data\Models\User', 'blocked_by');
        
    }

}