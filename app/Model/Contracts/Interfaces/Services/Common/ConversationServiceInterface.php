<?php

namespace App\Model\Contracts\Interfaces\Services\Common;

use Illuminate\Http\Request;

interface ConversationServiceInterface
{

	public function hasUnreadConversations($accountId);

	public function markConversationAsRead($conversationId, $accountId);

	public function getConversations($userId);

	public function sendMessage($user, $data);

	public function getOrCreate($recipientId, $initiatorId);

	public function deleteEmptyConversations();

}