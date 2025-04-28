<?php

namespace App\Model\Contracts\Interfaces\Formatters\AdminSubsystem;

interface BadgeFormatterInterface
{

    public function prepareBadgesForSelect($badges);

    public function prepareBadgesForDisplay($badges);

    public function prepareDataForCreation($data);

    public function prepareDataForUpdate($data);

    public function prepareForEdit($badge);        

    public function prepareGiveResponseWithError($message);

    public function prepareGiveResponse($message);

}