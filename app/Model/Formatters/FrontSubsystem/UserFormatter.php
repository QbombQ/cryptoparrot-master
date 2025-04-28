<?php 

namespace App\Model\Formatters\FrontSubsystem;

use App\Model\Contracts\Interfaces\Formatters\FrontSubsystem\UserFormatterInterface;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Avatar;
use Balance;
use Media;

class UserFormatter implements UserFormatterInterface
{

    public function prepareUserDataForRegistration($data)
    {

        $data['status'] = isset($data['password']) || $data['method'] == 'reddit' || $data['method'] == 'steemit' ? 'unconfirmed' : 'confirmed';
        $data['username'] = isset($data['username']) ? $data['username'] : null;
        $data['email'] = isset($data['email']) ? strtolower($data['email']) : null;
        $data['key'] = isset($data['key']) ? $data['key'] : null;
        $data['type'] = isset($data['type']) ? $data['type'] : 'trader';
        $data['password'] = isset($data['password']) ? Hash::make($data['password']) : null;
        $data['avatar'] = null;
        $data['ref_code'] = \Cookie::get('ref_code');

        return $data;

    }

    public function prepareUserDataForRegistrationSocialNetwork($user, $network)
    {

        if(!$user) return [];

        $data = [
            'key' => $user->getId(),
            'method' => $network,
            'ref_code' => \Cookie::get('ref_code')
        ];

        if($network !== 'reddit' && $network !== 'steemit')
        {

            $data['email'] = $user->getEmail();

            if(!$data['email'])
            {

                $data['email'] = $user->getId() . '@cryptoparrot.com';

            }

        } else {

            $data['email'] = $user->getId() . '@cryptoparrot.com';

        }
       
        return $data;

    }
  
    public function subsystemUrlByUserType($userType)
    {

        return 'app';

    }    
   
    public function prepareUserDataForReservation($data)
    {

        $result = [];

        if(isset($data['username']))
        { 

            $result['username'] = $data['username'];
            $result['handle'] = $this->slugify($data['username']);

        }

        if(isset($data['email'])) 
        {
            
            $result['email'] = $data['email'];

        }

        return $result;

    }

    private function slugify($username) 
    {

        return preg_replace("/[^A-Za-z0-9]/","",$username);
        
    }    

    public function prepareDataForCurrentPortfolioUpdate($args)
    {

        return [
            'current_portfolio_id' => $args['portfolio_id']
        ];

    }

    public function prepareUsersForMention($users)
    {

        $mentionData = [];

		if($users && $users->count() > 0) 
		{

			foreach($users as $user) 
			{

				$mentionData[] = [
					'id' => $user->id,
					'name' => $user->username,
					'type' => 'contact',
					'avatar' => Media::getUserAvatar($user, true)
				];

			}

		}

		return $mentionData;

    }

    public function prepareUsersForSearch($users)
    {

		$searchData = [];

		if($users && $users->count() > 0) 
		{

			foreach($users as $user) 
			{

				$totalBalance = Balance::portfolioTotalValue($user->mainPortfolio);
				$totalBalanceClass = Balance::portfolioTotalBalanceClass($user->mainPortfolio);

				$searchData[] = [
					'label' => $user->username,
					'category' => 'Users',
					'totalBalance' => $totalBalance,
					'totalBalanceClass' => $totalBalanceClass,
					'href' => '/'.$user->handle,
					'image' => Media::getUserAvatar($user, true)
				];

			}

        }
        
        return $searchData;

    }
    
}