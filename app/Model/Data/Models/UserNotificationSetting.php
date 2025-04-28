<?php

namespace App\Model\Data\Models;

use Illuminate\Database\Eloquent\Model;

class UserNotificationSetting extends Model{

	protected $guarded = ['id'];
	protected $table = 'user_notification_settings';

}