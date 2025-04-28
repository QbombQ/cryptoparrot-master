<?php

namespace App\Model\Contracts\Interfaces\Formatters\Common;

interface ConversationFormatterInterface
{

    public function prepareDataForConversationMarkAsReadUpdate($conversation, $accountId);

    public function prepareResponseDataForMarkConversationAsRead($marked);
    
    public function prepareConversationListForDisplay($accountId, $conversations);
    
    public function prepareConversationListItemForDisplay($accountId, $conversation);

    public function prepareDataForSetToUnreadAction($role);

}