<?php

namespace App\Model\Contracts\Interfaces\Data;

interface PortfolioRepositoryInterface
{

    public function create($args);

    public function getUserPortfolios($userId);

    public function update($portfolioId, $args);

    public function get($portfolioId);

}