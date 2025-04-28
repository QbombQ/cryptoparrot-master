<?php

namespace App\Model\Contracts\Interfaces\Services\Common;

interface PortfolioServiceInterface
{

    public function create($args);

    public function getForSelect($userId);

    public function update($portfolioId, $args);

    public function get($portfolioId);

    public function close($portfolioId, $user);

}