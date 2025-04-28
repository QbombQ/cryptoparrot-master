<?php

namespace App\Model\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;

class RedeemCompleted implements ShouldBroadcastNow
{
    /**
     * Information about the shipping status update.
     *
     * @var string
     */
    public $exchange;

    /**
     * Create a new event instance.
     * @return void
     */
    public function __construct($exchange)
    {

        $this->exchange = $exchange;

    }    

    public function broadcastOn()
    {

        return new PrivateChannel('user.'.$this->exchange->user_id);
        
    }

    public function broadcastWith()
    {

        return [
            'id' => $this->exchange->user_id,
            'status' => $this->exchange->status
        ];
        
    }
    
}