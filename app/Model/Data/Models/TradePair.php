<?php

namespace App\Model\Data\Models;

use Illuminate\Database\Eloquent\Model;

class TradePair extends Model {

	protected $guarded = ['id'];
	protected $table = 'trade_pairs';

    public function fromCurrency()
    {
        return $this->belongsTo('App\Model\Data\Models\Currency', 'from_currency_id');
	}
	
    public function toCurrency()
    {
        return $this->belongsTo('App\Model\Data\Models\Currency', 'to_currency_id');
    }
    
    public function firstTradeWithCurrency()
    {
        return $this->belongsTo('App\Model\Data\Models\Currency', 'first_trade_with');
	}		

}