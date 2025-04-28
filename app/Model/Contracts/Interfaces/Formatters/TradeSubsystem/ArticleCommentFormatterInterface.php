<?php

namespace App\Model\Contracts\Interfaces\Formatters\TradeSubsystem;

interface ArticleCommentFormatterInterface
{

    public function prepareCommentsForFeedPage($comments);

    public function prepareRequestForArticleCommentCreation($request);

    public function prepareCreateCommentAjaxResponse($success, $message, $articleId, $replyTo);

    public function prepareCommentsForLoadMoreResponse($comments, $articleId);

    public function prepareAllRepliesResponse($replies);

}