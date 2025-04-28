<?php

namespace App\Model\Data\Repositories;

use App\Model\Contracts\Interfaces\Data\ConversationRepositoryInterface;
use App\Model\Data\Models\Conversation;
use Carbon\Carbon;

class ConversationRepository implements ConversationRepositoryInterface
{
	
	public function hasUnreadConversations($accountId)
	{

		return $this->unreadConversationsExists($accountId);		

	}		

	public function delete($conversationId)
	{

		Conversation::find($conversationId)->delete();

	}

	private function unreadConversationsExists($accountId)
	{

		return $this->makeModel()
			->where(['initiator_id' => $accountId, 'initiator_status' => 'unread'])
			->orWhere(function($query) use ($accountId) {
				$query->where(['recipient_id' => $accountId, 'recipient_status' => 'unread']);
			})
			->exists();

	}		
	
	public function getConversation($conversationId)
	{

		return Conversation::findOrFail($conversationId);

	}	

	public function update($conversationId, $data)
	{

		$conversation = $this->getConversation($conversationId);
		$conversation->fill($data);
		$conversation->save();

		return $conversation;

	}

	public function getConversations($userId)
	{

		$conversations = new Conversation;

		return $conversations->where(function($query) use ($userId) {
			$query
			->where(['initiator_id' => $userId])->orWhere(['recipient_id' => $userId]);
		})
			->orderBy('updated_at', 'desc')
			->orderBy('id', 'asc')
			->get();

	}
	
	public function deleteEmptyConversations()
	{

		Conversation::doesntHave('messages')->where('created_at', '<=', Carbon::now()->subMinutes(15))->delete();

	}

	public function conversationExists($initiatorAccountId, $recipientAccountId)
	{

		return Conversation::where([
			'initiator_id' => $initiatorAccountId, 
			'recipient_id' => $recipientAccountId
		])->exists();

	}

	public function createConversation($initiatorAccountId, $recipientAccountId)
	{

		$conversation = new Conversation;
		$conversation->initiator_id = $initiatorAccountId;
		$conversation->recipient_id = $recipientAccountId;
		$conversation->save();
		
		return $conversation;

	}

	public function getConversationByInitiatorAndRecipientIds($initiatorAccountId, $recipientAccountId)
	{

		return Conversation::where([
			['initiator_id','=',$initiatorAccountId], 
			['recipient_id','=',$recipientAccountId]
		])->orWhere([
			['initiator_id','=',$recipientAccountId], 
			['recipient_id','=',$initiatorAccountId]			
		])->first(); 

	}

}