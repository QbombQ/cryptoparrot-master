<?php

namespace App\Model\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;

class UserNotification implements ShouldBroadcastNow
{
    /**
     * Information about the shipping status update.
     *
     * @var string
     */
    public $notification;

    /**
     * Create a new event instance.
     * @return void
     */
    public function __construct($notification)
    {

        $this->notification = $notification;

    }    

    public function broadcastOn()
    {

        return new PrivateChannel('user.'.$this->notification->user_id);
        
    }

    public function broadcastWith()
    {

        return [
            'id' => $this->notification->user_id,
            'url' => $this->notification->url,
            'title' => $this->notification->type ? $this->notification->type->title : '',
            'text' => $this->notification->text,
            'icon' => $this->notification->type ? $this->notification->type->icon : ''
        ];
        
    }
    
}