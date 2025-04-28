<?php

namespace App\Model\Data\Models;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model{

	protected $guarded = ['id'];
	protected $table = 'conversations';

	public function initiator()
    {

        return $this->belongsTo('App\Model\Data\Models\User');
        
    }	
    		
    public function recipient()
    {

        return $this->belongsTo('App\Model\Data\Models\User');
        
    }

    public function messages()
    {

        return $this->hasMany('App\Model\Data\Models\ConversationMessage');
        
    } 

}