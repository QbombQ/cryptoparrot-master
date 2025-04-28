<?php

namespace App\Model\Data\Repositories;

use App\Model\Contracts\Interfaces\Data\FollowRepositoryInterface;
use App\Model\Data\Models\Follow;

class FollowRepository implements FollowRepositoryInterface
{

    public function alreadyFollows($followingId, $followerId)
    {

        return Follow::where('following_id', $followingId)->where('follower_id', $followerId)->exists();

    }    

    public function paginateFollowers($userId)
    {

        return Follow::where('following_id', $userId)->orderBy('created_at', 'desc')->paginate(12);

    }

    public function paginateFollowings($userId)
    {

        return Follow::where('follower_id', $userId)->orderBy('created_at', 'desc')->paginate(12);

    }    

    public function create($args)
    {

        $follow = new Follow;
        $follow->fill($args);
        $follow->save();

    }

    public function delete($followingId, $followerId)
    {

        Follow::where('following_id', $followingId)->where('follower_id', $followerId)->delete();

    }

}