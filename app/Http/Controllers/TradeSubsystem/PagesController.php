<?php

namespace App\Http\Controllers\TradeSubsystem;

use App\Http\Controllers\TradeSubsystem\BaseTradeSubsystemController;
use App\Model\Contracts\Interfaces\Formatters\TradeSubsystem\UserFormatterInterface;
use App\Model\Contracts\Interfaces\Services\Common\ConversationServiceInterface;
use App\Model\Contracts\Interfaces\Services\Common\ConversationMessageServiceInterface;
use App\Model\Contracts\Interfaces\Services\TradeSubsystem\ArticleServiceInterface;
use App\Model\Contracts\Interfaces\Services\TradeSubsystem\ArticleCommentServiceInterface;
use App\Model\Contracts\Interfaces\Services\TradeSubsystem\TradePairServiceInterface;
use Auth;

class PagesController extends BaseTradeSubsystemController
{

	protected $conversationService;
	protected $conversationMessageService;
	protected $articleService;
	protected $articleCommentService;
	protected $tradePairService;

	public function __construct(
		UserFormatterInterface $userFormatter, 
		ConversationServiceInterface $conversationService,
		ConversationMessageServiceInterface $conversationMessageService,
		ArticleServiceInterface $articleService,
		ArticleCommentServiceInterface $articleCommentService,
		TradePairServiceInterface $tradePairService
	) 
	{

		parent::__construct($userFormatter);
		$this->conversationService = $conversationService;
		$this->conversationMessageService = $conversationMessageService;
		$this->articleService = $articleService;
		$this->articleCommentService = $articleCommentService;
		$this->tradePairService = $tradePairService;
		
	}    

	public function verificationRequired()
    {

		parent::getCommonData();

        return view($this->viewWithPrefix('verification-required'), $this->data);		

    }
		
	public function articles()
	{

		parent::getCommonData();

		if(request()->segment(1) == 'news' && (request()->segment(2) == 'page' || isset($_GET['tag']))) 
		{

			$this->data['canonical'] = url('/').'/news';

		}

		$this->data['category'] = array(
			'title'=>'Articles | '.env('APP_NAME'),
			'meta_title'=>'Articles | '.env('APP_NAME'),
			'meta_description'=>'All articles by '.env('APP_NAME'),
		);

		$this->data['articles'] = $this->articleService->paginate(config('custom.perPage.articlesFrontSubsystem'));
		$this->data['communityArticles'] = $this->articleService->getCategoryArticles('community', config('custom.perPage.communityArticles'));
		$this->data['tradePairs'] = $this->tradePairService->getForFeedPage();

		return view($this->viewWithPrefix('articles'), $this->data);
		 
	}

	public function category($categorySlug)
	{

		parent::getCommonData();

		$this->data['category'] = $this->articleService->getCategory($categorySlug);
		$this->data['articles'] = $this->articleService->paginateCategoryArticles($categorySlug, config('custom.perPage.articlesFrontSubsystem'));
		$this->data['communityArticles'] = $this->articleService->getCategoryArticles('community', config('custom.perPage.communityArticles'));
		$this->data['tradePairs'] = $this->tradePairService->getForFeedPage();

		return view($this->viewWithPrefix('articles'), $this->data);
		
    }	
 
	public function article($slug)
	{

		parent::getCommonData();
		$this->data['article'] = $this->articleService->getBySlug($slug);

		if($this->data['article']['status'] === 'draft' && (!Auth::check() || Auth::user()->type !== 'admin'))
		{

			abort(404);

		}

		$this->data['relatedArticles'] = $this->articleService->getRelatedArticles($this->data['article']['categories'], $this->data['article']['id'], config('custom.perPage.relatedArticles'));
		$this->data['comments'] = $this->articleCommentService->loadMoreComments($this->data['article']['id']);

		return view($this->viewWithPrefix('article'), $this->data);
		 
	} 

	public function earnMoney()
	{

		parent::getCommonData();

		return redirect('/app/rewards',301);
		
	}


	public function messages()
	{

		parent::getCommonData();
		$this->data['conversations'] = $this->conversationService->getConversations(Auth::id());
		$this->data['conversationData'] = [];
		$this->data['currentConversation'] = null;
		$this->data['conversationMessages'] = ['data' => [], 'hasMore' => false];

		return view($this->viewWithPrefix('messages'), $this->data);
		
	}

	public function chat($id)
	{

		$this->conversationService->markConversationAsRead($id, Auth::user());
		parent::getCommonData();
		$this->data['currentConversation'] = $id;
		$this->data['conversations'] = $this->conversationService->getConversations(Auth::id());
		$this->data['conversationData'] = collect($this->data['conversations'])->where('id', $id)->toArray();

		if(count($this->data['conversationData']) > 0)
		{

			$this->data['conversationMessages'] = $this->conversationMessageService->getConversationMessages(Auth::id(), $id);

			if($this->data['conversationMessages'] === false) 
			{

				$this->data['conversationMessages'] = [];

				return view($this->viewWithPrefix('messages'), $this->data);

			}

		}else{

			abort(404);

		}
		
		return view($this->viewWithPrefix('messages'), $this->data);
		
	}	

} 