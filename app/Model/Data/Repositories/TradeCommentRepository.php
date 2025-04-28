<?php

namespace App\Model\Data\Repositories;

use App\Model\Contracts\Interfaces\Data\TradeCommentRepositoryInterface;
use App\Model\Data\Models\TradeComment;

class TradeCommentRepository implements TradeCommentRepositoryInterface
{

    public function paginate($tradeId, $limit, $page = null)
    {

        if($page)
        {

            return TradeComment::where(['trade_id' => $tradeId, 'reply_to' => null])->orderBy('created_at', 'asc')->paginate($limit, ['*'], 'page', $page);
        
        } else {

            return TradeComment::where(['trade_id' => $tradeId, 'reply_to' => null])->orderBy('created_at', 'asc')->paginate($limit);
        
        }
        
    }

    public function replies($commentId)
    {

        return TradeComment::where(['reply_to' => $commentId])->orderBy('created_at', 'asc')->get();

    }    

    public function voteUp($commentId)
    {

        $trade = TradeComment::find($commentId);

        if($trade)
        {

            $trade->votes += 1;
            $trade->save();

        }       

    }

    public function voteDown($commentId)
    {

        $trade = TradeComment::find($commentId);

        if($trade)
        {

            $trade->votes -= 1;
            $trade->save();

        }  

    }    

    public function create($data)
    {
        
		$comment = new TradeComment();
        $comment->fill($data);
        $comment->save();
        
        return $comment;
        
    }

}