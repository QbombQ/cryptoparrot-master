<?php

namespace App\Model\Data\Models;

use Illuminate\Database\Eloquent\Model;

class Trade extends Model
{

	protected $guarded = ['id'];
    protected $table = 'trades';

    public function tradePair()
    {
        return $this->belongsTo('App\Model\Data\Models\TradePair', 'trade_pair_id');
    } 
    
    public function author()
    {
        return $this->belongsTo('App\Model\Data\Models\User', 'user_id');
    }    
    
    public function portfolio()
    {
        return $this->belongsTo('App\Model\Data\Models\Portfolio', 'portfolio_id');
    } 
    
    public function comments()
    {
        return $this->hasMany('App\Model\Data\Models\TradeComment', 'trade_id');
    }      

    public function tradeCondition()
    {
        return $this->hasOne('App\Model\Data\Models\TradeCondition', 'trade_id');
    }      

    public function tradeFee()
    {
        return $this->hasOne('App\Model\Data\Models\TradeFee', 'trade_id');
    }     

    public function getTotalTradeValue()
    {

        $leverage = $this->leverage === 0 ? 1 : $this->leverage;
        return $this->amount / $leverage * $this->target_price;

    }

    public function notifications()
    {
        return $this->morphMany('App\Model\Data\Models\UserNotification', 'item')->orderBy('created_at', 'desc');
    }

}