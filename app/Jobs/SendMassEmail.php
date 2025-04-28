<?php

namespace App\Jobs;

use App\Model\Contracts\Interfaces\Data\NewsletterMessageRepositoryInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Mail\MassEmail;
use App;
use Log;
use Mail;
use Cache;
use Carbon\Carbon;

class SendMassEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $usersList;
    protected $preparedMassEmailData;

    public function __construct($usersList, $preparedMassEmailData)
    {

        $this->usersList = $usersList;
        $this->preparedMassEmailData = $preparedMassEmailData;

    }

    public function handle()
    {

        $newsletterMessageRepository = App::make(NewsletterMessageRepositoryInterface::class);
        $messagesSent = Cache::get('newsletter-messages-sent');
        $alreadySent = Cache::get('newsletter-already-sent');
        $problematicUsers = Cache::get('newsletter-problematic-users');

        foreach($this->usersList as $user) 
        {

            if($user->email && $user->notificationSettings && $user->notificationSettings->newsletters) 
            {

                $newsletterMessage = $newsletterMessageRepository->get($user->id, $this->preparedMassEmailData['subject']);

                if(!$newsletterMessage) 
                {

                    Mail::to($user->email)->send(new MassEmail($this->preparedMassEmailData, $user->email));
                    $newsletterMessageRepository->add([
                        'user_id' => $user->id,
                        'subject' => $this->preparedMassEmailData['subject']
                    ]);
                    $key = $user->id;
                    $messagesSent[$key] = Carbon::now()->toDateTimeString();
                    Cache::put('newsletter-messages-sent', $messagesSent, Carbon::now()->addDays(10)); 
                    continue;                   

                }else{

                    $key = $user->id;
                    $alreadySent[$key] = Carbon::now()->toDateTimeString();
                    Cache::put('newsletter-already-sent', $alreadySent, Carbon::now()->addDays(10));
                    continue;

                }

            }

            $key = $user->id;
            $problematicUsers[$key] = Carbon::now()->toDateTimeString();
            Cache::put('newsletter-problematic-users', $problematicUsers, Carbon::now()->addDays(10));     

        }
        
        Cache::put('newsletter-end-date', Carbon::now()->toDateTimeString(), Carbon::now()->addDays(10));

    }

    public function markAsFailed(){}
    public function hasFailed() {}
    public function isReleased() {}

}