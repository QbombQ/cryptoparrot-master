<?php

namespace App\Model\Contracts\Interfaces\Data;

interface ArticleCommentRepositoryInterface
{

    public function paginate($articleId, $limit, $page);

    public function voteUp($commentId);

    public function voteDown($commentId);    

    public function create($data);   

}