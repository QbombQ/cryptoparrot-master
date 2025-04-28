<?php 

namespace App\Model\Formatters\TradeSubsystem;

use App\Model\Contracts\Interfaces\Formatters\TradeSubsystem\TradeCommentFormatterInterface;
use App\Model\Contracts\Interfaces\Data\TradeCommentVoteRepositoryInterface;
use Illuminate\Support\Facades\Storage;
use Auth;
use Avatar;
use Dongm2ez\Mention\Mention;
use Media;
use Time;

class TradeCommentFormatter implements TradeCommentFormatterInterface
{

    protected $tradeCommentVoteRepository;

    public function __construct(TradeCommentVoteRepositoryInterface $tradeCommentVoteRepository) 
	{

        $this->tradeCommentVoteRepository = $tradeCommentVoteRepository;
		
	}	    

    public function prepareCommentsForFeedPage($comments)
    {

        $result = [];

        if($comments->count() > 0)
        {

            foreach($comments as $comment)
            {

                $author = $comment->author;
                $result[] = [
                    'id' => $comment->id,
                    'votes' => $comment->votes,
                    'voted' => $this->tradeCommentVoteRepository->voted(Auth::id(), $comment->id),
                    'comment' => $comment->comment,
                    'gif' => $comment->gif,
                    'authorUsername' => $author->username,
                    'authorHandle' => $author->handle,
                    'reply_to' => isset($comment->reply_to) ? $comment->reply_to : null,
                    'avatar' => Media::getUserAvatar($author),
                    'date' => Time::formatDateForHumans($comment->created_at),
                    'replies' => $this->prepareCommentsForFeedPage($comment->replies->sortByDesc('votes')->slice(0,1)),
                    'hasMore' => $comment->replies->count() > 1
                ];
                $replies = $comment->replies;

            }

        }

        return $result;

    }

    public function prepareRequestForTradeCommentCreation($request)
    {

        $mention = new Mention;
        $parsed = $mention->parse($request->comment);

        return [
            'user_id' => $request->user_id,
            'trade_id' => $request->trade_id,
            'comment' => $parsed ? $parsed : $request->comment,
            'votes' => 0,
            'reply_to' => isset($request->reply_to) ? $request->reply_to : null,
            'gif' => isset($request->gif) ? $request->gif : null
        ];

    }

    public function prepareCreateCommentAjaxResponse($success, $comment, $tradeId = null, $replyTo = null,$commonUserData = null)
    {

        $data['success'] = $success;

        if(is_string($comment))
        {
            
            $data['message'] = $comment;

        } else {

            if($comment['reply_to'])
            {

                $data['reply'] = $comment;

            } else {

                $data['comment'] = $comment;
                
            }

        } 
 
        if($data['success']) 
		{

			$data['tradeId'] = $tradeId;
            $data['commonUserData'] = $commonUserData;
            $data['html'] = $replyTo ?
                view('pages/TradeSubsystem/common/single-reply', $data)->render() : 
                view('pages/TradeSubsystem/common/single-comment', $data)->render();
		
		}

        return $data;

    }

    public function prepareCommentsForLoadMoreResponse($comments, $tradeId)
    {

        return [
            'success' => $comments->count() > 0,
            'hasMore' => $comments->hasMorePages(),
            'html' => $comments->count() > 0 ?
                view('pages/TradeSubsystem/common/comments',
                        [
                            'comments' => $this->prepareCommentsForFeedPage($comments), 
                            'tradeId' => $tradeId
                        ]
                )->render() : ''
        ];        

    }

    public function prepareAllRepliesResponse($replies)
    {

        return [
            'success' => $replies->count() > 0,
            'html' => $replies->count() > 0 ?
                view('pages/TradeSubsystem/common/replies',
                        [
                            'replies' => $this->prepareCommentsForFeedPage($replies)
                        ]
                )->render() : ''
        ];            

    }

}