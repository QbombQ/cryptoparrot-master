<?php

namespace App\Model\Data\Models;

use Illuminate\Database\Eloquent\Model;

class PasswordRecoveryConfirmation extends Model{

	protected $guarded = ['id'];
	protected $table = 'password_recovery_confirmations';

}