<?php

namespace App\Model\Data\Repositories;

use App\Model\Contracts\Interfaces\Data\UserRepositoryInterface;
use App\Model\Data\Models\User;
use Carbon\Carbon;
use Auth;

class UserRepository implements UserRepositoryInterface
{

	public function getUserRegistrationStatsLast($months)
	{

		$userPerMonth= array();

		for ($i=$months-1; $i>=0; $i--)
		{
		
			$dateTo = $i == 0 ? date('Y-m-d h:i:s', strtotime('-1 minute')) : date('Y-m-d h:i:s', strtotime('first day of -'.($i-1).' month'));
			$dateFrom = date('Y-m-d h:i:s', strtotime('first day of -'.$i.' month'));

			$userPerMonth['confirmed'][] = User::whereBetween('created_at', [$dateFrom, $dateTo])->where('status', 'confirmed')->count();
			$userPerMonth['unconfirmed'][] = User::whereBetween('created_at', [$dateFrom, $dateTo])->where('status', 'unconfirmed')->count();
		
		}

		return $userPerMonth;

	}

	/**
	 * Creates new user row
	 * @param mixed args
	 */
	public function createUser($args)
	{

		$user = new User;
		$user->username = array_key_exists('username', $args) ? $args['username'] : null;
		$user->email = array_key_exists('email', $args) ? $args['email'] : null;
		$user->method = $args['method'];
		$user->password = $args['password']; 
		$user->status = $args['status']; 
		$user->key = $args['key']; 
		$user->type = $args['type'];
		$user->ref_code = $args['ref_code']; 
		$user->save();

		return $user->id;
		
	}

	public function getWhereActiveAtIsMoreThan($date)
	{

		return User::where('active_at', '>', $date)->orderBy('active_at', 'desc')->get();

	}

	public function getCreatedInLastHour()
	{

		return User::where('created_at', '>', Carbon::now()->subMinutes(61)->toDateTimeString())->get();

	}

	/**
	 * Creates new user row
	 * @param mixed args
	 */
	public function updateUser($id, $args)
	{

		$user = User::find($id);

		if($user)
		{

			$user->fill($args);
			$user->save();
			return $user;

		}

		return false;
		
	}	

	public function delete($id)
	{

		return User::findOrFail($id)->delete();

	}

	public function ban($id)
	{

		return User::findOrFail($id)->update([
			'status' => 'banned'
		]);

	}

	public function unban($id)
	{

		return User::findOrFail($id)->update([
			'status' => 'confirmed'
		]);

	}

	/**
	 * Gets user by ID
	 * @param mixed args
	 */
	public function get($id)
	{

		$user = User::find($id);
		return $user ? $user : null;
		
	}	

	/**
	 * Gets user by social media key
	 * @param String args
	 */	
	public function getByKey($key)
	{

		$user = User::where('key', $key)->first();
		return $user ? $user : null;		

	}

	/**
	 * Gets user by ref code
	 * @param String args
	 */	
	public function getByRefCode($code)
	{

		return User::where('ref_code', $code)->get();		

	}	

	/**
	 * Gets user by handle
	 * @param String handle
	 */	
	public function getByHandle($handle)
	{

		return User::where('handle', 'ilike', $handle)->firstOrFail();		

	}	

	/**
	 * Gets user by email
	 * @param String email
	 */	
	public function getByEmail($email)
	{

		$user = User::where('email', $email)->first();
		return $user ? $user : null;		

	}	

	public function getByEmailCaseInsensitive($email)
	{

		return User::where('email', 'ilike', $email)->firstOrFail();		

	}	

    public function paginate($limit)
    {

        $userObject = new User();
		$query = $userObject->newQuery();  
		      
		if(isset($_GET['keyword']))
		{

			$keyword = $_GET['keyword'];

            if($keyword !== '')
			{

				$query->where('username', 'ilike', '%'.$keyword.'%')
					  ->orWhere('handle', 'ilike', '%'.$keyword.'%')
					  ->orWhere('email', 'ilike', '%'.$keyword.'%');

			}
			
			$limit *= 1000;
			
		}
		
    	return $query->orderBy('created_at', 'desc')->paginate($limit);		

    }	

	/**
	 * Confirms given user
	 * @param mixed args
	 */
	public function confirm($id)
	{

		$user = User::find($id);
		$user->status = 'confirmed';
		$user->save();

		return true;
		
	}	
	
