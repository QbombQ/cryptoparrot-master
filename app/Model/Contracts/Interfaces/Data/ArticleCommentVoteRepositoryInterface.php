<?php

namespace App\Model\Contracts\Interfaces\Data;

interface ArticleCommentVoteRepositoryInterface
{

    public function vote($userId, $commentId);

    public function delete($userId, $commentId);

    public function voted($userId, $commentId);  

}