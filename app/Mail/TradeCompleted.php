<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class TradeCompleted extends Mailable
{
    use Queueable, SerializesModels;

    
    private $trade_id;
    private $username;
	
    /**
     * Create a new message instance.
     *
     * @return void
     */
    
    public function __construct($trade_id, $username)
    {
		
        $this->trade_id = $trade_id;
        $this->username = $username;
	
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Trade #' . $this->trade_id . ' Complete')->markdown('emails.TradeSubsystem.tradeCompleted')->with([
            'url' => url('/login'),
            'username' => $this->username,
            'trade_id' => $this->trade_id
		]);
    }
}
