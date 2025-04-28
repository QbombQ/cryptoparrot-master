<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use App\Model\Observers\UserObserver;
use App\Model\Observers\TradeCommentObserver;
use App\Model\Observers\TradeVoteObserver;
use App\Model\Observers\TradeObserver;
use App\Model\Observers\FollowObserver;
use App\Model\Observers\UserBadgeObserver;
use App\Model\Observers\UserBalanceObserver;
use App\Model\Observers\UserRewardObserver;
use App\Model\Observers\UserNotificationObserver;
use App\Model\Observers\ExchangeObserver;
use App\Model\Observers\TradeFeeObserver;
use App\Model\Data\Models\User;
use App\Model\Data\Models\UserNotification;
use App\Model\Data\Models\TradeComment;
use App\Model\Data\Models\TradeVote;
use App\Model\Data\Models\Trade;
use App\Model\Data\Models\Follow;
use App\Model\Data\Models\UserBadge;
use App\Model\Data\Models\UserBalance;
use App\Model\Data\Models\UserReward;
use App\Model\Data\Models\Exchange;
use App\Model\Data\Models\TradeFee;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Relations\Relation;
//use Laravel\Dusk\DuskServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /** 
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
		if(env('APP_ENV') !== "testing") {
            User::observe(UserObserver::class);
            TradeComment::observe(TradeCommentObserver::class);
            TradeVote::observe(TradeVoteObserver::class);
            Trade::observe(TradeObserver::class);
            Follow::observe(FollowObserver::class);
            UserNotification::observe(UserNotificationObserver::class);
            UserBadge::observe(UserBadgeObserver::class);
            UserBalance::observe(UserBalanceObserver::class);
            UserReward::observe(UserRewardObserver::class);
            Exchange::observe(ExchangeObserver::class);
            TradeFee::observe(TradeFeeObserver::class);

            Relation::morphMap([
                'Trade' => 'App\Model\Data\Models\Trade'
            ]);

        }            
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment('local', 'testing')) {
            //$this->app->register(DuskServiceProvider::class);
        }        
    }
}
