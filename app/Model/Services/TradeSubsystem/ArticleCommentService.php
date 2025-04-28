<?php

namespace App\Model\Services\TradeSubsystem;

use App\Model\Contracts\Interfaces\Services\TradeSubsystem\ArticleCommentServiceInterface;
use App\Model\Contracts\Interfaces\Data\ArticleCommentRepositoryInterface;
use App\Model\Contracts\Interfaces\Formatters\TradeSubsystem\ArticleCommentFormatterInterface;
use App\Model\Contracts\Interfaces\Validators\Common\CommentValidatorInterface;

class ArticleCommentService implements ArticleCommentServiceInterface
{

    protected $articleCommentFormatter;
    protected $commentValidator;
    protected $articleCommentRepository;

    public function __construct(ArticleCommentFormatterInterface $articleCommentFormatter,
                                CommentValidatorInterface $commentValidator,
								ArticleCommentRepositoryInterface $articleCommentRepository) 
	{

        $this->articleCommentFormatter = $articleCommentFormatter;
        $this->commentValidator = $commentValidator;
        $this->articleCommentRepository = $articleCommentRepository;

    }	
     
    public function createComment($request)
    {

        if(!$this->commentValidator->validateArticleComment($request->all()))
        {

            return $this->articleCommentFormatter->prepareCreateCommentAjaxResponse(false, $this->commentValidator->getErrors()->errors()->first());
        
        }

        $comment = $this->articleCommentRepository->create(
            $this->articleCommentFormatter->prepareRequestForArticleCommentCreation($request)
        );

        return $this->articleCommentFormatter->prepareCreateCommentAjaxResponse(
            true,
            $this->articleCommentFormatter->prepareCommentsForFeedPage(collect([$comment]))[0],
            $request->article_id,
            $request->reply_to
        );

    }

    public function loadMoreComments($articleId)
    {

        $comments = $this->articleCommentRepository->paginate($articleId, config('custom.perPage.articleComments'));

        return $this->articleCommentFormatter->prepareCommentsForLoadMoreResponse($comments, $articleId);

    }

    public function loadAllReplies($commentId)
    {

        $replies = $this->articleCommentRepository->replies($commentId);
        
        return $this->articleCommentFormatter->prepareAllRepliesResponse($replies);    

    }

}