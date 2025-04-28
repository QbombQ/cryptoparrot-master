<?php

namespace App\Model\Data\Models;

use Illuminate\Database\Eloquent\Model;

class TradeComment extends Model{

	protected $guarded = ['id'];
	protected $table = 'trade_comments';

    public function author()
    {
        return $this->belongsTo('App\Model\Data\Models\User', 'user_id');
    } 
    
    public function trade()
    {
        return $this->belongsTo('App\Model\Data\Models\Trade', 'trade_id');
	}     
	
    public function replies()
    {
        return $this->hasMany('App\Model\Data\Models\TradeComment', 'reply_to');
    }     		

}