<?php 

namespace App\Model\Services\TradeSubsystem;

use App\Model\Contracts\Interfaces\Data\TradeCommentRepositoryInterface;
use App\Model\Contracts\Interfaces\Formatters\TradeSubsystem\TradeCommentFormatterInterface;
use App\Model\Contracts\Interfaces\Validators\Common\CommentValidatorInterface;
use App\Model\Contracts\Interfaces\Services\TradeSubsystem\TradeCommentServiceInterface;
use Illuminate\Http\Request;

class TradeCommentService implements TradeCommentServiceInterface
{

    protected $tradeCommentFormatter;
    protected $commentValidator;
    protected $tradeCommentRepository;

    public function __construct(TradeCommentFormatterInterface $tradeCommentFormatter,
                                CommentValidatorInterface $commentValidator,
								TradeCommentRepositoryInterface $tradeCommentRepository) 
	{

        $this->tradeCommentFormatter = $tradeCommentFormatter;
        $this->commentValidator = $commentValidator;
        $this->tradeCommentRepository = $tradeCommentRepository;

    }	
    
    public function createComment($request)
    {

        if(!$this->commentValidator->validateTradeComment($request->all()))
        {

            return $this->tradeCommentFormatter->prepareCreateCommentAjaxResponse(false, $this->commentValidator->getErrors()->errors()->first());
        
        }

        $comment = $this->tradeCommentRepository->create(
            $this->tradeCommentFormatter->prepareRequestForTradeCommentCreation($request)
        );

        return $this->tradeCommentFormatter->prepareCreateCommentAjaxResponse(
            true,
            $this->tradeCommentFormatter->prepareCommentsForFeedPage(collect([$comment]))[0],
            $request->trade_id,
            $request->reply_to,
            $request->commonUserData,
        );

    }

    public function loadMoreComments($tradeId)
    {

        $comments = $this->tradeCommentRepository->paginate($tradeId, config('custom.perPage.tradeComments'));

        return $this->tradeCommentFormatter->prepareCommentsForLoadMoreResponse($comments, $tradeId);

    }

    public function loadAllReplies($commentId)
    {

        $replies = $this->tradeCommentRepository->replies($commentId);
        
        return $this->tradeCommentFormatter->prepareAllRepliesResponse($replies);    

    }

}