<?php

namespace App\Model\Services\TradeSubsystem;

use App\Model\Contracts\Interfaces\Services\TradeSubsystem\ArticleServiceInterface;
use App\Model\Contracts\Interfaces\Formatters\TradeSubsystem\ArticleFormatterInterface;
use App\Model\Contracts\Interfaces\Data\ArticleRepositoryInterface;
use App\Model\Contracts\Interfaces\Data\ArticleCategoryRepositoryInterface;

class ArticleService implements ArticleServiceInterface
{

    protected $articleRepository;
    protected $articleCategoryRepository;
    protected $articleFormatter;

    public function __construct(ArticleRepositoryInterface $articleRepository,
                                ArticleCategoryRepositoryInterface $articleCategoryRepository,
                                ArticleFormatterInterface $articleFormatter) 
	{

        $this->articleRepository = $articleRepository;
        $this->articleCategoryRepository = $articleCategoryRepository;
        $this->articleFormatter = $articleFormatter;
		
    }	
 
    public function paginate($limit)
    {

        $articles = $this->articleRepository->paginate($limit);
        
        return $this->articleFormatter->prepareArticlesForDisplay($articles);

    }

    public function paginateCategoryArticles($categorySlug, $limit)
	{
        
        $articles = $this->articleRepository->paginateCategoryArticles($categorySlug, $limit);

		return $this->articleFormatter->prepareArticlesForDisplay($articles);
		
    }    

	public function getCategoryArticles($categorySlug, $limit)
	{
        
        $articles = $this->articleRepository->getCategoryArticles($categorySlug, $limit);
		return $this->articleFormatter->prepareArticlesForDisplay($articles);
		
    }      

    public function getCategory($categorySlug)
    {
        
        $category = $this->articleCategoryRepository->getBySlug($categorySlug);
        return $category;
        
    }       

    public function getRelatedArticles($ids, $articleId, $limit)
    {

        $articles = $this->articleRepository->getCategoryArticlesByIds($ids, $articleId, $limit); 

		return $this->articleFormatter->prepareArticlesForDisplay($articles);

    }
    
    public function getBySlug($slug)
    {

        $article = $this->articleRepository->getBySlug($slug);
        return $this->articleFormatter->prepareArticleForDisplay($article);

    }
 
    public function getLatestArticles($offset)
    {

        $articles = $this->articleRepository->getLatestArticles($offset);

        return $this->articleFormatter->prepareArticlesForDisplay($articles);
        
    }


}