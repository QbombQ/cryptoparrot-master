<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class BadgeGiven extends Mailable
{
    use Queueable, SerializesModels;

    private $badge;
    private $handle;
    private $username;
	 
    /**
     * Create a new message instance.
     *
     * @return void
     */
    
    public function __construct($badge,$handle,$username)
    {
		
        $this->badge = $badge;
        $this->handle = $handle;
        $this->username = $username;
		
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('New Badge Received')->markdown('emails.TradeSubsystem.badgeGiven')->with([
            'badge' => $this->badge,
            'username' => $this->username,  
            'url' => url($this->handle),   
		]);          
    }
}
