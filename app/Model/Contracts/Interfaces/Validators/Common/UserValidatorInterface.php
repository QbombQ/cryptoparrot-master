<?php

namespace App\Model\Contracts\Interfaces\Validators\Common;

interface UserValidatorInterface
{

    public function validateCreation($data);

    public function validateReservation($id, $data);

    public function validateProfileUpdate($id, $data);

    public function validateSocialLinksUpdate($data);

    public function validateNotificationsUpdate($data);

    public function validatePasswordUpdate($data, $oldPasswordHashed);

    public function validateAvatarUpdate($data);

    public function validateCoverUpdate($data);

    public function validateLogin($data);

    public function validateRecover($data);

    public function getErrors();

    public function validateCurrentPortfolioChange($args);

}