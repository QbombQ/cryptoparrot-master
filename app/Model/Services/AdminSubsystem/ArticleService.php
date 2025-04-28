<?php

namespace App\Model\Services\AdminSubsystem;

use App\Model\Contracts\Interfaces\Services\AdminSubsystem\ArticleServiceInterface;
use App\Model\Contracts\Interfaces\Services\AdminSubsystem\ArticleCategoryServiceInterface;
use App\Model\Contracts\Interfaces\Services\Common\FileServiceInterface;
use App\Model\Contracts\Interfaces\Formatters\AdminSubsystem\ArticleFormatterInterface;
use App\Model\Contracts\Interfaces\Validators\AdminSubsystem\ArticleValidatorInterface;
use App\Model\Contracts\Interfaces\Data\ArticleRepositoryInterface;
use App\Model\Contracts\Interfaces\Data\ArticleArticleCategoryRepositoryInterface;

class ArticleService implements ArticleServiceInterface
{

    protected $articleRepository;
    protected $articleFormatter;
    protected $articleValidator;
    protected $fileService;
    protected $articleCategoryService;
    protected $articleArticleCategoryRepository;

    public function __construct(
        ArticleFormatterInterface $articleFormatter,
        ArticleRepositoryInterface $articleRepository,
        FileServiceInterface $fileService,
        ArticleCategoryServiceInterface $articleCategoryService,
        ArticleArticleCategoryRepositoryInterface $articleArticleCategoryRepository,
        ArticleValidatorInterface $articleValidator
    )
    {

        $this->articleRepository = $articleRepository;
        $this->articleFormatter = $articleFormatter;
        $this->articleValidator = $articleValidator;
        $this->fileService = $fileService;
        $this->articleCategoryService = $articleCategoryService;
        $this->articleArticleCategoryRepository = $articleArticleCategoryRepository;

    }

    public function paginate($perPage)
    {

        $articles = $this->articleRepository->paginateAll($perPage);

        return $this->articleFormatter->prepareArticlesForDisplay($articles);

    }

    public function create($data)
    {

        if(!$this->articleValidator->validateCreate($data))
        {

            return $this->articleValidator->getErrors();

        }

        $articleId = $this->articleRepository->create(
            $this->articleFormatter->prepareDataForCreation($data)
        );

        foreach($data['category'] as $category)
        {

            $this->articleArticleCategoryRepository->create([
                'article_id' => $articleId,
                'article_category_id' => $category
            ]);

        }

        if(array_key_exists('thumbnail', $data))
        {

            $path = $this->fileService->uploadArticleThumbnail($data['thumbnail'], $articleId);
            $this->articleRepository->update($articleId, $this->articleFormatter->prepareDataForThumbnailUpdate($path));
            $this->articleRepository->update($articleId, $this->articleFormatter->prepareDataForOgImageUpdate($path));

        }

        return trans('AdminSubsystem/success-messages.article-creation-success');

    }

    public function update($data)
    {

        if(!$this->articleValidator->validateUpdate($data))
        {

            return $this->articleValidator->getErrors();

        }

        $articleId = $this->articleRepository->update(
            $data['article_id'],
            $this->articleFormatter->prepareDataForUpdate($data)
        );

        $this->articleArticleCategoryRepository->deleteArticleCategories($data['article_id']);

        foreach($data['category'] as $category)
        {

            $this->articleArticleCategoryRepository->create([
                'article_id' => $data['article_id'],
                'article_category_id' => $category
            ]);

        }

        if(array_key_exists('thumbnail', $data))
        {

            $path = $this->fileService->uploadArticleThumbnail($data['thumbnail'], $data['article_id']);
            $this->articleRepository->update($data['article_id'], $this->articleFormatter->prepareDataForThumbnailUpdate($path));
            $this->articleRepository->update($data['article_id'], $this->articleFormatter->prepareDataForOgImageUpdate($path));

        }

        return trans('AdminSubsystem/success-messages.article-update-success');

    }    

    public function delete($articleId)
    {

        $deleted = $this->articleRepository->delete($articleId);

        if($deleted)
        {

            $this->fileService->deleteArticleThumbnails($articleId);

            return trans('AdminSubsystem/success-messages.article-delete-success');
            
        }

        return [];

    }

    public function getForEdit($articleId)
    {

        $article = $this->articleRepository->getById($articleId);
        
        return $this->articleFormatter->prepareArticleForEdit($article);

    }

}