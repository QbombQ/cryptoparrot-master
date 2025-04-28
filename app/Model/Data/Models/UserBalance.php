<?php

namespace App\Model\Data\Models;

use Illuminate\Database\Eloquent\Model;

class UserBalance extends Model
{

	protected $guarded = ['id'];
    protected $table = 'user_balances';

    public function currency()
    {
        return $this->belongsTo('App\Model\Data\Models\Currency');
    }
    
    public function user()
    {
        return $this->belongsTo('App\Model\Data\Models\User');
    }     
    
    public function portfolio()
    {
        return $this->belongsTo('App\Model\Data\Models\Portfolio');
    }   
  
}