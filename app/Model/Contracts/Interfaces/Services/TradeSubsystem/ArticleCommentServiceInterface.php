<?php

namespace App\Model\Contracts\Interfaces\Services\TradeSubsystem;

interface ArticleCommentServiceInterface
{

    public function createComment($request);

    public function loadMoreComments($articleId);

    public function loadAllReplies($commentId);

}