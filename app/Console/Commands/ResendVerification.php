<?php

namespace App\Console\Commands;

use App\Model\Contracts\Interfaces\Services\AdminSubsystem\UserServiceInterface;
use App\Model\Contracts\Interfaces\Services\AdminSubsystem\EmailServiceInterface;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use App;

class ResendVerification extends Command
{

    private $userService;
    private $emailService;

    protected $signature = 'verification:resend';

    public function handle()
    {

        $this->createServices();
        $unverifiedUsers = $this->userService->getUnverifiedUsers();
        $responseMessage = $this->emailService->resendVerification($unverifiedUsers);
        echo $responseMessage;

    }

    private function createServices()
    {

        $this->userService = App::make(UserServiceInterface::class);
        $this->emailService = App::make(EmailServiceInterface::class);

    }

}