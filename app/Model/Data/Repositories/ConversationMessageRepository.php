<?php

namespace App\Model\Data\Repositories;

use App\Model\Contracts\Interfaces\Data\ConversationMessageRepositoryInterface;
use App\Model\Data\Models\ConversationMessage;

class ConversationMessageRepository implements ConversationMessageRepositoryInterface
{

	public function newestConversationMessage($conversationId)
	{

		return ConversationMessage::where('conversation_id', $conversationId)->orderBy('created_at', 'desc')->first();

	}

	public function getMessages($conversationId, $lastMessageId)
	{

		$messages = ConversationMessage::where(['conversation_id' => $conversationId])
			->when($lastMessageId > 0, function($query) use ($lastMessageId) {
				$query
				->where('id', '<', $lastMessageId);
			})
			->orderBy('id', 'desc')
			->paginate(10);
	
		return $messages;

	}

	public function create($data)
	{

		$newMessage = new ConversationMessage;
		$newMessage->fill($data);
		$newMessage->save();
		
		return $newMessage;

	}

}