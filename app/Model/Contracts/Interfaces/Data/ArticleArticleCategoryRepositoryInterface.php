<?php

namespace App\Model\Contracts\Interfaces\Data;

interface ArticleArticleCategoryRepositoryInterface
{

    public function create($args);

    public function deleteArticleCategories($articleId);

}