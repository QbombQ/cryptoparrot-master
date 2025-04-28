<?php

namespace App\Model\Data\Repositories;

use App\Model\Contracts\Interfaces\Data\UserRewardsRepositoryInterface;
use App\Model\Data\Models\UserReward;
use Carbon\Carbon;

class UserRewardsRepository implements UserRewardsRepositoryInterface
{

    public function create($args)
    {

        $reward = new UserReward;
        $reward->fill($args);
        $reward->save();

    }

    public function userOrderedInDays($userId, $days)
    {

        return UserReward::where('user_id', $userId)->where('created_at', '>', Carbon::now()->subDays($days)->toDateTimeString())->exists();

    }

}