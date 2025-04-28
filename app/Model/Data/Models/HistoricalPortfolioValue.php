<?php

namespace App\Model\Data\Models;

use Illuminate\Database\Eloquent\Model;

class HistoricalPortfolioValue extends Model{

	public $timestamps = false;
	protected $guarded = ['id'];
	protected $table = 'historical_portfolio_values';

}