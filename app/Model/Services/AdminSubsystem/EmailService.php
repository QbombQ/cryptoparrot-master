<?php

namespace App\Model\Services\AdminSubsystem;

use App\Model\Contracts\Interfaces\Services\AdminSubsystem\EmailServiceInterface;
use App\Model\Contracts\Interfaces\Services\Common\TokenServiceInterface;
use App\Model\Contracts\Interfaces\Formatters\AdminSubsystem\EmailFormatterInterface;
use App\Model\Contracts\Interfaces\Validators\AdminSubsystem\EmailValidatorInterface;
use App\Model\Contracts\Interfaces\Data\UserRepositoryInterface;
use App\Mail\UserRetention;
use Mail;
use App\Mail\MassEmail;
use App\Jobs\SendMassEmail;
use App\Jobs\SendMassVerificationEmails;
use App\Mail\ResendVerification;
use App\Mail\NotifyAboutFollowedUsers;
use Cache;
use App;
use Carbon\Carbon;

class EmailService implements EmailServiceInterface
{
    
    protected $emailFormatter;
    protected $emailValidator;
    protected $userRepository;


    const ADMIN_EMAILS = [
        'office@cryptoparrot.com',
    ];

    public function __construct(
        EmailFormatterInterface $emailFormatter,
        EmailValidatorInterface $emailValidator,
        UserRepositoryInterface $userRepository
    )
    {

        $this->emailFormatter = $emailFormatter;
        $this->emailValidator = $emailValidator;
        $this->userRepository = $userRepository;

    }

    public function sendMassEmail($data)
    {
        if(!$this->emailValidator->validateMassEmail($data))
        {

            return $this->emailValidator->getErrors();

        } 

        $preparedMassEmailData = $this->emailFormatter->prepareMassEmailData($data);

        if(array_key_exists('test_email', $data) && $data['test_email'])
        {

            Mail::to($data['test_email'])->send(new MassEmail($preparedMassEmailData, $data['test_email']));

        }else{

            if(array_key_exists('users', $data))
            {

                $usersList = $this->userRepository->getByIds($data['users']);

            }elseif(array_key_exists('ref', $data) && $data['ref'])
            {

                $usersList = $this->userRepository->getByRefCode($data['ref']);

            }elseif(array_key_exists('competition', $data))
            {

                $usersList = $this->userRepository->getUsersThatParticipateIn($data['competition']);

            }else{

                if(array_key_exists('badge', $data))
                {

                    $usersList = $this->userRepository->getUsersWithBadges($data['badge']);

                }else{

                    $usersList = $this->userRepository->all();

                }

            } 

            $usersList = $usersList->unique('id');

            if($usersList->count() > 0)
            {

                Cache::put('newsletter-start-date', Carbon::now()->toDateTimeString(), Carbon::now()->addDays(10));
                Cache::put('newsletter-end-date', null, Carbon::now()->addDays(10));
                Cache::put('newsletter-total-users', $usersList->count(), Carbon::now()->addDays(10));
                Cache::put('newsletter-messages-sent', [], Carbon::now()->addDays(10));
                Cache::put('newsletter-already-sent', [], Carbon::now()->addDays(10));
                Cache::put('newsletter-problematic-users', [], Carbon::now()->addDays(10));
                SendMassEmail::dispatch($usersList, $preparedMassEmailData)->onQueue('email'); 

            } 

        }

        return trans('AdminSubsystem/success-messages.mass-email-send-success');                

    }

    public function resendVerification($users)
    {

        if($users->count() > 0)
        {

            $tokenService = App::make(TokenServiceInterface::class);

            foreach($users as $user)
            {

                if($user->email)
                {

                    $token = $tokenService->generateUserRegistrationToken($user);
                    $url = url('/verify/') . '/'. $token;
                    Mail::to($user->email)->send(new ResendVerification($url));

                }

            }

            return trans('AdminSubsystem/success-messages.verification-emails-sent');

        }
        
        return trans('AdminSubsystem/success-messages.all-users-confirmed');

    }

    public function sendEmailToAdministratorAboutFollow($messages)
	{

        foreach(self::ADMIN_EMAILS as $email)
        {

            Mail::to($email)->send(new NotifyAboutFollowedUsers($messages));

        }

	}

    public function sendRetentionEmail($user, $step)
    {
        Mail::to($user->email)->send(new UserRetention($user, $step));

        return trans('AdminSubsystem/success-messages.verification-emails-sent');
    }

 
}