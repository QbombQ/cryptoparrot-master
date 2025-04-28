<?php

namespace App\Model\Contracts\Interfaces\Data;

interface ConversationRepositoryInterface
{

    public function hasUnreadConversations($accountId);

    public function update($conversationId, $data);

    public function delete($conversationId);

    public function deleteEmptyConversations();

    public function getConversations($userId); 

    public function getConversation($conversationId);

    public function conversationExists($initiatorAccountId, $recipientAccountId);

    public function createConversation($initiatorAccountId, $recipientAccountId);

    public function getConversationByInitiatorAndRecipientIds($initiatorAccountId, $recipientAccountId);

}