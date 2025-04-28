<?php 

namespace App\Model\Formatters\Common;

use App\Model\Contracts\Interfaces\Formatters\Common\ConversationFormatterInterface;
use App\Model\Contracts\Interfaces\Services\Common\ConversationMessageServiceInterface;
use Illuminate\Support\Facades\Storage;
use Avatar;
use Auth;
use Carbon;
use Media;
use Time;

class ConversationFormatter implements ConversationFormatterInterface
{
    
    protected $conversationMessageService;

    public function __construct(
        ConversationMessageServiceInterface $conversationMessageService
    )
    {

        $this->conversationMessageService = $conversationMessageService;

    }

    public function prepareDataForConversationMarkAsReadUpdate($conversation, $accountId)
    {

        $type = $conversation->initiator_id === $accountId ? 'initiator_status' : 'recipient_status';

        return [
            $type => 'read'
        ];

    }

    public function prepareResponseDataForMarkConversationAsRead($marked)
    {

        return [
            'success' => $marked ? true : false
        ];

    }

    public function prepareConversationListForDisplay($accountId, $conversations)
    {

        $results = [];

        if($conversations->isNotEmpty())
        {

            foreach($conversations as $conversation)
            {

                if($conversation->messages->count() > 0 || $conversation->initiator_id === Auth::id())
                {

                    $results[] = $this->prepareConversationListItemForDisplay($accountId, $conversation);

                }

            }
            
        }

        return $results;

    }    

    public function prepareConversationListItemForDisplay($accountId, $conversation)
    {

        $account = $conversation->initiator_id === $accountId ? $conversation->recipient : $conversation->initiator;
        
        return [
            'id' => $conversation->id,
            'online' => $account->isOnline(),
            'active_ago' => Carbon\Carbon::parse($account->active_at)->diffForHumans(),
            'message' => $this->conversationMessageService->getNewestConversationMessageText($conversation->id),
            'initiatorStatus' => $conversation->initiator_status,
            'recipientStatus' => $conversation->recipient_status,
            'updatedAt' => Time::formatDateDiffForHumans($conversation->updated_at),
            'updatedAtNoFormat' => $conversation->updated_at,
            'username' => $account->username,
            'userId' => $account->id,
            'handle' => $account->handle,
            'avatar' => Media::getUserAvatar($account),          
            'role' => $conversation->initiator_id === $accountId ? 'initiator' : 'recipient'
        ];

    }    

    public function prepareDataForSetToUnreadAction($role)
    {

        return [
			'initiator_status' => $role === 'initiator' ? 'read' : 'unread',
			'recipient_status' => $role === 'recipient' ? 'read' : 'unread',
        ];

    }
	
}