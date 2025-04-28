<?php

namespace App\Model\Contracts\Interfaces\Services\Common;

interface CurlServiceInterface
{

    public function getWebsiteHTML($url);
    public function getMultiPriceCurrencyRates($fSyms);
    public function getCurrencyDayAverage($currency);

}