<?php

namespace App\Model\Services\Common;

use App\Model\Contracts\Interfaces\Services\Common\PortfolioServiceInterface;
use App\Model\Contracts\Interfaces\Data\UserBalanceRepositoryInterface;
use App\Model\Contracts\Interfaces\Validators\Common\PortfolioValidatorInterface;
use App\Model\Contracts\Interfaces\Formatters\Common\PortfolioFormatterInterface;
use App\Model\Contracts\Interfaces\Data\PortfolioRepositoryInterface;
use Illuminate\Support\Facades\Gate;
use Auth;
use Currency;

class PortfolioService implements PortfolioServiceInterface
{

    private $portfolioValidator;
    private $portfolioRepository;
    private $portfolioFormatter;
    private $balanceRepository;

    public function __construct(

        PortfolioValidatorInterface $portfolioValidator,
        PortfolioRepositoryInterface $portfolioRepository,
        PortfolioFormatterInterface $portfolioFormatter,
        UserBalanceRepositoryInterface $balanceRepository
        
    )
    {

        $this->portfolioValidator = $portfolioValidator;
        $this->portfolioRepository = $portfolioRepository;
        $this->portfolioFormatter = $portfolioFormatter;
        $this->balanceRepository = $balanceRepository;

    }

    public function create($args)
    {

        if(!$this->portfolioValidator->validateCreation($args))
        {

            return $this->portfolioFormatter->prepareCreationFailResponse($this->portfolioValidator->getErrors()->errors()->first());

        }

        $portfolioId = $this->portfolioRepository->create(
            $this->portfolioFormatter->prepareDataForCreation($args)
        );

        if(!$portfolioId) 
        {
            
            return;

        }

        $portfolio = $this->portfolioRepository->get($portfolioId);
        $dollarCurrency = Currency::dollar();
        $this->balanceRepository->createIfDoesNotExist($args['user_id'], $dollarCurrency->id, $portfolioId);

        foreach($portfolio->balances as $balance)
        {

            if($balance->currency_id == $dollarCurrency->id)
            {

                $balance->amount = config('custom.starting_balance');
                $balance->usd_value = config('custom.starting_balance');
                $balance->save();

            }

        }

        if(Auth::check())
        {

            Auth::user()->current_portfolio_id = $portfolioId;
            Auth::user()->save();

        }

        return $this->portfolioFormatter->prepareCreationSuccessResponse('Portfolio created', $portfolioId);

    }

    public function close($portfolioId, $user)
    {

        $portfolio = $this->get($portfolioId);

        if(!$portfolio)
        {

            return 'Portfolio does not exist';

        }

        if($user->main_portfolio_id == $portfolioId)
        {

            return 'You cannot close your main portfolio';

        }

        if(!Gate::allows('edit-portfolio', $portfolio))
        {

            return 'You cannot edit this portfolio';

        }

        $this->update($portfolioId, [
            'closed' => 1
        ]);

        if($user->current_portfolio_id == $portfolioId)
        {

            $user->current_portfolio_id = $user->main_portfolio_id;
            $user->save();

        }

        return true;

    }

    public function getForSelect($userId)
    {

        $portfolios = $this->portfolioRepository->getUserPortfolios($userId);
        
        return $this->portfolioFormatter->preparePortfoliosForSelect($portfolios);

    }

    public function update($portfolioId, $args)
    {

        $this->portfolioRepository->update($portfolioId, $args);

    }

    public function get($portfolioId)
    {

        return $this->portfolioRepository->get($portfolioId);

    }

}