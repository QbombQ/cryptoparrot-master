<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MassEmail extends Mailable
{
    use Queueable, SerializesModels;

    
    private $data;
    private $email;
	
    /**
     * Create a new message instance.
     *
     * @return void
     */
    
    public function __construct($data, $email)
    {
		
        $this->data = $data;
        $this->email = $email;
		
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('no-reply@cryptoparrot.com', 'Aidas From CryptoParrot.com') 
        ->replyTo('office@cryptoparrot.com', 'Aidas From CryptoParrot.com') 
        ->subject($this->data['subject'])
        ->markdown('emails.TradeSubsystem.massEmail')
        ->with([
            'content' => $this->data['content'],
            'url' => url('/') . '/unsubscribe-newsletter/' . strtr(base64_encode($this->email), '+/=', '._-')
		]);        
    }
}
 