	/**
	 * Top users
	 * @param Integer $offset
	 * @param Integer $limit
	 * @param mixed args
	 */	
	public function topUsers($limit, $criteria)
	{

		$user = new User;
		$query = $user->newQuery();

		switch($criteria) {
			case 'lifetime':
				$query->join('portfolios', 'users.main_portfolio_id', '=', 'portfolios.id');
				$query->select(
					'users.*', 
					'portfolios.portfolio_value_in_usd', 
					'portfolios.start_portfolio_value_in_usd', 
					\DB::raw('(SELECT (portfolios.portfolio_value_in_usd - users.earn_play_dollars_reward_diff) / portfolios.start_portfolio_value_in_usd * 100 - 100) as difference'),
					\DB::raw('(SELECT CASE WHEN SUM(exchanges.amount) > 0 THEN SUM(exchanges.amount) ELSE 0 END FROM exchanges WHERE user_id = users.id) as claimed')
				); 
				$query->orderBy('claimed', 'desc');
				return $query->paginate($limit);
			default:
				$query
					->join('historical_portfolio_values', 'users.id', '=', 'historical_portfolio_values.user_id')
					->join('portfolios', 'users.main_portfolio_id', '=', 'portfolios.id')
					->whereHas('trades', function($q) use($criteria) {
						return $q->where('created_at', '>=', $criteria); 
					})
					->select(
						'users.*', 
						'historical_portfolio_values.archived', 
						'historical_portfolio_values.portfolio_usd_value as portfolio_usd_value', 
						\DB::raw('(SELECT (portfolios.portfolio_value_in_usd - users.earn_play_dollars_reward_diff) / historical_portfolio_values.portfolio_usd_value * 100 - 100) as difference'),
						\DB::raw('(SELECT CASE WHEN SUM(exchanges.amount) > 0 THEN SUM(exchanges.amount) ELSE 0 END FROM exchanges WHERE user_id = users.id) as claimed')
					)
					->where('date', $criteria)
					->where('portfolio_usd_value', '!=', 0)
					->where('historical_portfolio_values.archived', '!=', 1)
					->orderBy('claimed', 'desc');
				return $query->paginate($limit); 
		} 

	}

	public function latestUsers($limit, $id = null)
	{

		if($id)
		{

			return User::where('id', '!=', $id)->where('username', '!=', null)->where('handle', '!=', null)->where('status', 'confirmed')->orderBy('created_at', 'desc')->paginate($limit);
		
		}
		
		return User::orderBy('created_at', 'desc')->paginate($limit);

	}

	public function all()
	{

		return User::all();

	}	


	public function getUsersForCSV()
	{

		return User::all(['username', 'email', 'status'])->toArray();

	}	  

	public function count()
	{

		return User::count();

	}	

	public function getVerifiedUsersCount()
	{

		return User::where('status', 'confirmed')->count();

	}

	public function getWithAtLeastTrade()
	{

		return User::whereHas('trades')->count();

	}

	public function getIncompleteRegistrationCount()
	{

		return User::where('username', null)->count();

	}

	public function getCodeCount($code)
	{

		return User::where('ref_code', $code)->count();

	}

	public function getUsersWithBadges($badges)
	{

		return  User::whereHas('badges', function ($query) use ($badges) {
			$query->whereIn('badges.id', $badges);
		})->get();		

	}

	public function getUsersThatParticipateIn($competitions)
	{

		return  User::whereHas('competitions', function ($query) use ($competitions) {
			$query->whereIn('competitions.id', $competitions);
		})->get();			

	}

	public function getByIds($ids)
	{

		return User::whereIn('id', $ids)->get();

	}

	public function getUnverifiedUsers()
	{

		return User::where('status', 'unconfirmed')->whereNotNull('email')->get();

	}

	public function searchByKeyword($keyword)
	{

		return User::where('username', 'ilike', '%'.$keyword.'%')->get();		

	}

	public function getUsersToFollow($followedUsers)
	{

		$user = new User;
		$query = $user->newQuery();
		return $query->join('user_notification_settings', 'users.id', '=', 'user_notification_settings.user_id')
		    ->whereHas('trades', function($q) {
				return $q->where('created_at', '<=', Carbon::now()->subDays(30)); 
			})
			->select('users.*', 'user_notification_settings.new_follows')
			->whereNotIn('users.id', $followedUsers)
			->where('user_notification_settings.new_follows', 1)
			->inRandomOrder()->get();

	}

}