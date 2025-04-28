<?php

namespace App\Model\Currencies;

class EUR extends Currency {

    const DEFAULT_PRECISION = 2;

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

        $this->precisionArray['USD'] = 5;

    }    

}