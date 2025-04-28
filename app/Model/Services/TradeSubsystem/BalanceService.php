<?php 

namespace App\Model\Services\TradeSubsystem;

use App\Model\Contracts\Interfaces\Data\UserBalanceRepositoryInterface;
use App\Model\Contracts\Interfaces\Services\TradeSubsystem\BalanceServiceInterface;
use App\Model\Contracts\Interfaces\Services\Common\UserServiceInterface;
use App\Model\Contracts\Interfaces\Services\Common\PortfolioServiceInterface;
use Currency;

class BalanceService implements BalanceServiceInterface
{	

    protected $balanceRepository;
    protected $userService;
    protected $portfolioService;

    public function __construct(UserBalanceRepositoryInterface $balanceRepository,
                                PortfolioServiceInterface $portfolioService,
                                UserServiceInterface $userService) 
	{

        $this->balanceRepository = $balanceRepository;
        $this->userService = $userService;
        $this->portfolioService = $portfolioService;
        
    }	    

    public function resetBalances($userId)
    {

        $this->balanceRepository->reset($userId);
        $this->balanceRepository->addAmount($userId, Currency::dollar(), config('custom.starting_balance'));

    }

    public function reserve($userId, $currencyId, $portfolioId, $amount)
    {

        $this->balanceRepository->reserve($userId, $currencyId, $portfolioId, $amount);

    }

    public function release($userId, $currencyId, $portfolioId, $amount)
    {

        $this->balanceRepository->release($userId, $currencyId, $portfolioId, $amount);

    }

    public function addAmount($userId, $currencyId, $portfolioId, $amount)
    {

        $this->balanceRepository->addAmount($userId, $currencyId, $portfolioId, $amount);

    }
   
    public function createIfDoesNotExist($userId, $currencyId, $portfolioId)
    {

        if($portfolioId && $userId)
        {

            $this->balanceRepository->createIfDoesNotExist($userId, $currencyId, $portfolioId);

        }

    }
 
    public function updateUsdValues($handle)
    {

        $user = $this->userService->getByHandle($handle);
        $this->sumBalancesValuesAndUpdate($user);      

    }
    
    public function updateAllUsdValues()
    {

        $users = $this->userService->all();

        if($users->count() > 0)
        {
            foreach($users as $user)
            {

                $this->sumBalancesValuesAndUpdate($user);

            }  

        }

    }    

    private function sumBalancesValuesAndUpdate($user)
    {

        $portfolios = $user->portfolios;

        if(!$portfolios->isEmpty())
        {

            foreach($portfolios as $portfolio)
            {

                $sum = 0;

                foreach($portfolio->balances as $balance)
                {

                    $currency = $balance->currency;
                    $data = [
                        'usd_value' => $currency->usd_value * $balance->amount
                    ];

                    if($data['usd_value'] < 0) $data['usd_value'] = 0;
                    
                    $this->balanceRepository->update($balance->id, $data);
                    $sum += $data['usd_value'];

                }

                $portfolioData = [
                    'portfolio_value_in_usd' => floor($sum)
                ];

                $this->portfolioService->update($portfolio->id, $portfolioData);

            }

        }          

    }

}