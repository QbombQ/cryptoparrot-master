<?php

namespace App\Model\Data\Models;

use Illuminate\Database\Eloquent\Model;

class TradeFee extends Model{

	protected $guarded = ['id'];
	protected $table = 'trade_fees';

	public function trade()
    {

		return $this->belongsTo('App\Model\Data\Models\Trade', 'trade_id');
		
	}

	public function currency()
    {

		return $this->belongsTo('App\Model\Data\Models\Currency', 'currency_id');
		
	}

}