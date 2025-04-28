<?php

namespace App\Http\Controllers\TradeSubsystem;

use App\Http\Controllers\TradeSubsystem\BaseTradeSubsystemController;
use App\Model\Contracts\Interfaces\Formatters\TradeSubsystem\UserFormatterInterface;
use App\Model\Contracts\Interfaces\Services\Common\CommentServiceInterface;
use App\Model\Contracts\Interfaces\Services\Common\NotificationServiceInterface;
use App\Model\Contracts\Interfaces\Services\TradeSubsystem\TradeServiceInterface;
use App\Model\Contracts\Interfaces\Services\TradeSubsystem\TradePairServiceInterface;
use App\Model\Contracts\Interfaces\Services\Common\UserServiceInterface as CommonUserServiceInterface;
use App\Model\Contracts\Interfaces\Services\TradeSubsystem\TradeCommentServiceInterface;
use App\Model\Contracts\Interfaces\Services\TradeSubsystem\UserServiceInterface;
use App\Model\Contracts\Interfaces\Services\TradeSubsystem\TradeServiceInterface as TradeSubsystemTradeServiceInterface;
use App\Model\Contracts\Interfaces\Services\TradeSubsystem\InvitedUserServiceInterface;
use App\Model\Contracts\Interfaces\Services\TradeSubsystem\BlockedUserServiceInterface;
use App\Model\Contracts\Interfaces\Services\TradeSubsystem\ArticleCommentServiceInterface;
use App\Model\Contracts\Interfaces\Services\TradeSubsystem\PortfolioServiceInterface;
use Auth;
use Illuminate\Http\Request;
use LaravelVideoEmbed;
use Response;
use Currency;

class ActionsController extends BaseTradeSubsystemController
{

	protected $commentService;
	protected $commonUserService;
	protected $notificationService;
	protected $tradeCommentService;
	protected $tradeService;
	protected $tradePairService;
	protected $userService;
	protected $tradeSubsystemTradeService;
	protected $invitedUserService;
	protected $blockedUserService;
	protected $portfolioService;

	public function __construct(UserFormatterInterface $userFormatter,
								TradeCommentServiceInterface $tradeCommentService,
								NotificationServiceInterface $notificationService,
								CommentServiceInterface $commentService,
								TradeServiceInterface $tradeService,
								TradePairServiceInterface $tradePairService,
								CommonUserServiceInterface $commonUserService,
								TradeSubsystemTradeServiceInterface $tradeSubsystemTradeService,
								InvitedUserServiceInterface $invitedUserService,
								BlockedUserServiceInterface $blockedUserService,
								ArticleCommentServiceInterface $articleCommentService,
								PortfolioServiceInterface $portfolioService,
                                UserServiceInterface $userService) 
	{

		parent::__construct($userFormatter);
		$this->commentService = $commentService;
		$this->commonUserService = $commonUserService;
		$this->notificationService = $notificationService;
		$this->tradeCommentService = $tradeCommentService;
		$this->tradeService = $tradeService;
		$this->tradePairService = $tradePairService;
		$this->userService = $userService;
		$this->tradeSubsystemTradeService = $tradeSubsystemTradeService;
		$this->invitedUserService = $invitedUserService;
		$this->blockedUserService = $blockedUserService;
		$this->articleCommentService = $articleCommentService;
		$this->portfolioService = $portfolioService;
		
	} 

	public function getWeeklyChangeForEachPair(Request $request){


		$this->tradePairService->getWeeklyChangeForEachPair();

	} 


	public function priceInUsd(Request $request)
	{

		try {

			$feeRate = config('custom.trade_fee_'.$request->trade_type);

			if(!$request->amount)
			{

				$amount = 0;

			}else{

				$amount = $request->amount;

			}

			if($request->leverage && $request->leverage > 0)
			{

				$fee = $amount * $request->leverage * $request->leverage * $feeRate;
				$currency = Currency::dollar();
				$symbol = '$';

			}else{

				if($request->action == 'buy')
				{

					$fee = $amount / $request->market_rate * $feeRate;
					$currency = \App\Model\Data\Models\TradePair::find($request->trade_pair_id)->fromCurrency;
					$symbol = $currency->symbol;

				}else{

					$fee = $amount * $feeRate;
					$currency = \App\Model\Data\Models\TradePair::find($request->trade_pair_id)->toCurrency;
					$symbol = $currency->symbol;

				}

			}

			$currencyClass = Currency::getClass($currency->acronym);

		}catch(\Exception $e)
		{

			return [
				'fee' => 0,
				'symbol' => '$',
				'precision' => 0
			];			

		}

		return [
			'fee' => $fee,
			'symbol' => $symbol,
			'precision' => $currencyClass->getDefaultPrecision()
		];

	}

