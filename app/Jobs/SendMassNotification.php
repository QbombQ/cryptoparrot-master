<?php

namespace App\Jobs;

use App\Model\Contracts\Interfaces\Services\Common\NotificationServiceInterface;
use App\Model\Contracts\Interfaces\Services\FrontSubsystem\DeviceServiceInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App;

class SendMassNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $users;
    protected $text;
    protected $url;
    
    public function __construct($users, $text, $url)
    {

        $this->users = $users;
        $this->text = $text;
        $this->url = $url;
        
    }

    public function handle()
    {

        $notificationService = App::make(NotificationServiceInterface::class);
        $deviceService = App::make(DeviceServiceInterface::class);
        $allowedIps = [];

        foreach($this->users as $user)
        {

            if($user->notificationSettings->signals == 1)
            {

                $allowedIps[] = $user->id;

                $notificationService->createNotification(
                    $user->id,
                    16,
                    $this->text,
                    $this->url
                );

            }

        }

        $devices = $deviceService->getUsersDevices($allowedIps);

        if($devices->count() > 0)
        {

            $recipients = $devices->pluck('firebase_token')->toArray();

            fcm()
            ->to($recipients)
            ->data([
                'url' => $this->url
            ])
            ->notification([
                'title' => 'Signal',
                'body' => $this->text,
            ])
            ->send();

        }

    }

    public function markAsFailed(){}
    public function hasFailed() {}
    public function isReleased() {}    

}