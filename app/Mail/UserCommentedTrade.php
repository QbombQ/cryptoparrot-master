<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserCommentedTrade extends Mailable
{
    use Queueable, SerializesModels;

	private $tradeAuthorUsername;
	private $tradeAuthorHandle;
	private $commentAuthorUsername;
	private $tradeId;
	
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($tradeAuthorUsername, $tradeAuthorHandle, $commentAuthorUsername, $tradeId)
    {
		
        $this->tradeAuthorUsername = $tradeAuthorUsername;
        $this->tradeAuthorHandle = $tradeAuthorHandle;
        $this->commentAuthorUsername = $commentAuthorUsername;
        $this->tradeId = $tradeId;
		
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('New Comment On Your Trade')->markdown('emails.TradeSubsystem.userCommentedTrade')->with([
			'tradeAuthorUsername' => $this->tradeAuthorUsername,
			'commentAuthorUsername' => $this->commentAuthorUsername,
			'url' => url('/'.$this->tradeAuthorHandle.'/trade/'.$this->tradeId)
		]);        
    }

} 
