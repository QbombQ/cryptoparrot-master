<?php

namespace App\Model\Contracts\Interfaces\Services\Common;

interface CommentServiceInterface
{

    public function voteUpTradeComment($userId, $commentId);

    public function voteDownTradeComment($userId, $commentId);

    public function voteUpArticleComment($userId, $commentId);

    public function voteDownArticleComment($userId, $commentId);

}