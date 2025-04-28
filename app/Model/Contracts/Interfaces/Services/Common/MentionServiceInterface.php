<?php

namespace App\Model\Contracts\Interfaces\Services\Common;

interface MentionServiceInterface
{

    public function mention($text, $trade, $mentionedBy);

}