<?php

namespace App\Model\Contracts\Interfaces\Formatters\TradeSubsystem;

interface TradeCommentFormatterInterface
{

    public function prepareCommentsForFeedPage($comments);

    public function prepareRequestForTradeCommentCreation($request);

    public function prepareCreateCommentAjaxResponse($success, $message);

    public function prepareCommentsForLoadMoreResponse($comments, $tradeId);

    public function prepareAllRepliesResponse($replies);

}