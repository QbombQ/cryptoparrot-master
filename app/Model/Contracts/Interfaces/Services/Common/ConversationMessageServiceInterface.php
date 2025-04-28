<?php

namespace App\Model\Contracts\Interfaces\Services\Common;

interface ConversationMessageServiceInterface
{

    public function getNewestConversationMessageText($conversationId);

    public function getConversationMessages($account, $conversationId, $lastMessageId);

}