<?php

namespace App\Model\Contracts\Interfaces\Data;

interface ConversationMessageRepositoryInterface
{

    public function newestConversationMessage($conversationId);

    public function getMessages($conversationId, $lastMessageId);

    public function create($data);

}