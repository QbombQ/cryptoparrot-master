<?php

namespace App\Model\Contracts\Interfaces\Formatters\AdminSubsystem;

interface ArticleFormatterInterface
{

    public function prepareArticlesForDisplay($articles);

    public function prepareDataForCreation($data);

    public function prepareDataForThumbnailUpdate($path);

    public function prepareDataForOgImageUpdate($path);

    public function prepareArticleForEdit($article);

    public function prepareDataForUpdate($data);

}