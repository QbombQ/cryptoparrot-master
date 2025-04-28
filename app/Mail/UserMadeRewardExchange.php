<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserMadeRewardExchange extends Mailable
{
    use Queueable, SerializesModels;

    private $data;
    private $user;
 
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data, $user)
    {
        
        $this->data = $data;
        $this->user = $user;
    
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Congrats! You have successfully exchanged some play dollars')->markdown('emails.TradeSubsystem.userMadeRewardExchange')->with([
            'amountPlayDollars' => $this->data['amount_play_dollars_formatted'],
            'amountBTC' => number_format($this->data['amount_BTC'], 8),
            'username' => $this->user->username, 
        ]);    
    }
}
 