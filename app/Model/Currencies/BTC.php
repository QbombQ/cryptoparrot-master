<?php

namespace App\Model\Currencies;

class BTC extends Currency {

    const DEFAULT_PRECISION = 4;

    public function __construct()
    {

        parent::__construct();
        $this->changeDefaultValues(); 

    }

    private function changeDefaultValues()
    {

        $this->changeDefaultPrecision();
        $this->changePrecisionArray();

    }

    private function changeDefaultPrecision()
    {

        $this->defaultPrecision = self::DEFAULT_PRECISION;

    }

    private function changePrecisionArray()
    {

        $this->precisionArray['USD'] = 2; 
        $this->precisionArray['ETH'] = 2;
        $this->precisionArray['DOGE'] = 8;

    }    

}