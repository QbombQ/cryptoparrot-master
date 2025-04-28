<?php

namespace App\Model\Data\Repositories;

use App\Model\Contracts\Interfaces\Data\NewsletterMessageRepositoryInterface;
use App\Model\Data\Models\NewsletterMessage;

class NewsletterMessageRepository implements NewsletterMessageRepositoryInterface
{

    public function get($userId, $subject)
    {

        return NewsletterMessage::where('user_id', $userId)->where('subject', $subject)->first();

    }

    public function add($args)
    {

        $message = new NewsletterMessage;
        $message->fill($args);
        $message->save();

    }

}