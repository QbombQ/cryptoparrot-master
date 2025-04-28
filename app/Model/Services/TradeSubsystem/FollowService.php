<?php

namespace App\Model\Services\TradeSubsystem;

use App\Model\Contracts\Interfaces\Services\TradeSubsystem\FollowServiceInterface;
use App\Model\Contracts\Interfaces\Formatters\TradeSubsystem\FollowFormatterInterface;
use App\Model\Contracts\Interfaces\Data\FollowRepositoryInterface;

class FollowService implements FollowServiceInterface
{

    protected $followRepository;
    protected $followFormatter;

	public function __construct(FollowRepositoryInterface $followRepository, FollowFormatterInterface $followFormatter) 
	{

        $this->followRepository = $followRepository;
        $this->followFormatter = $followFormatter;
        
    }	     

    public function getUserFollowers($userId)
    {

        $follows = $this->followRepository->paginateFollowers($userId);

        return $this->followFormatter->prepareFollowersForDisplay($follows);

    }

    public function getUserFollowings($userId)
    {

        $follows = $this->followRepository->paginateFollowings($userId);
        
        return $this->followFormatter->prepareFollowingsForDisplay($follows);

    }    

}