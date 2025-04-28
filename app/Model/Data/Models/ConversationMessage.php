<?php

namespace App\Model\Data\Models;

use Illuminate\Database\Eloquent\Model;

class ConversationMessage extends Model{

	protected $guarded = ['id'];
	protected $table = 'conversation_messages';

}