<?php

namespace App\Model\Services\AdminSubsystem;

use App\Model\Contracts\Interfaces\Data\UserRepositoryInterface;
use App\Model\Contracts\Interfaces\Formatters\AdminSubsystem\UserFormatterInterface;
use App\Model\Contracts\Interfaces\Validators\AdminSubsystem\UserValidatorInterface;
use App\Model\Contracts\Interfaces\Services\AdminSubsystem\UserServiceInterface;
use App\Model\Contracts\Interfaces\Services\AdminSubsystem\EmailServiceInterface as AdminEmailService;
use App\Model\Contracts\Interfaces\Services\Common\TokenServiceInterface;
use App\Model\Contracts\Interfaces\Services\Common\EmailServiceInterface;
use App\Model\Contracts\Interfaces\Services\Common\FileServiceInterface;
use App\Model\Contracts\Interfaces\Services\TradeSubsystem\UserServiceInterface as TradeSubsystemUserService;
use Cache;
use Carbon\Carbon;
use Log;

class UserService implements UserServiceInterface
{

    protected $userRepository;
    protected $userFormatter;
    protected $userValidator;
    protected $tokenService;
    protected $emailService;
    protected $fileService;
    protected $tradeSubsystemUserService;
    protected $adminEmailService;

    public function __construct(
        UserFormatterInterface $userFormatter,
        UserValidatorInterface $userValidator,
        UserRepositoryInterface $userRepository,
        TokenServiceInterface $tokenService,
        EmailServiceInterface $emailService,
        FileServiceInterface $fileService,
        TradeSubsystemUserService $tradeSubsystemUserService,
        AdminEmailService $adminEmailService
    )
    {

        $this->userRepository = $userRepository;
        $this->userFormatter = $userFormatter;
        $this->userValidator = $userValidator;
        $this->tokenService = $tokenService;
        $this->emailService = $emailService;
        $this->fileService = $fileService;
        $this->tradeSubsystemUserService = $tradeSubsystemUserService;
        $this->adminEmailService = $adminEmailService;

    }    

    public function getLastYearStats()
    {

        $data['stats'] = $this->userRepository->getUserRegistrationStatsLast(6);
        $first  = strtotime('first day this month');
        
        for ($i = 5; $i >= 0; $i--)
        {

            $data['labels'][] = date('F', strtotime("-$i month", $first));

        }
        
        return $data;

    }

    public function getStats()
    {

        return [
            'totalUsers' => $this->userRepository->count(),
            'verifiedUsers' => $this->userRepository->getVerifiedUsersCount(),
            'withAtLeastOneTrade' => $this->userRepository->getWithAtLeastTrade(),
            'incompleteRegistration' => $this->userRepository->getIncompleteRegistrationCount()
        ];

    } 

    public function getUsersForCSV()
    {

        return $this->userRepository->getUsersForCSV();

    }   

    public function deleteUser($id)
    {

        $this->userRepository->delete($id);
        $this->fileService->deleteUserAvatars($id);
        $this->fileService->deleteUserCovers($id);

    }

    public function banUser($id)
    {

        $this->userRepository->ban($id);

    }

    public function unBanUser($id)
    {

        $this->userRepository->unban($id);

    }

    public function getTodayUserActivity()
    {

        return $this->userFormatter->prepareUserActivityForDisplay($this->userRepository->getWhereActiveAtIsMoreThan(Carbon::now()->subDays(1)));

    }

    public function getThisWeekUserActivity()
    {

        return $this->userFormatter->prepareUserActivityForDisplay($this->userRepository->getWhereActiveAtIsMoreThan(Carbon::now()->subDays(7)));

    }

    public function getUserActivity()
    {

        return [
            'todayUsers' => $this->getTodayUserActivity(),
            'thisWeekUsers' => $this->getThisWeekUserActivity()
        ];

    }

    public function all()
    {

        $users = $this->allNoFormat();

        return $this->userFormatter->prepareUsersForSelect($users);

    }

    public function allNoFormat()
    {

        return $this->userRepository->all();

    }

    public function paginate($perPage)
    {

        $users = $this->userRepository->paginate($perPage);

        return $this->userFormatter->prepareUsersForDisplay($users);

    }

    public function getForEdit($handle)
    {

        $user = $this->userRepository->getByHandle($handle);

        return $this->userFormatter->prepareUserForEditDisplay($user);

    }

    public function edit($data)
    {

        if(!$this->userValidator->validateEdit($data))
        {

            return $this->userValidator->getErrors();

        }

        $userBeforeUpdate = $this->userRepository->get($data['user_id']);
        $preparedData = $this->userFormatter->prepareRequestDataForUpdate($userBeforeUpdate, $data);
        $userAfterUpdate = $this->userRepository->updateUser($data['user_id'], $preparedData);
    
        if($this->needToResendConfirmationLink($userBeforeUpdate, $userAfterUpdate))
        {

            $token = $this->tokenService->generateUserRegistrationToken($userAfterUpdate);
            $url = url('/verify/') . '/'. $token;
            $this->emailService->sendUserConfirmationEmail($userAfterUpdate->email, $url);      
                  
        }

        return trans('AdminSubsystem/success-messages.user-edit-success');

    }

    private function needToResendConfirmationLink($userBeforeUpdate, $userAfterUpdate)
    {

        return
            (
                ($userAfterUpdate->status == 'unconfirmed' && $userBeforeUpdate->status !== 'unconfirmed') ||
                ($userAfterUpdate->email !== $userBeforeUpdate->email)
            );

    }

    public function getUnverifiedUsers()
    {

        return $this->userRepository->getUnverifiedUsers();

    }

    public function updateMainPortfolio($userId, $portfolioId)
    {

        $this->userRepository->updateUser(
            $userId,
            $this->userFormatter->prepareUserForMainPortfolioUpdate($portfolioId)
        );

    }

    public function updateCurrentPortfolio($userId, $portfolioId)
    {

        $this->userRepository->updateUser(
            $userId,
            $this->userFormatter->prepareUserForCurrentPortfolioUpdate($portfolioId)
        );

    }

    public function followRandomUsers()
    {

        $followedUsers = Cache::get('followed-users');

        if(!$followedUsers) 
        {

            $followedUsers = [];

        }

        $getUsersToFollow = $this->userRepository->getUsersToFollow($followedUsers);
        $ids = [417, 452, 456, 226, 697, 2723, 2733, 2739, 2771, 2777, 2881, 2963, 2685, 564, 6, 555, 2175];
        shuffle($ids);
        $getUsersToFollowFrom = $this->userRepository->getByIds($ids);
        $messages = [];
        
        for($i = 0; $i < 10 && $i < $getUsersToFollow->count(); $i++)
        {

            $getUsersToFollowFrom = $getUsersToFollowFrom->shuffle();

            foreach($getUsersToFollowFrom as $userFrom)
            {

                if(!$userFrom->followings->contains('following_id', $getUsersToFollow[$i]->id) && $getUsersToFollow[$i]->id !== $userFrom->id)
                {

                    $this->tradeSubsystemUserService->follow($getUsersToFollow[$i]->id, $userFrom->id);
                    $messages[] = $userFrom->username . " FOLLOWED " . $getUsersToFollow[$i]->username;
                    $followedUsers[] = $getUsersToFollow[$i]->id;
                    break;

                }

            }

        }

        $this->adminEmailService->sendEmailToAdministratorAboutFollow($messages);
        Cache::put('followed-users', $followedUsers, Carbon::now()->addDays(365)); 

    }

}