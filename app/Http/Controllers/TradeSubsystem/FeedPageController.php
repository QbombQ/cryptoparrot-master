<?php

namespace App\Http\Controllers\TradeSubsystem;

use App\Http\Controllers\TradeSubsystem\BaseTradeSubsystemController;
use App\Model\Contracts\Interfaces\Formatters\TradeSubsystem\UserFormatterInterface;
use App\Model\Contracts\Interfaces\Services\TradeSubsystem\FeedServiceInterface;
use App\Model\Contracts\Interfaces\Services\TradeSubsystem\ArticleServiceInterface;
use Carbon\Carbon;
use Feed;

class FeedPageController extends BaseTradeSubsystemController
{

	protected $feedService;
	protected $articleService;

	const TIMESTAMP_OFFSET_SECONDS = 5;

	public function __construct(
		UserFormatterInterface $userFormatter,
		FeedServiceInterface $feedService,
		ArticleServiceInterface $articleService
	) 
	{

		parent::__construct($userFormatter);
		$this->feedService = $feedService;
		$this->articleService = $articleService;
		
	}    
	
	public function load($page = "1")
	{

		parent::getCommonData();

		$timestamp = Feed::getTimestamp($page);
		$this->data['myFeedOn'] = session('my_feed');

		$this->data['article'] = array();
		$this->data['secondaryArticle'] = array();

		if(!$this->data['myFeedOn']){

			$articles = $this->articleService->getLatestArticles(str_replace('page/', '', $page));


			if(count($articles['data']) == 2){

			$this->data['article'] = $articles['data'][0];
			$this->data['secondaryArticle'] = $articles['data'][1]; 

			}

		}   

		$this->data['trades'] = $this->feedService->getFeed(
			config('custom.perPage.tradesFeed'),
			Carbon::createFromTimestamp($timestamp+self::TIMESTAMP_OFFSET_SECONDS)->toDateTimeString(),
			$this->data['myFeedOn'] ? true : false
		); 
		
		return view($this->viewWithPrefix('feed-simpler'), $this->data);
		
	}

}