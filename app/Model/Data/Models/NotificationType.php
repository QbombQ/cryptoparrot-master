<?php

namespace App\Model\Data\Models;

use Illuminate\Database\Eloquent\Model;

class NotificationType extends Model{

	public $timestamps = false;
	protected $guarded = ['id'];
	protected $table = 'notification_types';

}