	public function getCurrentPortfolioHtml()
	{

		return $this->portfolioService->currentPortfolioHtml(Auth::user());

	}
	
	public function placeArticleComment(Request $request)
	{

		$request->merge(['user_id' => Auth::id()]);
		$request->merge(['commonUserData' => $this->getCommonData()]); 
		
		return $this->articleCommentService->createComment($request);
		
	}	

	public function getMentionData()
	{

		return json_encode($this->commonUserService->getUsersMentionData());

	}

	public function searchForUsers()
	{

		$results = [];

		if($_GET['term']) 
		{

			$results = $this->commonUserService->searchForUsers($_GET['term']);

		}

		return Response::json($results, 200, array('Content-Type' => 'application/javascript'));

	}
	
	public function savePair($pairId)
	{

		$this->userService->updateSavedPair($pairId);
		
	}

	public function readNotifications()
	{

		$this->notificationService->markNotificationsAsRead(Auth::id());
		
	}	

	public function placeTradeComment(Request $request)
	{
 
		$request->merge(['user_id' => Auth::id()]);
		$request->merge(['commonUserData' => $this->getCommonData()]); 

		return $this->tradeCommentService->createComment($request);
		
	}		

	public function voteUpTrade($userId, $tradeId)
	{

		$this->tradeService->voteUpTrade($userId, $tradeId);
		
	}	
	
	public function voteDownTrade($userId, $tradeId)
	{

		$this->tradeService->voteDownTrade($userId, $tradeId);
		
	}	

	public function voteUpTradeComment($userId, $commentId)
	{

		$this->commentService->voteUpTradeComment($userId, $commentId);
		
	}	
	
	public function voteDownTradeComment($userId, $commentId)
	{

		$this->commentService->voteDownTradeComment($userId, $commentId);
		
	}	

	public function voteUpArticleComment($userId, $commentId)
	{

		$this->commentService->voteUpArticleComment($userId, $commentId);
		
	}	
	
	public function voteDownArticleComment($userId, $commentId)
	{

		$this->commentService->voteDownArticleComment($userId, $commentId);
		
	}		

	public function loadMoreComments($tradeId, $page)
	{

		return $this->tradeCommentService->loadMoreComments($tradeId, $page);

	}

	public function loadAllReplies($commentId)
	{

		return $this->tradeCommentService->loadAllReplies($commentId);

	}	

	public function turnOnMyFeedMode()
	{

		session()->put('my_feed', 1);

	}

	public function turnOffMyFeedMode()
	{

		session()->forget('my_feed');

	}	

	public function follow($userId)
	{

		$this->userService->follow($userId, Auth::id());

		return null;

	}

	public function unfollow($userId)
	{

		$this->userService->unfollow($userId, Auth::id());

		return null;

	}	

	public function activeTrades()
	{

		return $this->tradeSubsystemTradeService->getActiveTradesAjax(Auth::user()->current_portfolio_id);

	}

	public function tradesHistory()
	{

		return $this->tradeSubsystemTradeService->getTradesHistoryAjax(Auth::user()->current_portfolio_id);

	}	

	public function getSourceMetadata(Request $request)
	{

		return $this->tradeSubsystemTradeService->getSourceMetadata($request);

	}

	public function getSourceVideoIframe(Request $request)
	{

		$parsed = LaravelVideoEmbed::parse($request->sourceLink);

		return [
			'success' => $parsed ? true : false,
			'iframe' => $parsed ? $parsed->getEmbedCode() : false
		];

	}

	public function updateTradeVisibility()
	{

		$request = new Request();
		$request->merge(['trade_id' => request()->input('trade_id'), 'public' => request()->input('public')]);

		return $this->tradeSubsystemTradeService->updateTradeVisibility($request->all());

	}	

	public function resendConfirmationLink()
	{

		return $this->userService->resendConfirmationLink();

	}

	public function loadInvitedUsers()
	{
		
		return $this->invitedUserService->getInvitedUsers(Auth::user());

	}

	public function blockUser($id)
	{

		$this->blockedUserService->blockUser(Auth::id(), $id);

		return redirect('/app/messages');

	}

	public function unblockUser($id)
	{

		$this->blockedUserService->unblockUser(Auth::id(), $id);
		
		return redirect('/app/messages');
		
	}	

}