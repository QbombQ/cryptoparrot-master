<?php

namespace App\Model\Contracts\Interfaces\Data;

interface NewsletterMessageRepositoryInterface
{

    public function get($userId, $subject);

    public function add($args);

}