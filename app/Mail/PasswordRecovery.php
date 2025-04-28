<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PasswordRecovery extends Mailable
{
    use Queueable, SerializesModels;

    private $url;
    private $username;
	
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($url, $username)
    {
		
        $this->url = $url;
        $this->username = $username;
		
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Password Reset')->markdown('emails.FrontSubsystem.passwordRecovery')->with([
            'url' => $this->url,
            'username' => $this->username
		]);        
    }
}
