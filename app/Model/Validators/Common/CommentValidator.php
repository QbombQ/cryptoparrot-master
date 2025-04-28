<?php 

namespace App\Model\Validators\Common;

use App\Model\Contracts\Interfaces\Validators\Common\CommentValidatorInterface;
use Illuminate\Support\Facades\Validator;

class CommentValidator implements CommentValidatorInterface
{

    protected $validator;
	
	public function validateTradeComment($data)
	{
        
		$this->validator = Validator::make($data, [
            'comment' => 'required|string|min:1|max:1000',
            'reply_to' => 'sometimes|nullable|exists:trade_comments,id',
            'trade_id' => 'required|exists:trades,id',
            'user_id' => 'required|exists:users,id'
        ]);		

		return !$this->validator->fails();
		
    }

	public function validateArticleComment($data)
	{
        
		$this->validator = Validator::make($data, [
            'comment' => 'required|string|min:1|max:1000',
            'reply_to' => 'sometimes|nullable|exists:article_comments,id',
            'article_id' => 'required|exists:articles,id',
            'user_id' => 'required|exists:users,id'
        ]);

		return !$this->validator->fails();
		
    }

    public function getErrors()
    {
        
        if(!$this->validator) return null;
        
        return $this->validator;

    }
    
}