<?php

namespace App\Model\Formatters\Common;

use App\Model\Contracts\Interfaces\Formatters\Common\NotificationFormatterInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Pagination;
use Time;

class NotificationFormatter implements NotificationFormatterInterface
{

    public function prepareNotificationsForBubbleDisplay($notifications)
    {

        $results = [];

        if($notifications)
        {

            foreach($notifications as $notification)
            {

                $results[] = [
                    'title' => $notification->type->title,
                    'icon' => $notification->type->icon,
                    'text' => $notification->text,
                    'url' => $notification->url,
                    'status' => $notification->status,
                    'date' => Time::formatDateForHumans($notification->created_at)
                ];

            }
            
        }        

        return $results;

    }

    public function prepareNotificationsForNotificationsPage($notifications)
    {

        if($notifications instanceof LengthAwarePaginator)
        {

            $results['pagination'] = Pagination::defaultPagination($notifications);
            
        }

        $results['data'] = $this->prepareNotificationsForBubbleDisplay($notifications);

        return $results;

    }

    public function prepareNotificationsForAjaxResponse($notifications)
    {

        $result['success'] = $notifications->count() > 0 ? true : false;
        $data['notifications'] = $this->prepareNotificationsForBubbleDisplay($notifications);
        $result['notifications'] =  view('pages/TradeSubsystem/common/notifications', $data)->render();

        return $result;

    }

}