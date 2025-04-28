<?php

namespace App\Model\Data\Repositories;

use App\Model\Contracts\Interfaces\Data\RewardRepositoryInterface;
use App\Model\Data\Models\Reward;
use App\Model\Data\Models\UserReward;

class RewardRepository implements RewardRepositoryInterface
{

    public function paginate($limit = 24)
    {

        return Reward::orderBy('quantity', 'desc')->orderBy('price', 'desc')->orderBy('created_at', 'desc')->paginate($limit);

    }

    public function getUserReward($userRewardId)
    {

        return UserReward::findOrFail($userRewardId);

    }

    public function paginateUserRewards($limit = 10)
    {

        return UserReward::orderBy('created_at', 'desc')->paginate($limit);

    }

    public function get($id)
    {

        return Reward::find($id);

    }

    public function create($args)
    {

        $reward = new Reward;
        $reward->fill($args);
        $reward->save();

        return $reward->id;

    }

    public function update($rewardId, $data)
    {

        $reward = Reward::find($rewardId);

        if($reward)
        {

            $reward->fill($data);
            $reward->save();

        }

    }   

    public function getById($rewardId)
    {

        return Reward::findOrFail($rewardId);

    }

    public function delete($rewardId)
    {

        $reward = Reward::findOrFail($rewardId);

        if($reward)
        {

            $reward->delete();
            return true;

        }
        
        return false;

    }

}