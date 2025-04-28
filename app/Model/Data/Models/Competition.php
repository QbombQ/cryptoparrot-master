<?php

namespace App\Model\Data\Models;

use Illuminate\Database\Eloquent\Model;

class Competition extends Model{

	protected $guarded = ['id'];
	protected $table = 'competitions';

    public function badges()
    {

        return $this->belongsToMany('App\Model\Data\Models\Badge', 'competition_badges');
        
    }   
    
    public function participants()
    {

        return $this->belongsToMany('App\Model\Data\Models\User', 'competition_participants');
        
    }   
    
    public function competitionParticipants()
    {

        return $this->hasMany('App\Model\Data\Models\CompetitionParticipant', 'competition_id');
        
    }  
    
    public function prizes()
    {

        return $this->hasMany('App\Model\Data\Models\CompetitionPrize', 'competition_id');
                
    }    

}