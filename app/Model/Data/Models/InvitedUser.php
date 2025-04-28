<?php

namespace App\Model\Data\Models;

use Illuminate\Database\Eloquent\Model;

class InvitedUser extends Model{

	protected $guarded = ['id'];
	protected $table = 'invited_users';

    public function invitedUser()
    {
        return $this->belongsTo('App\Model\Data\Models\User', 'invited_user_id');
    }

    public function invitedByUser()
    {
        return $this->belongsTo('App\Model\Data\Models\User', 'user_id');
    }

}