<?php

namespace App\Model\Data\Repositories;

use App\Model\Contracts\Interfaces\Data\TradeCommentVoteRepositoryInterface;
use App\Model\Data\Models\TradeCommentVote;

class TradeCommentVoteRepository implements TradeCommentVoteRepositoryInterface
{

    public function vote($userId, $commentId)
    {

        $vote = new TradeCommentVote;
        $vote->user_id = $userId;
        $vote->comment_id = $commentId;
        $vote->save();
        
        return true;

    }

    public function voted($userId, $commentId)
    {

        $vote = TradeCommentVote::where([
            'user_id' => $userId,
            'comment_id' => $commentId
        ])->first();

        return $vote ? true : false;

    }        

    public function delete($userId, $commentId)
    {

        return TradeCommentVote::where([
            'user_id' => $userId,
            'comment_id' => $commentId
        ])->delete();

    }

}