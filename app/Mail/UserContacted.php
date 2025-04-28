<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserContacted extends Mailable
{
    use Queueable, SerializesModels;

    private $fullName;
    private $email;
    private $message;
	
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($fullName, $email, $message)
    {
		
        $this->fullName = $fullName;
        $this->email = $email;
        $this->message = $message;
		
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.FrontSubsystem.userContacted')->with([
            'fullName' => $this->fullName,
            'email' => $this->email,
            'message' => $this->message
		]);        
    }
}
