<?php

namespace App\Model\Data\Repositories;

use App\Model\Contracts\Interfaces\Data\UserNotificationRepositoryInterface;
use App\Model\Data\Models\UserNotification;
use Carbon\Carbon;
use DB;

class UserNotificationRepository implements UserNotificationRepositoryInterface
{

	public function notificationExists($userId, $typeId)
	{
		
        $todayMidnight = Carbon::createFromTimestamp(strtotime('today midnight'))->toDateTimeString();
        $now = Carbon::createFromTimestamp(time())->toDateTimeString();

		return UserNotification::where([
			'user_id' => $userId,
			'type_id' => $typeId
		])->whereBetween('created_at', [$todayMidnight, $now])->exists();

	}

	/**
	 * Creates new UserNotification row
	 */
	public function create($userId, $typeId, $text, $url, $itemType = null, $itemId = null)
	{

		$userNotification = new UserNotification;
		$userNotification->user_id = $userId;
		$userNotification->type_id = $typeId;
		$userNotification->text = $text;
		$userNotification->url = $url;
		$userNotification->status = 'unread';
		$userNotification->item_id = $itemId;
		$userNotification->item_type = $itemType;
		$userNotification->save();
		
		return $userNotification;

	}

	/**
	 * Deletes all user social notifications
	 */    
    public function deleteByUserId($userId)
    {

        UserNotification::where('user_id', $userId)->delete();

	}
	
	/**
	 * Mark as read
	 */    
    public function markAsReadByUserId($userId)
    {

        UserNotification::where('user_id', $userId)->update(['status' => 'read']);

	}	
	
	public function paginate($userId, $limit)
	{

		return UserNotification::where('user_id', $userId)->orderBy('created_at', 'desc')->paginate($limit)->onEachSide(0);

	}

	public function delete($userId, $typeId, $text, $url)
	{ 

		UserNotification::where([
			'user_id' => $userId,
			'type_id' => $typeId,
			'text' => $text,
			'url' => $url
		])->delete();

	}

	public function getUnreadNotNotifiedByEmail()
	{

		return DB::table('user_notifications')
				->join('users', 'users.id', '=', 'user_notifications.user_id')
				->join('user_notification_settings', 'user_notification_settings.user_id', '=', 'users.id')
				->select('users.email', 'user_notifications.user_id', 'user_notification_settings.signals', 'users.username', DB::raw('count(*) as total'))
				->groupBy('user_notifications.user_id', 'users.email', 'user_notification_settings.signals', 'users.username', 'user_notifications.status', 'user_notifications.notified_by_email')
				->having('user_notifications.status', '=', 'unread')
				->having('user_notifications.notified_by_email', '=', 0)
				->having('user_notification_settings.signals', '=', 1)
				->get();

	}

	public function markAsNotifiedByEmail($userIds)
	{

		UserNotification::whereIn('user_id', $userIds)->update([
			'notified_by_email' => 1
		]);

	}

}