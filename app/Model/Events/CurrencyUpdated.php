<?php

namespace App\Model\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class CurrencyUpdated implements ShouldBroadcast
{
    /**
     * Information about the shipping status update.
     *
     * @var string
     */
    public $symbol;
    public $price;
    public $direction;
    public $change;
    public $type;

    public $broadcastQueue;

    /**
     * Create a new event instance.
     * @return void
     */
    public function __construct($symbol, $price, $direction, $change, $type)
    {
        
        $this->symbol = $symbol;
        $this->price = $price;
        $this->direction = $direction;
        $this->change = $change;
        $this->type = $type;
        $this->broadcastQueue = env('PREFIX').'-high';

        // $exists = Storage::disk('public')->exists('logs/'.$symbol.'.txt');     

        // if(!$exists)
        // {

        //     Storage::disk('public')->put('logs/'.$symbol.'.txt', '');

        // } 

        // Storage::disk('public')->append('logs/'.$symbol.'.txt', PHP_EOL . "[".Carbon::now()->toDateTimeString()."] " . $symbol . " : " . $price);

    }    

    public function broadcastOn()
    {

        return new Channel('price-updated');
        
    }

    public function broadcastWith()
    {

        return [
            'pairId' => $this->symbol,
            'price' => $this->price,
            'change' => $this->change,
            'type' => $this->type,
            'direction' => $this->direction
        ];

    }

    public function handle()
    {

        if ($this->attempts() > 1)
        {

            return;

        }
        
    }    
    
}