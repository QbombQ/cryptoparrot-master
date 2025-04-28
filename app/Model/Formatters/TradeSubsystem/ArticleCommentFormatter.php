<?php

namespace App\Model\Formatters\TradeSubsystem;

use App\Model\Contracts\Interfaces\Formatters\TradeSubsystem\ArticleCommentFormatterInterface;
use App\Model\Contracts\Interfaces\Data\ArticleCommentVoteRepositoryInterface;
use Illuminate\Support\Facades\Storage;
use Auth;
use Avatar;
use Dongm2ez\Mention\Mention;
use Time;
use Media;

class ArticleCommentFormatter implements ArticleCommentFormatterInterface
{

    protected $articleCommentVoteRepository;

    public function __construct(ArticleCommentVoteRepositoryInterface $articleCommentVoteRepository) 
	{

        $this->articleCommentVoteRepository = $articleCommentVoteRepository;
		
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
                    'voted' => Auth::check() && $this->articleCommentVoteRepository->voted(Auth::id(), $comment->id),
                    'comment' => $comment->comment,
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

    public function prepareRequestForArticleCommentCreation($request)
    {

        $mention = new Mention;
        $parsed = $mention->parse($request->comment);

        return [
            'user_id' => $request->user_id,
            'article_id' => $request->article_id,
            'comment' => $parsed ? $parsed : $request->comment,
            'votes' => 0,
            'reply_to' => isset($request->reply_to) ? $request->reply_to : null
        ];

    }

    public function prepareCreateCommentAjaxResponse($success, $comment, $articleId = null, $replyTo = null)
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

        if($success)
        {

            $data['articleId'] = $articleId;
            $data['html'] = $replyTo ?
                view('pages/TradeSubsystem/common/single-reply', $data)->render() :
                view('pages/TradeSubsystem/common/single-comment', $data)->render();

        }

        return $data;

    }

    public function prepareCommentsForLoadMoreResponse($comments, $articleId)
    {


        return [
            'success' => $comments->count() > 0,
            'hasMore' => $comments->hasMorePages(),
            'html' => $comments->count() > 0 ?
                view('pages/TradeSubsystem/common/comments',
                        [
                            'comments' => $this->prepareCommentsForFeedPage($comments), 
                            'articleId' => $articleId,
                            'commonUserData' => array(
                                'handle'=> Auth::check() ? Auth::user()->handle : '',
                                'avatar'=>Auth::check() ? Media::getUserAvatar(Auth::user())  : '',
                            ),  
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