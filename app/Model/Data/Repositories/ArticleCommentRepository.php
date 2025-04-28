<?php

namespace App\Model\Data\Repositories;

use App\Model\Contracts\Interfaces\Data\ArticleCommentRepositoryInterface;
use App\Model\Data\Models\ArticleComment;

class ArticleCommentRepository implements ArticleCommentRepositoryInterface
{

    public function paginate($articleId, $limit, $page = null)
    {

        if($page)
        {

            return ArticleComment::where(['article_id' => $articleId, 'reply_to' => null])->orderBy('created_at', 'desc')->paginate($limit, ['*'], 'page', $page);
        
        } else {

            return ArticleComment::where(['article_id' => $articleId, 'reply_to' => null])->orderBy('created_at', 'desc')->paginate($limit);
        
        }
        
    }

    public function replies($commentId)
    {

        return ArticleComment::where(['reply_to' => $commentId])->orderBy('created_at', 'asc')->get();

    }    

    public function voteUp($commentId)
    {

        $trade = ArticleComment::find($commentId);

        if($trade)
        {

            $trade->votes += 1;
            $trade->save();

        }       

    }

    public function voteDown($commentId)
    {

        $trade = ArticleComment::find($commentId);

        if($trade)
        {

            $trade->votes -= 1;
            $trade->save();

        }  

    }    

    public function create($data)
    {
        
		$comment = new ArticleComment();
        $comment->fill($data);
        $comment->save();
        
        return $comment;
        
    }

}