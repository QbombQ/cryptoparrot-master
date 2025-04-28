<?php

namespace App\Model\Currencies;

class THR extends Currency {

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

        $this->precisionArray['USD'] = 4;
        $this->precisionArray['BTC'] = 4;

    }     

}