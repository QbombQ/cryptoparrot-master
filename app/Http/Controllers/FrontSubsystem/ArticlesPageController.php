<?php

namespace App\Http\Controllers\FrontSubsystem;

use App\Http\Controllers\FrontSubsystem\BaseFrontSubsystemController;
use App\Model\Contracts\Interfaces\Services\FrontSubsystem\ArticleServiceInterface;
use App\Model\Contracts\Interfaces\Services\FrontSubsystem\ArticleCommentServiceInterface;
use App\Model\Contracts\Interfaces\Services\TradeSubsystem\CompetitionServiceInterface;

class ArticlesPageController extends BaseFrontSubsystemController
{

	protected $articleService;
	protected $competitionService;
	protected $articleCommentService;

	public function __construct(ArticleServiceInterface $articleService, CompetitionServiceInterface $competitionService, ArticleCommentServiceInterface $articleCommentService) 
	{

		$this->articleService = $articleService;
		$this->competitionService = $competitionService;
		$this->articleCommentService = $articleCommentService;
		
	}	

	public function main()
	{

		parent::getCommonData();
		
		if(request()->segment(1) == 'news' && request()->segment(2) == 'page') {
			$this->data['canonical'] = '/news';
		}
		
		$this->data['articles'] = $this->articleService->paginate(config('custom.perPage.articlesFrontSubsystem'));
		$this->data['communityArticles'] = $this->articleService->getCategoryArticles('community', 2);
		$this->data['competitions'] = $this->competitionService->paginate(config('custom.perPage.competitionsArticlesPage'));
		return view('pages/FrontSubsystem/articles', $this->data);
		
	}
	
	public function category($categorySlug)
	{

		parent::getCommonData();
		$this->data['articles'] = $this->articleService->paginateCategoryArticles($categorySlug, config('custom.perPage.articlesFrontSubsystem'));
		$this->data['competitions'] = $this->competitionService->paginate(config('custom.perPage.competitionsArticlesPage'));
		if($categorySlug == 'community') {
			return view('pages/FrontSubsystem/articles-community', $this->data);
		}
		return view('pages/FrontSubsystem/articles', $this->data);
		
    }	
    
	public function article($slug)
	{  
		
		parent::getCommonData();
		$this->data['article'] = $this->articleService->getBySlug($slug);
		$this->data['relatedArticles'] = $this->articleService->getRelatedArticles($this->data['article']['categories'], $this->data['article']['id'], 4);

		
		$this->data['comments'] = $this->articleCommentService->loadMoreComments($this->data['article']['id']);
		return view('pages/FrontSubsystem/article', $this->data);
		
	}    

}