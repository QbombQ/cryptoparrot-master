<?php

namespace App\Model\Data\Repositories;

use App\Model\Contracts\Interfaces\Data\PortfolioRepositoryInterface;
use App\Model\Data\Models\Portfolio;

class PortfolioRepository implements PortfolioRepositoryInterface
{

    public function create($args)
    {

        $portfolio = new Portfolio;
        $portfolio->fill($args);
        $portfolio->save();
        
        return $portfolio->id;

    }

    public function getUserPortfolios($userId)
    {

        return Portfolio::where('user_id', $userId)
                        ->where('closed', 0)
                        ->orderBy('created_at', 'asc')->get();

    }

    public function update($portfolioId, $args)
    {

        $portfolio = Portfolio::find($portfolioId);
        
        if($portfolio)
        {

            $portfolio->update($args);

        }

    }

    public function get($portfolioId)
    {

        return Portfolio::find($portfolioId);

    }

}