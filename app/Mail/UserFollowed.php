<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserFollowed extends Mailable
{
    use Queueable, SerializesModels;

	private $followingUsername;
	private $followerUsername;
	private $followerHandle;
	
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($followingUsername, $followerUsername, $followerHandle)
    {
		
        $this->followingUsername = $followingUsername;
        $this->followerUsername = $followerUsername;
        $this->followerHandle = $followerHandle;
		
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('New Follower')->markdown('emails.TradeSubsystem.userFollowed')->with([
			'followingUsername' => $this->followingUsername,
			'followerUsername' => $this->followerUsername,
			'url' => url('/'.$this->followerHandle)
		]);        
    }

} 
