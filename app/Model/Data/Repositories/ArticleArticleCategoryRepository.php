<?php

namespace App\Model\Data\Repositories;

use App\Model\Contracts\Interfaces\Data\ArticleArticleCategoryRepositoryInterface;
use App\Model\Data\Models\ArticleArticleCategory;

class ArticleArticleCategoryRepository implements ArticleArticleCategoryRepositoryInterface
{

    public function create($args)
    {

        $articleCategory = new ArticleArticleCategory;
        $articleCategory->fill($args);
        $articleCategory->save();

    }

    public function deleteArticleCategories($articleId)
    {

        ArticleArticleCategory::where('article_id', $articleId)->delete();

    }

}