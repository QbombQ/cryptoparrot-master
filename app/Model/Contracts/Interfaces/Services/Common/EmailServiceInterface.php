<?php

namespace App\Model\Contracts\Interfaces\Services\Common;

interface EmailServiceInterface
{

    public function sendUserConfirmationEmail($email, $token);

    public function sendPasswordResetConfirmationEmail($email, $token, $username);

    public function sendEmailToAdministrator($request);

    public function sendNotificationAboutCompletedTrade($email);

    public function sendNotificationAboutUnreadNotifications($email, $username, $total);

    public function sendNotificationAboutNewBadge($email, $badge, $handle, $username);

    public function sendNotificationAboutNewFollow($following, $follower);

    public function sendNotificationAboutNewTradeComment($commentAuthor, $tradeAuthor, $tradeId);

    public function sendEmailToAdministratorAboutEvent($type, $data);

} 