<?php

namespace App\Model\Data\Models;

use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model{

	protected $guarded = ['id'];
	protected $table = 'portfolios';

	public function balances()
    {
        return $this->hasMany('App\Model\Data\Models\UserBalance', 'portfolio_id');
    }

    public function trades()
    {
        return $this->hasMany('App\Model\Data\Models\Trade', 'portfolio_id');
    }

}