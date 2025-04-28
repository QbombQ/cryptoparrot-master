<?php

namespace App\Model\Contracts\Interfaces\Services\AdminSubsystem;

interface RewardServiceInterface
{

    public function paginate($limit);

    public function updateUserRewardStatus($data);

    public function paginateUserRewards($limit);

    public function create($data);

    public function edit($data);

    public function getForEdit($rewardId);

    public function delete($rewardId);

}