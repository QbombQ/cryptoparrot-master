<?php

namespace App\Model\Data\Models;

use Illuminate\Database\Eloquent\Model;

class UserNotification extends Model
{

	protected $guarded = ['id'];
    protected $table = 'user_notifications';
    
    public function type()
    {
        return $this->belongsTo('App\Model\Data\Models\NotificationType', 'type_id');
    }

    public function user()
    {
        return $this->belongsTo('App\Model\Data\Models\User', 'user_id');
    }

    public function item()
    {
        return $this->morphTo();
    }

}