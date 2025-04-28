<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class UnreadNotifications extends Mailable
{
    use Queueable, SerializesModels;

    private $username;
    private $total;

    public function __construct($username, $total)
    {

        $this->username = $username;
        $this->total = $total;

    }

    /**
     * Build the message. 
     *
     * @return $this
     */
    public function build()
    {

        return $this->subject('You have ' . $this->total . ' unread notifications')->markdown('emails.TradeSubsystem.unreadNotifications')->with([
            'username' => $this->username,
            'total' => $this->total
        ]);
        
    }
}
