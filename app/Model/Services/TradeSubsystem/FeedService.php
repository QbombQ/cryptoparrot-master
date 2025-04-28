<?php 

namespace App\Model\Services\TradeSubsystem;

use App\Model\Contracts\Interfaces\Data\UserFeedRepositoryInterface;
use App\Model\Contracts\Interfaces\Services\TradeSubsystem\FeedServiceInterface;
use App\Model\Contracts\Interfaces\Services\TradeSubsystem\TradeServiceInterface;
use Auth;

class FeedService implements FeedServiceInterface
{	

	protected $tradeService;

	public function __construct(TradeServiceInterface $tradeService) 
	{

        $this->tradeService = $tradeService;
        
    }	    

    public function getFeed($page, $timestamp, $myFeed = false)
    {

        return $this->tradeService->getTrades($page, Auth::user(), false, $timestamp, $myFeed);

    }

}