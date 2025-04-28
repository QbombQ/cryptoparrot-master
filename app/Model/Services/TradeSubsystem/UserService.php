<?php 

namespace App\Model\Services\TradeSubsystem;

use App\Model\Contracts\Interfaces\Data\UserNotificationSettingRepositoryInterface;
use App\Model\Contracts\Interfaces\Data\UserRepositoryInterface;
use App\Model\Contracts\Interfaces\Data\UserSocialMediaAccountRepositoryInterface;
use App\Model\Contracts\Interfaces\Data\FollowRepositoryInterface;
use App\Model\Contracts\Interfaces\Formatters\TradeSubsystem\UserFormatterInterface;
use App\Model\Contracts\Interfaces\Formatters\TradeSubsystem\UserNotificationSettingFormatterInterface;
use App\Model\Contracts\Interfaces\Services\Common\FileServiceInterface;
use App\Model\Contracts\Interfaces\Services\Common\TokenServiceInterface;
use App\Model\Contracts\Interfaces\Services\Common\EmailServiceInterface;
use App\Model\Contracts\Interfaces\Services\Common\UserServiceInterface as CommonUserServiceInterface;
use App\Model\Contracts\Interfaces\Services\TradeSubsystem\UserServiceInterface;
use App\Model\Contracts\Interfaces\Services\TradeSubsystem\TradeServiceInterface;
use App\Model\Contracts\Interfaces\Formatters\TradeSubsystem\FollowFormatterInterface;
use App\Model\Contracts\Interfaces\Validators\Common\UserValidatorInterface;
use App\Model\Contracts\Interfaces\Services\AdminSubsystem\BadgeServiceInterface;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserService implements UserServiceInterface
{

	protected $userFormatter;
	protected $userValidator;
	protected $userRepository;
	protected $userSocialMediaAccountRepository;
	protected $commonService;
	protected $fileService;
	protected $tradeService;
	protected $followRepository;
	protected $followFormatter;
	protected $userNotificationSettingRepository;
	protected $userNotificationSettingFormatter;
	protected $tokenService;
	protected $emailService;	
	protected $badgeService;	

	public function __construct(UserFormatterInterface $userFormatter,
								UserValidatorInterface $userValidator,
								UserRepositoryInterface $userRepository,
								FileServiceInterface $fileService,
								UserSocialMediaAccountRepositoryInterface $userSocialMediaAccountRepository,
								TradeServiceInterface $tradeService,
								FollowRepositoryInterface $followRepository,
								FollowFormatterInterface $followFormatter,
								UserNotificationSettingRepositoryInterface $userNotificationSettingRepository,
								UserNotificationSettingFormatterInterface $userNotificationSettingFormatter,
								TokenServiceInterface $tokenService, 
								EmailServiceInterface $emailService,
								BadgeServiceInterface $badgeService,
                                CommonUserServiceInterface $commonService) 
	{

		$this->userFormatter = $userFormatter;
		$this->userValidator = $userValidator;
		$this->userRepository = $userRepository;
		$this->userSocialMediaAccountRepository = $userSocialMediaAccountRepository;
		$this->commonService = $commonService;
		$this->fileService = $fileService;
		$this->tradeService = $tradeService;
		$this->followRepository = $followRepository;
		$this->followFormatter = $followFormatter;
		$this->userNotificationSettingRepository = $userNotificationSettingRepository;
		$this->userNotificationSettingFormatter = $userNotificationSettingFormatter;
		$this->tokenService = $tokenService;
		$this->emailService = $emailService;		
		$this->badgeService = $badgeService;		
		
	}	

	public function getUserProfile($handle)
	{

		$user = $this->commonService->getByHandle($handle);
		
		return $user ?
				$this->userFormatter->prepareUserForProfilePage($user) :
				null;
		
	}

	public function giveEarlyAdopterBadgesForNewUsers()
	{

		$users = $this->userRepository->getCreatedInLastHour();
		
		foreach($users as $user)
		{

			if(!$user->badges->contains('title', 'Early Adopter'))
			{

				$this->badgeService->give([
					'badge_id' => 1,
					'user_id' => $user->id
				]);

			}

		}

	}

	public function getUserSettings($id)
	{
        
		$user = $this->commonService->getById($id);
		
		return $user ?
				$this->userFormatter->prepareUserForSettingsPage($user) :
				null;
		
	}	

	public function updateProfile($request)
	{

		if(!$this->userValidator->validateProfileUpdate(Auth::id(), $request->all())) 
		{
			
			return [
				'success' => false,
				'message' => $this->userValidator->getErrors()->errors()->first()
			];

		}

		$this->userNotificationSettingRepository->update(
			Auth::user()->notificationSettings->id,
			['direct_messages' => $request['notifications']['direct_messages'] == 'on' ? 1 : 0 ]
		);	

		if($this->userRepository->updateUser(Auth::id(), $this->userFormatter->prepareRequestDataForProfileUpdate($request->all())))
		{

			return [
				'success' => true,
				'message' => trans('TradeSubsystem/success-messages.profile-update-successful')
			];

		}

		return [
			'success' => false,
			'message' => trans('TradeSubsystem/error-messages.something-went-wrong')
		];

	}

	public function updateSocialLinks($request)
	{

		if(!$this->userValidator->validateSocialLinksUpdate($request->all())) 
		{
			
			return [
				'success' => false,
				'message' => $this->userValidator->getErrors()->errors()->first()
			];

		}

		$this->userSocialMediaAccountRepository->deleteByUserId(Auth::id());

		if($request->social)
		{

			foreach($request->social as $network => $url)
			{

				$this->userSocialMediaAccountRepository->create(Auth::id(), $network, $url);
				
			}

		}

		return [
			'success' => true,
			'message' => trans('TradeSubsystem/success-messages.social-links-update-successful')
		];

	}

	public function updateNotifications($request)
	{

		if(!$this->userValidator->validateNotificationsUpdate($request->all())) 
		{
			
			return [
				'success' => false,
				'message' => $this->userValidator->getErrors()->errors()->first()
			];

		}

		$this->userNotificationSettingRepository->deleteByUserId(Auth::id());

		if($request->notifications)
		{

			$this->userNotificationSettingRepository->create(
				$this->userNotificationSettingFormatter->prepareNotificationSettingsForCreate($request->notifications)
			);	

		}

		return [
			'success' => true,
			'message' => trans('TradeSubsystem/success-messages.notifications-update-successful')
		];

	}
	
	public function updatePassword($request)
	{

		if(!$this->userValidator->validatePasswordUpdate($request->all(), Auth::user()->password)) 
		{
			
			return [
				'success' => false,
				'message' => $this->userValidator->getErrors()->errors()->first()
			];

		}

		$this->userRepository->updateUser(Auth::id(), $this->userFormatter->prepareRequestDataForPasswordUpdate($request->all()));

		return [
			'success' => true,
			'message' => trans('TradeSubsystem/success-messages.password-update-successful')
		];

	}	

	public function updateAvatar($request)
	{

		if(!$this->userValidator->validateAvatarUpdate($request->all())) 
		{
			
			return [
				'success' => false,
				'message' => $this->userValidator->getErrors()->errors()->first()
			];

		}

		$path = $this->fileService->uploadAvatar($request, Auth::id());
		$request->merge(['path' => $path['path']]);
		$this->userRepository->updateUser(Auth::id(), $this->userFormatter->prepareRequestDataForAvatarUpdate($request));

		return [
			'success' => true,
			'message' => trans('TradeSubsystem/success-messages.avatar-update-successful'),
			'path' => $this->userFormatter->prepareAvatarPathForDisplaying($path)
		];

	}		

	public function updateCover($request)
	{

		if(!$this->userValidator->validateCoverUpdate($request->all())) 
		{
			
			return ['success' => false, 'message' => $this->userValidator->getErrors()->errors()->first()];

		}

		$path = $this->fileService->uploadCover($request, Auth::id());
		$request->merge(['path' => $path]);
		$this->userRepository->updateUser(Auth::id(), $this->userFormatter->prepareRequestDataForCoverUpdate($request));

		return [
			'success' => true,
			'message' => trans('TradeSubsystem/success-messages.cover-update-successful'),
			'path' => $this->userFormatter->prepareCoverPathForDisplaying($path)
		];

	}	

	public function uploadTempCover($request)
	{

		if(!$this->userValidator->validateCoverUpdate($request->all())) 
		{
			
			return [
				'success' => false,
				'message' => $this->userValidator->getErrors()->errors()->first()
			];

		}

		$path = $this->fileService->uploadTempCover($request);
		$request->merge(['path' => $path]);

		return [
			'success' => true,
			'message' => trans('TradeSubsystem/success-messages.cover-update-successful'),
			'path' => $this->userFormatter->prepareCoverPathForDisplaying($path)
		];

	}		

	public function topTraders($limit, $timePeriod)
	{

		$users = $this->userRepository->topUsers($limit, $timePeriod);
		
		return $this->userFormatter->prepareUsersForTopTradersPage($users, $timePeriod);

	}

	public function topTradersDeclineDaysIfNone($limit)
	{

		$top7Days = $limit;
		$topTraders = $this->topTraders(config('custom.perPage.topTraders'), Carbon::now()->subDays($top7Days--)->toDateString());

		while(!$topTraders || count($topTraders) === 0)
		{

			if($top7Days <= 0)
			{

				break;

			}

			$topTraders = $this->topTraders(config('custom.perPage.topTraders'), Carbon::now()->subDays($top7Days--)->toDateString());

		}

		return $topTraders;

	}

	public function topTradersAjax($limit, $timePeriod)
	{

		$users = $this->userRepository->topUsers($limit, $timePeriod);

		return $this->userFormatter->prepareUsersForTopTradersPageAjax($users, $timePeriod);

	}	

	public function latestTraders($limit)
	{

		$users = $this->userRepository->latestUsers($limit, Auth::id());

		return $this->userFormatter->prepareUsersForTopTradersPage($users, 'lifetime');

	}	

	public function getUserTrades($page, $handle, $timestamp = null)
	{

		$user = $this->commonService->getByHandle($handle);

		if(!$timestamp || !is_int($timestamp))
		{

			$startTimestamp = Carbon::now()->toDateTimeString();

		} else {

			$startTimestamp = Carbon::createFromTimestamp($timestamp+5)->toDateTimeString();

		}

		return $this->tradeService->getTrades($page, $user, true, $startTimestamp, []);

	}
		
	public function getUserFollowers($page, $handle)
	{

		$user = $this->commonService->getByHandle($handle);
		
		return $user ?
					$this->tradeService->getTrades($page, $user, true, Carbon::createFromTimestamp(time())->toDateString()) :
					null;

	}

	public function updateSavedPair($pairId)
	{

		session()->put('pairId', $pairId);

	}
	
	public function deleteSavedPair()
	{

		session()->forget('pairId');

	}	

	public function follow($followingId, $followerId)
	{

		if(!$this->followRepository->alreadyFollows($followingId, $followerId))
		{

			$this->followRepository->create(
				$this->followFormatter->prepareDataForCreation($followingId, $followerId)
			);

		}

	}

	public function unfollow($followingId, $followerId)
	{

		$this->followRepository->delete($followingId, $followerId);

	}	

	public function resendConfirmationLink()
	{

		if(Auth::check() && Auth::user()->status == 'unconfirmed')
		{

			$user = Auth::user();
            $token = $this->tokenService->generateUserRegistrationToken($user);
            $url = url('/verify/') . '/'. $token;
			$this->emailService->sendUserConfirmationEmail($user->email, $url);  	

			return [
				'success' => true,
				'message' => 'Check your email'
			];	
			
		}

		return [
			'success' => false,
			'message' => 'Something went wrong'
		];

	}

	public function updateUserActivity($user)
	{

		$user->active_at = Carbon::now()->toDateTimeString();
		$user->ip = request()->ip();
		$user->save();

	}
	
}