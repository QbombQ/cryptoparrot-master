<?php

namespace App\Model\Services\Common;

use App\Model\Contracts\Interfaces\Data\ConversationMessageRepositoryInterface;
use App\Model\Contracts\Interfaces\Data\ConversationRepositoryInterface;
use App\Model\Contracts\Interfaces\Formatters\Common\ConversationMessageFormatterInterface;
use App\Model\Contracts\Interfaces\Services\Common\ConversationMessageServiceInterface;
use Illuminate\Support\Facades\Gate;

class ConversationMessageService implements ConversationMessageServiceInterface
{

    protected $conversationMessageFormatter;
    protected $conversationMessageRepository;
    protected $conversationRepository;

    public function __construct(
        ConversationMessageFormatterInterface $conversationMessageFormatter,
        ConversationMessageRepositoryInterface $conversationMessageRepository,
        ConversationRepositoryInterface $conversationRepository
    )
    {

        $this->conversationMessageFormatter = $conversationMessageFormatter;
        $this->conversationMessageRepository = $conversationMessageRepository;
        $this->conversationRepository = $conversationRepository;

    }

    public function getNewestConversationMessageText($conversationId)
    {

        $message = $this->conversationMessageRepository->newestConversationMessage($conversationId);

        return $this->conversationMessageFormatter->prepareConversationMessageTextForDisplay($message);

    }

    public function getConversationMessages($account, $conversationId, $lastMessageId = 0)
    {

        $conversation = $this->conversationRepository->getConversation($conversationId);

        if(!$conversation)
        {

            abort(404);

        }

        $messages = collect([]);

        if(Gate::allows('view-conversation', $conversation))
        {

            $messages = $this->conversationMessageRepository->getMessages($conversationId, $lastMessageId);

        } else {

            return false;
            
        }

        return $this->conversationMessageFormatter->prepareMessagesForDisplay($messages);

    }    

}