<?php

namespace App\Model\Data\Repositories;

use App\Model\Contracts\Interfaces\Data\UserSocialMediaAccountRepositoryInterface;
use App\Model\Data\Models\UserSocialMediaAccount;

class UserSocialMediaAccountRepository implements UserSocialMediaAccountRepositoryInterface
{

	/**
	 * Creates new UserSocialMediaAccount row
	 */
	public function create($userId, $network, $url)
	{

		$account = new UserSocialMediaAccount;
		$account->user_id = $userId;
		$account->social_network = $network;
		$account->url = $url;
		$account->save();
		
		return $account->id;
		
	}

	/**
	 * Deletes all user social media accounts
	 */    
    public function deleteByUserId($userId)
    {

        UserSocialMediaAccount::where('user_id', $userId)->delete();

    }

}