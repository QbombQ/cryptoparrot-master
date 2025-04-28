<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AdministratorNotification extends Mailable
{
    use Queueable, SerializesModels;

    
    private $type;
    private $data;
    
    public function __construct($type, $data)
    {
		
        $this->type = $type;
        $this->data = $data;
	
    }
    
    public function build()
    {

        switch($this->type)
        {

            case 'registration':
                $subject = 'New registration at Niffler.co';
                break;
            case 'claim_reward':
                $subject = 'New reward claim at Niffler.co';
                break;
            default:
                $subject = 'New trade at Niffler.co';

        }

        return $this->subject($subject)->markdown('emails.TradeSubsystem.adminNotification')->with([
            'type' => $this->type,
            'data' => $this->data
		]);        
    }
}
