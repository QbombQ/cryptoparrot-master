<?php

namespace App\Model\Contracts\Interfaces\Data;

interface ArticleRepositoryInterface
{

    public function paginate($limit);

    public function getLatestArticles($offset);

    public function paginateAll($limit);

    public function paginateCategoryArticles($categorySlug, $limit);

    public function getCategoryArticles($categorySlug, $limit);

    public function getCategoryArticlesByIds($ids, $articleId, $limit);

    public function getBySlug($slug);

    public function getById($id);

    public function create($args);

    public function update($articleId, $data);

    public function delete($articleId);

}