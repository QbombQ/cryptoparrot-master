<?php

namespace App\Model\Contracts\Interfaces\Formatters\AdminSubsystem;

interface RewardFormatterInterface
{

    public function prepareRewardsForDisplay($rewards);

    public function prepareDataForCreation($data);

    public function prepareDataForUpdate($data);

    public function prepareRewardForEdit($reward);

    public function prepareUserRewardsForDisplay($userRewards);

    public function prepareFailResponse($message);

    public function prepareSuccessResponse($message);

}