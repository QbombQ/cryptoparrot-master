<?php

namespace App\Model\Data\Repositories;

use App\Model\Contracts\Interfaces\Data\ArticleCommentVoteRepositoryInterface;
use App\Model\Data\Models\ArticleCommentVote;

class ArticleCommentVoteRepository implements ArticleCommentVoteRepositoryInterface
{

    public function vote($userId, $commentId)
    {

        $vote = new ArticleCommentVote;
        $vote->user_id = $userId;
        $vote->comment_id = $commentId;
        $vote->save();
        
        return true;

    }

    public function voted($userId, $commentId)
    {

        $vote = ArticleCommentVote::where([
            'user_id' => $userId,
            'comment_id' => $commentId
        ])->first();

        return $vote ? true : false;

    }        

    public function delete($userId, $commentId)
    {

        return ArticleCommentVote::where([
            'user_id' => $userId,
            'comment_id' => $commentId
        ])->delete();

    }

}