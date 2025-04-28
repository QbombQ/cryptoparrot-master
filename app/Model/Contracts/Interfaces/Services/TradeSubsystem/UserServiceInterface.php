<?php

namespace App\Model\Contracts\Interfaces\Services\TradeSubsystem;

use Illuminate\Http\Request;

interface UserServiceInterface
{

    public function getUserProfile($handle);

    public function getUserSettings($id);

    public function updateProfile($request);

    public function updateSocialLinks($request);

    public function updateNotifications($request);

    public function updatePassword($request);

    public function updateAvatar($request);

    public function updateCover($request);

    public function uploadTempCover($request);

    public function topTraders($limit, $timePeriod);

    public function latestTraders($limit);
    
    public function topTradersAjax($limit, $timePeriod);

    public function getUserTrades($page, $handle, $timestamp);

    public function updateSavedPair($pairId);

    public function deleteSavedPair();

    public function follow($followingId, $followerId);

    public function unfollow($followingId, $followerId);

    public function resendConfirmationLink();

}