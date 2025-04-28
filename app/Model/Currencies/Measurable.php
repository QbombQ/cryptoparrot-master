<?php

namespace App\Model\Currencies;

interface Measurable {

    public function precisionIn($currencyCode);

    public function getDefaultPrecision();

} 