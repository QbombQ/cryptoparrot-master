<?php

namespace App\Model\Data\Models;

use Illuminate\Database\Eloquent\Model;

class UserReward extends Model{

	protected $guarded = ['id'];
	protected $table = 'user_rewards';

	public function reward()
    {
        return $this->belongsTo('App\Model\Data\Models\Reward', 'reward_id');
	}    

	public function user()
    {
        return $this->belongsTo('App\Model\Data\Models\User', 'user_id');
	}    

}