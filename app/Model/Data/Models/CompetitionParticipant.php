<?php

namespace App\Model\Data\Models;

use Illuminate\Database\Eloquent\Model;

class CompetitionParticipant extends Model{

	protected $guarded = ['id'];
	protected $table = 'competition_participants';

    public function user()
    {
        return $this->belongsTo('App\Model\Data\Models\User', 'user_id');
    }  
    
    public function competition()
    {
        return $this->belongsTo('App\Model\Data\Models\Competition', 'competition_id');
    }   
    
    public function portfolio()
    {
        return $this->belongsTo('App\Model\Data\Models\Portfolio', 'portfolio_id');
	}      


}