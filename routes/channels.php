<?php

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

use App\Model\Data\Models\Conversation;

Broadcast::channel('App.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('follower-trade.{userId}', function ($user, $userId) {
    return $user->id == $userId;
});

Broadcast::channel('conversation.{conversationId}', function ($user, $conversationId) {

    $conversation = Conversation::find($conversationId);
    if(!$conversation) {
        return false;
    }
    return $user->id == $conversation->initiator_id || $user->id == $conversation->recipient_id;
    
});

Broadcast::channel('global-trade.{userId}', function ($user, $userId) {
    return $user->id == $userId;
});

Broadcast::channel('user.{userId}', function ($user, $userId) {
    return $user->id == $userId;
});