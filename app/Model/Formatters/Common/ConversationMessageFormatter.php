<?php

namespace App\Model\Formatters\Common;

use App\Model\Contracts\Interfaces\Formatters\Common\ConversationMessageFormatterInterface;
use Illuminate\Support\Str;
use Time;

class ConversationMessageFormatter implements ConversationMessageFormatterInterface
{

    public function prepareConversationMessageTextForDisplay($message)
    {

        return $message ? Str::substr($message->message, 0, 30) . '...' : '';

    }

    public function prepareMessagesForDisplay($messages)
    {

        $results['data'] = [];
        $results['hasMore'] = $messages->hasPages();

        if($messages->isNotEmpty())
        {

            foreach($messages->reverse() as $message)
            {

                $results['data'][] = $this->prepareMessageForDisplay($message);

            }
            
        }

        return $results;

    }

    public function prepareMessageForDisplay($message)
    {

        return [
            'id' => $message->id,
            'message' => $message->message,
            'author' => $message->author,
            'createdAt' => Time::formatDateDiffForHumans($message->created_at)
        ];

    }    

    public function prepareCreateResponseWithErrors($errors)
    {

        return [
            'success' => false,
            'error' => $errors->first()
        ];

    }
 
    public function prepareRequestDataForCreation($conversationId, $type, $message)
    {

        return [
            'conversation_id' => $conversationId,
            'author' => $type,
            'message' => strip_tags($message)
        ];

    }

    public function prepareCreateResponseWithSuccess()
    {

        return [
            'success' => true
        ];

    }

}