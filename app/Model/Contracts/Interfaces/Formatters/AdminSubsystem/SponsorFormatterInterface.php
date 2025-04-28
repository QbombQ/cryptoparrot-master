<?php

namespace App\Model\Contracts\Interfaces\Formatters\AdminSubsystem;

interface SponsorFormatterInterface
{

    public function prepareSponsorsForDisplay($sponsors);

    public function prepareDataForCreation($data);

    public function prepareDataForUpdate($data);

    public function prepareSponsorForEdit($sponsor);

    public function prepareSponsorsForSelect($sponsors);        

}