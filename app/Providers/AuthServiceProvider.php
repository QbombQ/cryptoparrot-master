<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Model\Data\Models\Account;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('cancel-trade', function ($user, $trade) {
            return $user->id === $trade->user_id;
        });
        Gate::define('edit-portfolio', function ($user, $portfolio) {
            return $user->id === $portfolio->user_id;
        });
        Gate::define('edit-lesson', function ($user, $lesson) {
            return $user->id === $lesson->user_id;
        });   
        Gate::define('use-portfolio', function ($user, $portfolio) {
            return $user->id === $portfolio->user_id;
        });
        Gate::define('view-conversation', function ($user, $conversation) {
            $isParticipant = false;
            if($user->id == $conversation->recipient_id) {
                $isParticipant = true;
                $hasBlocked = $user->blockedUsers->contains('blocked_user_id', $conversation->initiator_id) || $user->blockedByUsers->contains('blocked_by', $conversation->initiator_id);
            }
            if($user->id == $conversation->initiator_id) {
                $isParticipant = true;
                $hasBlocked = $user->blockedUsers->contains('blocked_user_id', $conversation->recipient_id) || $user->blockedByUsers->contains('blocked_by', $conversation->recipient_id);
            }            
            return $isParticipant && !$hasBlocked;
        });
    }
}
