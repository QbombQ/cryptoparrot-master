<?php

namespace App\Model\Contracts\Interfaces\Data;

interface FollowRepositoryInterface
{

    public function paginateFollowers($userId);

    public function paginateFollowings($userId);

    public function create($args);

    public function alreadyFollows($followingId, $followerId);

    public function delete($followingId, $followerId);

}