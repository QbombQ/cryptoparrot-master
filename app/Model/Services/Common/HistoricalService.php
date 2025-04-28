<?php

namespace App\Model\Services\Common;

use App\Model\Contracts\Interfaces\Services\Common\HistoricalServiceInterface;
use App\Model\Contracts\Interfaces\Services\Common\UserServiceInterface;
use App\Model\Contracts\Interfaces\Formatters\Common\HistoricalFormatterInterface;
use App\Model\Contracts\Interfaces\Data\HistoricalPortfolioValueRepositoryInterface;
use Carbon\Carbon;
use App\Model\Data\Models\HistoricalPortfolioValue;
use Log;

class HistoricalService implements HistoricalServiceInterface
{

    protected $userService;
    protected $historicalPortfolioValueRepository;
    protected $historicalFormatter;

    public function __construct(
        UserServiceInterface $userService,
        HistoricalFormatterInterface $historicalFormatter,
        HistoricalPortfolioValueRepositoryInterface $historicalPortfolioValueRepository
    )
    {

        $this->userService = $userService;
        $this->historicalPortfolioValueRepository = $historicalPortfolioValueRepository;
        $this->historicalFormatter = $historicalFormatter;

    }

    public function archiveHistoricalPortfolioValues($userId)
    {

        $this->historicalPortfolioValueRepository->archive($userId);

    }

    public function getUserPortfolioHistoricalData($userId)
    {

        $values = $this->historicalPortfolioValueRepository->getUserHistoricalData($userId);

        return $this->historicalFormatter->prepareUserPortfolioHistoryForChartDisplay($values);

    }

    public function updateHistoricalPortfolioValues()
    {

        $date = Carbon::now()->toDateString();
        $users = $this->userService->all();

        \Log::error('got all users:'. count($users)); 
 
        foreach($users as $key => $user)
        {

            try {

                if(!$this->historicalPortfolioValueRepository->exists($user->id, $date))
                {

                    $sum = 0;

                    foreach($user->mainPortfolio->balances as $balance)
                    {

                        $currency = $balance->currency;
                        $usdValue = $currency->average_usd_value * $balance->amount;

                        if($usdValue < 0) $usdValue = 0;

                        $sum += $usdValue;

                    } 

                    \Log::error('Count:'. $key .' UserID:'.$user->id .' SUM:'.$sum); 

                    $userEarnPlayDollars = $user->userEarnPlayDollars;
                    $userRewards = $user->userRewards;
                    $userExchanges = $user->exchanges;
            
                    if(!$userRewards->isEmpty())
                    {
            
                        foreach($userRewards as $reward)
                        {
            
                            $sum += $reward->price_earned;
            
                        }
            
                    }

                    if(!$userRewards->isEmpty())
                    {
            
                        foreach($userExchanges as $exchange)
                        {
            
                            $sum += $exchange->amount;
            
                        }
            
                    }
            
                    if(!$userEarnPlayDollars->isEmpty())
                    {
            
                        foreach($userEarnPlayDollars as $earnedDollar)
                        {
            
                            $sum -= $earnedDollar->price_paid;
            
                        }
            
                    }

                    $this->historicalPortfolioValueRepository->create($this->historicalFormatter->prepareDataForCreation($user->id, $sum));      
                
                }else{

                     \Log::error($user->id.' - exist'); 

                }

            }catch(\Exception $e)
            {
 
                \Log::error('historical error');
                \Log::error($e);

            }

        }          

    }

    public function getUserPortfolioValueChanges($user)
    {

        $values = $this->historicalPortfolioValueRepository->getUserHistoricalData($user->id);        
        return $this->historicalFormatter->prepareUserPortfolioValueChangesForDisplay($user, $values);

    }

    public function getUserWeekAnalysis($user)
    {

        $portfolioValues = $this->historicalPortfolioValueRepository->getUserWeekAnalysis($user->id);

        return $this->historicalFormatter->prepareUserWeekAnalysis($portfolioValues, $user);

    }

}