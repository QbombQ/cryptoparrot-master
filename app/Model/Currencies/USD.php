<?php

namespace App\Model\Currencies;

class USD extends Currency {

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

        $this->precisionArray['AUD'] = 5;
        $this->precisionArray['EUR'] = 5;
        $this->precisionArray['GBP'] = 5;
        $this->precisionArray['NZD'] = 5;

    }    
 
} 