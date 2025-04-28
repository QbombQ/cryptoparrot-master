<?php

namespace App\Model\Data\Models;

use Illuminate\Database\Eloquent\Model;

class TradeVote extends Model{

	protected $guarded = ['id'];
	protected $table = 'trade_votes';

    public function trade()
    {
        return $this->belongsTo('App\Model\Data\Models\Trade', 'trade_id');
	}   	

    public function author()
    {
        return $this->belongsTo('App\Model\Data\Models\User', 'user_id');
    } 	

}