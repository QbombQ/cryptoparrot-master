<?php 

namespace App\Model\Services\Common;

use App\Model\Contracts\Interfaces\Data\ConversationMessageRepositoryInterface;
use App\Model\Contracts\Interfaces\Data\ConversationRepositoryInterface;
use App\Model\Contracts\Interfaces\Formatters\Common\ConversationFormatterInterface;
use App\Model\Contracts\Interfaces\Formatters\Common\ConversationMessageFormatterInterface;
use App\Model\Contracts\Interfaces\Services\Common\ConversationServiceInterface;
use App\Model\Contracts\Interfaces\Validators\Common\ConversationMessageValidatorInterface;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Model\Events\NewMessage;

class ConversationService implements ConversationServiceInterface
{

    protected $conversationFormatter;
    protected $conversationMessageFormatter;
    protected $conversationMessageRepository;
    protected $conversationRepository;
    protected $conversationMessageValidator;
    
	public function __construct(
        ConversationFormatterInterface $conversationFormatter,
        ConversationMessageFormatterInterface $conversationMessageFormatter,
        ConversationMessageRepositoryInterface $conversationMessageRepository,
        ConversationRepositoryInterface $conversationRepository,
        ConversationMessageValidatorInterface $conversationMessageValidator
    )
    {

        $this->conversationFormatter= $conversationFormatter;
        $this->conversationMessageFormatter = $conversationMessageFormatter;
        $this->conversationMessageRepository = $conversationMessageRepository;
        $this->conversationRepository = $conversationRepository;
        $this->conversationMessageValidator = $conversationMessageValidator;
        
    }

    public function hasUnreadConversations($accountId)
    {

        return $this->conversationRepository->hasUnreadConversations($accountId);

    }

    public function markConversationAsRead($conversationId, $account)
    {
        
        $conversation = $this->conversationRepository->getConversation($conversationId);

        if(Gate::allows('view-conversation', $conversation))
        {

            $marked = true;
            $this->conversationRepository->update(
                $conversationId,
                $this->conversationFormatter->prepareDataForConversationMarkAsReadUpdate($conversation, $account->id)
            );

        } else {

            $marked = false;

        }

        return $this->conversationFormatter->prepareResponseDataForMarkConversationAsRead($marked);
		
    }   
 
	public function getConversations($userId)
	{

        $conversations = $this->conversationRepository->getConversations($userId);

        return $this->conversationFormatter->prepareConversationListForDisplay($userId, $conversations);
        
    }    
    
    public function getOrCreate($recipientId, $initiatorId)
    {

        $conversation = $this->conversationRepository->getConversationByInitiatorAndRecipientIds($recipientId, $initiatorId);

        if($conversation)
        {

            if($conversation->messages->count() === 0)
            {

                $this->conversationRepository->delete($conversation->id);

            } else {

                return $conversation->id;

            }

        }

        $conversation = $this->conversationRepository->createConversation($initiatorId, $recipientId);

        return $conversation->id;

    }

    public function sendMessage($account, $data)
    {

        if(!$this->conversationMessageValidator->validateCreate($data))
        {

            return $this->conversationMessageFormatter->prepareCreateResponseWithErrors($this->conversationMessageValidator->getErrors()->errors());

        }

        $conversation = $this->conversationRepository->getConversation($data['conversation_id']);

        if(Gate::allows('view-conversation', $conversation))
        {

            $message = $this->conversationMessageRepository->create(
                $this->conversationMessageFormatter->prepareRequestDataForCreation($data['conversation_id'], $data['type'], $data['message'])
            );
            $role = $conversation->initiator_id === Auth::id() ? 'initiator' : 'recipient';
            $updatedConversation = $this->conversationRepository->update(
                $data['conversation_id'],
                $this->conversationFormatter->prepareDataForSetToUnreadAction($role)
            );
            event(new NewMessage($message, $conversation));

            return $this->conversationMessageFormatter->prepareCreateResponseWithSuccess();
            
        }

        return $this->conversationMessageFormatter->prepareCreateResponseWithErrors($this->conversationMessageValidator->getErrors()->errors());

    }

    public function deleteEmptyConversations()
    {

        $this->conversationRepository->deleteEmptyConversations();

    }

}