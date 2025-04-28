<?php

namespace App\Model\Contracts\Interfaces\Formatters\Common;

interface PortfolioFormatterInterface
{

    public function prepareCreationFailResponse($errorMessage);

    public function prepareCreationSuccessResponse($message, $id);

    public function preparePortfoliosForSelect($portfolios);

    public function prepareDataForCreation($args);

}