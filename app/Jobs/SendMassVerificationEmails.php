<?php

namespace App\Jobs;

use App\Model\Contracts\Interfaces\Common\TokenServiceInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Mail\UserRegistered;
use App;
use Mail;

class SendMassVerificationEmails implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $usersList;

    public function __construct($usersList)
    {

        $this->usersList = $usersList;

    }

    public function handle()
    {

        $tokenService = App::make(TokenServiceInterface::class);

        foreach($this->usersList as $user) 
        {

            if($user->email) 
            {

                $token = $tokenService->generateUserRegistrationToken($user);
                $url = url('/verify/') . '/'. $token;
                Mail::to($user->email)->send(new UserRegistered($url));

            }            

        }

    }

    public function markAsFailed(){}
    public function hasFailed() {}
    public function isReleased() {}        
    
}