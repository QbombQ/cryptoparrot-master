<?php 

namespace App\Model\Services\Common;

use App\Model\Contracts\Interfaces\Data\CompetitionParticipantRepositoryInterface;
use App\Model\Contracts\Interfaces\Data\HistoricalPortfolioValueRepositoryInterface;
use App\Model\Contracts\Interfaces\Data\PortfolioRepositoryInterface;
use App\Model\Contracts\Interfaces\Data\SignUpConfirmationRepositoryInterface;
use App\Model\Contracts\Interfaces\Data\TradeRepositoryInterface;
use App\Model\Contracts\Interfaces\Data\UserBalanceRepositoryInterface;
use App\Model\Contracts\Interfaces\Data\UserRepositoryInterface;
use App\Model\Contracts\Interfaces\Formatters\FrontSubsystem\UserFormatterInterface;
use App\Model\Contracts\Interfaces\Services\Common\FileServiceInterface;
use App\Model\Contracts\Interfaces\Services\Common\PortfolioServiceInterface;
use App\Model\Contracts\Interfaces\Services\Common\UserServiceInterface;
use App\Model\Contracts\Interfaces\Validators\Common\UserValidatorInterface;
use App\Model\Data\Models\Currency;
use Auth;
use Cache;
use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;

class UserService implements UserServiceInterface
{

	protected $userValidator;
	protected $userFormatter;
	protected $userRepository;
	protected $signUpConfirmationRepository;
	protected $fileService;
	protected $balanceRepository;
	protected $tradeRepository;
	protected $historicalPortfolioValueRepository;
	protected $competitionParticipantRepository;
	protected $portfolioRepository;

	public function __construct(UserValidatorInterface $userValidator,
								SignUpConfirmationRepositoryInterface $signUpConfirmationRepository,
								UserFormatterInterface $userFormatter,
								FileServiceInterface $fileService,
								UserBalanceRepositoryInterface $balanceRepository,
								TradeRepositoryInterface $tradeRepository,
								HistoricalPortfolioValueRepositoryInterface $historicalPortfolioValueRepository,
								CompetitionParticipantRepositoryInterface $competitionParticipantRepository,
								PortfolioRepositoryInterface $portfolioRepository,
								UserRepositoryInterface $userRepository) 
	{

		$this->userValidator = $userValidator;
		$this->userFormatter = $userFormatter;
		$this->userRepository = $userRepository;
		$this->signUpConfirmationRepository = $signUpConfirmationRepository;
		$this->fileService = $fileService;
		$this->balanceRepository = $balanceRepository;
		$this->tradeRepository = $tradeRepository;
		$this->historicalPortfolioValueRepository = $historicalPortfolioValueRepository;
		$this->competitionParticipantRepository = $competitionParticipantRepository;
		$this->portfolioRepository = $portfolioRepository;
		
	}	

	public function resetUser($userId)
	{

		if($this->competitionParticipantRepository->getUserCompetitions($userId, [1])->count() > 0)
		{

			return;

		}

		$user = $this->userRepository->get($userId);
		$this->portfolioRepository->update(
			$user->main_portfolio_id,
			[
				'portfolio_value_in_usd' => config('custom.starting_balance'),
				'start_portfolio_value_in_usd' => config('custom.starting_balance')
			]
		);

		$portfolios = $user->portfolios;
		$competitionParticipants = $user->competitionParticipants;

		foreach($portfolios as $portfolio)
		{

			$canBeClosed = true;

			if($portfolio->id !== $user->main_portfolio_id)
			{

				if($competitionParticipants->count() > 0)
				{

					foreach($competitionParticipants as $participant)
					{

						if($participant->portfolio_id == $portfolio->id)
						{

							$canBeClosed = false;

						}

					}

				}

			}else{

				$canBeClosed = false;

			}

			if($canBeClosed)
			{
 
				$portfolio->closed = 1;
				$portfolio->save();

				if($user->current_portfolio_id === $portfolio->id)
				{

					$user->current_portfolio_id = $user->main_portfolio_id;
					$user->save();

				}

			}

		}
		
        $this->balanceRepository->reset($userId, $user->main_portfolio_id);
        $this->balanceRepository->addAmount(
			$userId,
			Currency::orderBy('created_at', 'asc')->first()->id,
			$user->main_portfolio_id,
			config('custom.starting_balance')
		);
		$this->tradeRepository->archiveUserTrades($userId, $user->main_portfolio_id);
		$this->historicalPortfolioValueRepository->archive($userId);

	}

