<?php

namespace App\Model\Contracts\Interfaces\Formatters\AdminSubsystem;

interface EmailFormatterInterface
{

    public function prepareMassEmailData($data);

}