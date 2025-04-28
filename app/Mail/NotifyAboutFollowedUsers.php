<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyAboutFollowedUsers extends Mailable
{
    use Queueable, SerializesModels;

    
    private $messages;
	
    /**
     * Create a new message instance.
     *
     * @return void
     */
    
    public function __construct($messages)
    {
		
        $this->messages = $messages;
	
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        $subject = 'Users followed today';

        return $this->subject($subject)->markdown('emails.TradeSubsystem.notificationAboutFollowedUsers')->with([
            'messages' => $this->messages
		]);        
    }
}
