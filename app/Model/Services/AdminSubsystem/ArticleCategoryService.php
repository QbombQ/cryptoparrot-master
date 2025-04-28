<?php

namespace App\Model\Services\AdminSubsystem;

use App\Model\Contracts\Interfaces\Services\AdminSubsystem\ArticleCategoryServiceInterface;
use App\Model\Contracts\Interfaces\Formatters\AdminSubsystem\ArticleCategoryFormatterInterface;
use App\Model\Contracts\Interfaces\Validators\AdminSubsystem\ArticleValidatorInterface;
use App\Model\Contracts\Interfaces\Data\ArticleCategoryRepositoryInterface;

class ArticleCategoryService implements ArticleCategoryServiceInterface
{

    protected $articleCategoryRepository;
    protected $articleCategoryFormatter;
    protected $articleValidator;

    public function __construct(
        ArticleCategoryRepositoryInterface $articleCategoryRepository,
        ArticleCategoryFormatterInterface $articleCategoryFormatter,
        ArticleValidatorInterface $articleValidator
    ){

        $this->articleCategoryRepository = $articleCategoryRepository;
        $this->articleCategoryFormatter = $articleCategoryFormatter;
        $this->articleValidator = $articleValidator;

    }

    public function getForSelect()
    {

        $categories = $this->articleCategoryRepository->all();

        return $this->articleCategoryFormatter->prepareCategoriesForSelect($categories);

    }

    public function getForEdit($categoryId)
    {

        $category = $this->articleCategoryRepository->get($categoryId);

        return $this->articleCategoryFormatter->prepareCategoryForEdit($category);

    }

    public function paginate($perPage)
    {

        $categories = $this->articleCategoryRepository->all();

        return $this->articleCategoryFormatter->prepareCategoriesForDisplay($categories);

    }

    public function create($data)
    {

        if(!$this->articleValidator->validateCategoryCreate($data))
        {

            return $this->articleValidator->getErrors();
            
        }

        $this->articleCategoryRepository->create(
            $this->articleCategoryFormatter->prepareDataForCreation($data)
        );

        return trans('AdminSubsystem/success-messages.article-category-creation-success');

    }

    public function update($data)
    {

        if(!$this->articleValidator->validateCategoryUpdate($data))
        {

            return $this->articleValidator->getErrors();

        }

        $articleId = $this->articleCategoryRepository->update(
            $data['category_id'],
            $this->articleCategoryFormatter->prepareDataForUpdate($data)
        );

        return trans('AdminSubsystem/success-messages.article-category-update-success');

    }

    public function delete($categoryId)
    {

        $this->articleCategoryRepository->delete($categoryId);
        
        return trans('AdminSubsystem/success-messages.article-category-delete-success');

    }

}