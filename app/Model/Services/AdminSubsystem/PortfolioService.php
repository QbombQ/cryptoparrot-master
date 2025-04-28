<?php

namespace App\Model\Services\AdminSubsystem;

use App\Model\Contracts\Interfaces\Services\AdminSubsystem\PortfolioServiceInterface;
use App\Model\Contracts\Interfaces\Services\AdminSubsystem\UserServiceInterface;
use App\Model\Contracts\Interfaces\Services\AdminSubsystem\UserBalanceServiceInterface;
use App\Model\Contracts\Interfaces\Data\PortfolioRepositoryInterface;
use App\Model\Data\Models\Portfolio;

class PortfolioService implements PortfolioServiceInterface
{

    private $userService;
    private $userBalanceService;
    private $portfolioRepository;

    private $portfolioId;

    public function __construct(
        UserServiceInterface $userService,
        PortfolioRepositoryInterface $portfolioRepository,
        UserBalanceServiceInterface $userBalanceService
    )
    {

        $this->userService = $userService;
        $this->userBalanceService = $userBalanceService;
        $this->portfolioRepository = $portfolioRepository;

    }

    public function createForAll()
    {

        $users = $this->userService->allNoFormat();

        foreach($users as $user)
        {

            if($user->main_portfolio_id !== null)
            {

                continue;

            }

            $mainPortfolio = Portfolio::where('user_id', $user->id)->where('title', 'Main')->first();


            if($mainPortfolio)
            {
                
                $this->userService->updateMainPortfolio($user->id, $mainPortfolio->id);
                $this->userService->updateCurrentPortfolio($user->id, $mainPortfolio->id);
                $this->updateUserBalancesPortfolios($user, $mainPortfolio->id);
                $this->updateUserTradesPortfolios($user, $mainPortfolio->id);
                
            }else{

                $portfolioId = $this->createPortfolio($user);

                if(!$portfolioId)
                {

                    continue;

                }
    
                $this->userService->updateMainPortfolio($user->id, $portfolioId);
                $this->userService->updateCurrentPortfolio($user->id, $portfolioId);
                $this->updateUserBalancesPortfolios($user, $portfolioId);
                $this->updateUserTradesPortfolios($user, $portfolioId);

            }
            
        }

    }

    private function createPortfolio($user)
    {

        $response = $this->portfolioRepository->create([
            'user_id' => $user->id,
            'title' => 'Main',
            'start_portfolio_value_in_usd' => config('custom.starting_balance'),
            'portfolio_value_in_usd' => config('custom.starting_balance')
        ]);

        if(!$response) 
        {
        
            print_r('<pre>');
            print_r($user->id . ' portfolio creation failed');
            print_r('</pre>');
            return false;

        }

        return $response;

    }

    private function updateUserBalancesPortfolios($user, $portfolioId)
    {

        $userBalances = $user->balances;

        if($userBalances->count() > 0)
        {

            foreach($userBalances as $balance)
            {

                $balance->portfolio_id = $portfolioId;
                $balance->save();

            }

        }

    }

    private function updateUserTradesPortfolios($user, $portfolioId)
    {

        $userTrades = $user->trades;

        if($userTrades->count() > 0)
        {

            foreach($userTrades as $trade)
            {

                $trade->portfolio_id = $portfolioId;
                $trade->save();

            }

        }

    }

}