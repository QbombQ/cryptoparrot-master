<?php

namespace App\Model\Contracts\Interfaces\Services\TradeSubsystem;

interface TradeCommentServiceInterface
{

    public function createComment($request);

    public function loadMoreComments($tradeId);

    public function loadAllReplies($commentId);

}