	public function create($args)
	{
		
		if(!$this->userValidator->validateCreation($args)) 
		{
			
			return $this->userValidator->getErrors();

		}


		$formattedArgs = $this->userFormatter->prepareUserDataForRegistration($args);

		$userId = $this->userRepository->createUser($formattedArgs);

		$this->loginWithId($userId);

		return $userId;
		
	}

	public function confirm($token)
	{

		$confirmation = $this->signUpConfirmationRepository->get($token);

		if(!$confirmation || !$this->userRepository->get($confirmation->user_id)) 
		{
			
			return false; // token or user does not exist

		}

		$this->signUpConfirmationRepository->delete($token);

		return $this->userRepository->confirm($confirmation->user_id);

	}

	public function reserve($userId, $args)
	{
		
		if(!$this->userValidator->validateReservation($userId, $args)) 
		{

			return $this->userValidator->getErrors();

		}

		return $this->userRepository->updateUser($userId, $this->userFormatter->prepareUserDataForReservation($args));
		
	}	

	public function loginWithId($userId)
	{

		try {

			Auth::loginUsingId($userId, true);

		}catch(\Exception $e) {

			$user = $this->getById($userId);

			try {

				Auth::attempt(['key', $user->key, 'method' => $user->method]);

			}catch(\Exception $ex) {}
				
		}

	}
	
	public function getBySocialId($key)
	{

		return $this->userRepository->getByKey($key);

	}
	
	public function getById($id)
	{

		return $this->userRepository->get($id);

	}	
	
	public function getByHandle($handle)
	{

		return $this->userRepository->getByHandle($handle);

	}	

	public function getByEmail($email)
	{

		return $this->userRepository->getByEmail($email);

	}

	public function all()
	{

		return $this->userRepository->all();

	}			

	public function getUsersForSearch()
	{

		if(Cache::has('users-for-search'))
		{

			return Cache::get('users-for-search');

		}

		$users = $this->userRepository->all();
		Cache::put('users-for-search', $users, Carbon::now()->addDays(7));

		return $users;

	}

	public function canGetTraderBadge($userId, $changes)
	{

		$user =	$this->getById($userId);

		if(!$user) 
		{
			
			return false;

		}

		$finishedOrLiquidatedTrades = $this->tradeRepository->getFinishedOrLiquidatedTrades($user->id);

		if($finishedOrLiquidatedTrades < config('custom.trader_badge_min_trades')) 
		{
			
			return false;

		}

		$profitLoss = $user->mainPortfolio->portfolio_value_in_usd - $user->mainPortfolio->start_portfolio_value_in_usd;

		if($profitLoss < config('custom.trader_badge_min_profit')) 
		{
			
			return false;

		}

		$tradeCountForAvgCalculation = $this->tradeRepository->getTradesForAverageProfitLossCount($user->id);
		$avgProfit = $changes['lifetime'] / $tradeCountForAvgCalculation;
		
		return $avgProfit > config('custom.trader_badge_min_avg_profit');

	}

	public function updateCurrentPortfolio($args)
	{

		if(!$this->userValidator->validateCurrentPortfolioChange($args)) 
		{
			
			return $this->userValidator->getErrors();

		}

		$portfolio = $this->portfolioRepository->get($args['portfolio_id']);

		if(!Gate::allows('use-portfolio', $portfolio)) 
		{
			
			return $this->userValidator->getErrors();

		}
		
		$this->userRepository->updateUser(
			Auth::id(),
			$this->userFormatter->prepareDataForCurrentPortfolioUpdate($args)
		);

		return true;

	}

	public function getUsersMentionData()
	{

		$users = $this->getUsersForSearch();

		return $this->userFormatter->prepareUsersForMention($users);

	}

	public function searchForUsers($keyword)
	{

		$users = $this->userRepository->searchByKeyword($keyword);

		return $this->userFormatter->prepareUsersForSearch($users);

	}

}