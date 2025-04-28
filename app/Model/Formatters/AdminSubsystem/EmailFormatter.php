<?php

namespace App\Model\Formatters\AdminSubsystem;

use App\Model\Contracts\Interfaces\Formatters\AdminSubsystem\EmailFormatterInterface;

class EmailFormatter implements EmailFormatterInterface
{

    public function prepareMassEmailData($data)
    {

        return [
            'subject' => $data['subject'],
            'content' => $data['content']
        ];

    }

}