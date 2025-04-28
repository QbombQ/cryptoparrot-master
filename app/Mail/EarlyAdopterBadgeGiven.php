<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EarlyAdopterBadgeGiven extends Mailable
{
    use Queueable, SerializesModels;

    private $badge;
	
    /**
     * Create a new message instance.
     *
     * @return void
     */
    
    public function __construct($badge)
    {
		
        $this->badge = $badge;
		
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->subject('Soft Launch Invite For Pre-Registered Early Adopters!')->markdown('emails.TradeSubsystem.earlyAdopterBadgeGiven')->with([
            'badge' => $this->badge,
            'url'=> url('/')
		]);         
    }
} 
