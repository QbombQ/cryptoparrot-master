<?php 

namespace App\Model\Services\Common;

use App\Model\Contracts\Interfaces\Services\Common\CommentServiceInterface;
use App\Model\Contracts\Interfaces\Data\TradeCommentVoteRepositoryInterface;
use App\Model\Contracts\Interfaces\Data\TradeCommentRepositoryInterface;
use App\Model\Contracts\Interfaces\Data\ArticleCommentVoteRepositoryInterface;
use App\Model\Contracts\Interfaces\Data\ArticleCommentRepositoryInterface;

class CommentService implements CommentServiceInterface
{

    protected $tradeCommentRepository;
    protected $tradeCommentVoteRepository;
    protected $articleCommentRepository;
    protected $articleCommentVoteRepository;    

    public function __construct(
        TradeCommentVoteRepositoryInterface $tradeCommentVoteRepository,
        TradeCommentRepositoryInterface $tradeCommentRepository,
        ArticleCommentVoteRepositoryInterface $articleCommentVoteRepository,
        ArticleCommentRepositoryInterface $articleCommentRepository 
    ) 
	{

        $this->tradeCommentRepository = $tradeCommentRepository;
        $this->tradeCommentVoteRepository = $tradeCommentVoteRepository;
        $this->articleCommentRepository = $articleCommentRepository;
        $this->articleCommentVoteRepository = $articleCommentVoteRepository;
		
	}	

    public function voteUpTradeComment($userId, $commentId)
    {

        if(!$this->tradeCommentVoteRepository->voted($userId, $commentId))
        {

            $this->tradeCommentVoteRepository->vote($userId, $commentId);
            $this->tradeCommentRepository->voteUp($commentId);

        }

    }

    public function voteDownTradeComment($userId, $commentId)
    {

        if($this->tradeCommentVoteRepository->voted($userId, $commentId))
        {

            $this->tradeCommentVoteRepository->delete($userId, $commentId);
            $this->tradeCommentRepository->voteDown($commentId);

        }        

    }

    public function voteUpArticleComment($userId, $commentId)
    {

        if(!$this->articleCommentVoteRepository->voted($userId, $commentId))
        {

            $this->articleCommentVoteRepository->vote($userId, $commentId);
            $this->articleCommentRepository->voteUp($commentId);

        }

    }

    public function voteDownArticleComment($userId, $commentId)
    {

        if($this->articleCommentVoteRepository->voted($userId, $commentId))
        {

            $this->articleCommentVoteRepository->delete($userId, $commentId);
            $this->articleCommentRepository->voteDown($commentId);
            
        }

    }

}