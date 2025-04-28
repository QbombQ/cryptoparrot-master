<?php

namespace App\Model\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;

class NewTrade implements ShouldBroadcastNow
{
    /**
     * Information about the shipping status update.
     *
     * @var string
     */
    public $tradeId;

    /**
     * Create a new event instance.
     * @return void
     */
    public function __construct($tradeId)
    {

        $this->tradeId = $tradeId;

    }    

    public function broadcastOn()
    {

        return new Channel('new-trade');
        
    }

    public function broadcastWith()
    {

        return [
            'tradeId' => $this->tradeId
        ];
        
    }
    
}