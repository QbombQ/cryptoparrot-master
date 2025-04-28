<?php

namespace App\Model\Contracts\Interfaces\Formatters\Common;

interface ConversationMessageFormatterInterface
{

    public function prepareConversationMessageTextForDisplay($message);

    public function prepareMessagesForDisplay($messages);

    public function prepareMessageForDisplay($message);    

    public function prepareCreateResponseWithErrors($errors);

    public function prepareRequestDataForCreation($conversationId, $type, $message);

    public function prepareCreateResponseWithSuccess();

}