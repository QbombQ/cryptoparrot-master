<?php

namespace App\Model\Data\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Cviebrock\EloquentSluggable\Sluggable;
use Cache;
use Illuminate\Support\Str;

class User extends Authenticatable
{

    use Notifiable;
    use Sluggable;
	
	protected $guarded = ['id'];
	protected $table = 'users';

    public function sluggable()
    {
        return [
            'handle' => [
                'source' => 'fullsource',
                'method' => function ($string, $separator) {
                    return preg_replace("/[^A-Za-z0-9]/","",$string);
                }
            ]
        ];
    }

    public function getFullsourceAttribute() {
        if($this->username) {
            return $this->username;
        }
        return Str::random(40);
    } 

    public function socialMediaAccounts()
    {
        return $this->hasMany('App\Model\Data\Models\UserSocialMediaAccount');
    }	

    public function invitedUsers()
    {
        return $this->hasMany('App\Model\Data\Models\InvitedUser');
    }	   
    
    public function invitedBy()
    {
        return $this->hasOne('App\Model\Data\Models\InvitedUser', 'invited_user_id');
    }	
    
    public function trades()
    {
        return $this->hasMany('App\Model\Data\Models\Trade');
    } 

    public function exchanges()
    {
        return $this->hasMany('App\Model\Data\Models\Exchange');
    } 

    public function blockedUsers()
    {
        return $this->hasMany('App\Model\Data\Models\BlockedUser', 'blocked_by');
    }   
    
    public function blockedByUsers()
    {
        return $this->hasMany('App\Model\Data\Models\BlockedUser', 'blocked_user_id');
    }      
    
    public function notificationSettings()
    {
        return $this->hasOne('App\Model\Data\Models\UserNotificationSetting');
    }            
    
    public function followers()
    {
        return $this->hasMany('App\Model\Data\Models\Follow', 'following_id');
    }   
    
    public function followings()
    {
        return $this->hasMany('App\Model\Data\Models\Follow', 'follower_id');
    } 
    
    public function portfolios()
    {
        return $this->hasMany('App\Model\Data\Models\Portfolio', 'user_id');
    }    
    
    public function mainPortfolio()
    {
        return $this->belongsTo('App\Model\Data\Models\Portfolio', 'main_portfolio_id');
    }    
    
    public function currentPortfolio()
    {
        return $this->belongsTo('App\Model\Data\Models\Portfolio', 'current_portfolio_id');
	}
		
    public function badges()
    {
        return $this->belongsToMany('App\Model\Data\Models\Badge', 'user_badges');
    }

    public function prizes()
    {
        return $this->belongsToMany('App\Model\Data\Models\Prize', 'user_prizes');
    }

    public function userEarnPlayDollars()
    {
        return $this->hasMany('App\Model\Data\Models\UserEarnPlayDollars', 'user_id');
    }

    public function rewards()
    {
        return $this->belongsToMany('App\Model\Data\Models\Reward', 'user_rewards');
    }

    public function userRewards()
    {
        return $this->hasMany('App\Model\Data\Models\UserReward', 'user_id');
    }
    
    public function notifications()
    {
        return $this->hasMany('App\Model\Data\Models\UserNotification');
    }
    
    public function historicalPortfolioValues()
    {
        return $this->hasMany('App\Model\Data\Models\HistoricalPortfolioValue', 'user_id');
	}    
    
    public function balances()
    {
        return $this->hasMany('App\Model\Data\Models\UserBalance');
    }
    
    public function isOnline()
    {
        return Cache::has('user-is-online-' . $this->id);
    }

    public function competitions()
    {

        return $this->belongsToMany('App\Model\Data\Models\Competition', 'competition_participants');
        
    }

    public function competitionParticipants()
    {

        return $this->hasMany('App\Model\Data\Models\CompetitionParticipant');
        
    }
    
    public function initiatedConversations()
    {

        return $this->hasMany('App\Model\Data\Models\Conversation', 'initiator_id');
        
	}
	
	public function receivedConversations()
    {

        return $this->hasMany('App\Model\Data\Models\Conversation', 'recipient_id');
        
    }   

    
} 