<?php

namespace App\Http\Controllers\TradeSubsystem;

use App\Http\Controllers\TradeSubsystem\BaseTradeSubsystemController;
use App\Model\Contracts\Interfaces\Formatters\TradeSubsystem\UserFormatterInterface;
use App\Model\Contracts\Interfaces\Services\Common\ConversationServiceInterface;
use App\Model\Contracts\Interfaces\Services\Common\ConversationMessageServiceInterface;
use Illuminate\Http\Request;
use Auth;

class ConversationsController extends BaseTradeSubsystemController
{

    protected $conversationService;
    protected $conversationMessageService;

    public function __construct(
        UserFormatterInterface $userFormatter,
		ConversationServiceInterface $conversationService,
		ConversationMessageServiceInterface $conversationMessageService
    ) 
	{

        parent::__construct($userFormatter);
        $this->conversationService = $conversationService;
        $this->conversationMessageService = $conversationMessageService;
		
	}    
	
	public function create($id)
	{

		if($id == Auth::id()) 
		{

			abort(404);

		}

		$id = $this->conversationService->getOrCreate($id, Auth::id()); 

		return redirect('/app/messages/'.$id);
		
	}

	public function sendMessage($id, Request $request)
	{

		return $this->conversationService->sendMessage(Auth::id(), $request->all());
		
	}	

	public function paginateMessages($id, Request $request)
	{

		$response['messages'] = $this->conversationMessageService->getConversationMessages(Auth::user(), $id, $request->lastMessageId);

		if(count($response['messages']) > 0) 
		{

			$response['success'] = true;

		}else{

			$response['success'] = false;

		}

		return $response;

	}

}