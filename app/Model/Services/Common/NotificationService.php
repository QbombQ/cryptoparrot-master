<?php 

namespace App\Model\Services\Common;

ini_set('max_execution_time', 180);

use App\Model\Contracts\Interfaces\Services\Common\NotificationServiceInterface;
use App\Model\Contracts\Interfaces\Services\Common\EmailServiceInterface;
use App\Model\Contracts\Interfaces\Data\UserNotificationRepositoryInterface;
use App\Model\Contracts\Interfaces\Data\UserNotificationSettingRepositoryInterface;
use App\Model\Contracts\Interfaces\Data\UserRepositoryInterface;
use App\Model\Contracts\Interfaces\Formatters\Common\NotificationFormatterInterface;

class NotificationService implements NotificationServiceInterface
{

	protected $userNotificationRepository;
	protected $userNotificationSettingRepository;
	protected $userRepository;
	protected $notificationFormatter;
	protected $emailService;

	public function __construct(UserNotificationRepositoryInterface $userNotificationRepository,
								UserRepositoryInterface $userRepository,
								UserNotificationSettingRepositoryInterface $userNotificationSettingRepository,
								EmailServiceInterface $emailService,
								NotificationFormatterInterface $notificationFormatter) 
	{

		$this->userNotificationRepository = $userNotificationRepository;
		$this->userNotificationSettingRepository = $userNotificationSettingRepository;
		$this->userRepository = $userRepository;
		$this->notificationFormatter = $notificationFormatter;
		$this->emailService = $emailService;
		
	}		

	public function notificationExists($userId, $typeId)
	{

		return $this->userNotificationRepository->notificationExists($userId, $typeId);

	}
	
    public function createNotification($userId, $typeId, $text, $url, $itemType = null, $itemId = null)
    {

        return $this->userNotificationRepository->create($userId, $typeId, $text, $url, $itemType, $itemId);

	}

	public function delete($userId, $typeId, $text, $url)
	{

		return $this->userNotificationRepository->delete($userId, $typeId, $text, $url);

	}
	
	public function markNotificationsAsRead($userId)
	{

		$this->userNotificationRepository->markAsReadByUserId($userId);

	}

	public function paginate($userId, $limit)
	{

		$notifications = $this->userNotificationRepository->paginate($userId, $limit);

		return $notifications->count() > 0 ? $this->notificationFormatter->prepareNotificationsForNotificationsPage($notifications) : [];

	}

	public function paginateAjax($userId, $limit)
	{

		$notifications = $this->userNotificationRepository->paginate($userId, $limit);

		return $this->notificationFormatter->prepareNotificationsForAjaxResponse($notifications);

	}	

	public function unsubscribeNewsletter($token)
	{

		if(!$token) return;

		$email = base64_decode(strtr($token, '._-', '+/='));
		$user = $this->userRepository->getByEmail($email);

		if(!$user) return;

		$this->userNotificationSettingRepository->update(
			$user->notificationSettings->id,
			['newsletters' => 0]
		);

	}

	public function getUnreadNotNotifiedByEmail()
	{

		return $this->userNotificationRepository->getUnreadNotNotifiedByEmail();

	}

	public function notifyUsersAboutUnreadNotifications()
	{

		$notifications = $this->getUnreadNotNotifiedByEmail();		
		$userIds = [];

		foreach($notifications as $notification)
		{
			
			if($notification->signals == 1)
			{

				if(filter_var($notification->email, FILTER_VALIDATE_EMAIL))
				{

					$this->emailService->sendNotificationAboutUnreadNotifications($notification->email, $notification->username, $notification->total);

				}

			}

			$userIds[] = $notification->user_id;

		}

		$this->userNotificationRepository->markAsNotifiedByEmail($userIds);

	}
	
}