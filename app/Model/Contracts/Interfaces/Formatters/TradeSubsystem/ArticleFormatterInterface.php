<?php

namespace App\Model\Contracts\Interfaces\Formatters\TradeSubsystem;

interface ArticleFormatterInterface
{

    public function prepareArticlesForDisplay($articles);

    public function prepareArticleForDisplay($articles);

}