<?php

namespace App\Model\Currencies;

class Currency implements Measurable {

    protected $precisionArray;
    protected $defaultPrecision;
 
    public function __construct()
    {

        $this->defaultPrecision = 0;
        $this->precisionArray = []; 

    }

    public function precisionIn($currencyCode)
    {

        return array_key_exists($currencyCode, $this->precisionArray) ?
                $this->precisionArray[$currencyCode] :
                $this->defaultPrecision;

    }

    public function getDefaultPrecision()
    {

        return $this->defaultPrecision;

    }

}