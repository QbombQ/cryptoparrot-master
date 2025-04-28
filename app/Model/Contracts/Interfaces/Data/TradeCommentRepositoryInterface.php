<?php

namespace App\Model\Contracts\Interfaces\Data;

interface TradeCommentRepositoryInterface
{

    public function paginate($tradeId, $limit, $page);

    public function voteUp($commentId);

    public function voteDown($commentId);    

    public function create($data);    

}