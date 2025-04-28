<?php 

namespace App\Model\Formatters\FrontSubsystem;

use App\Model\Contracts\Interfaces\Formatters\FrontSubsystem\EmailFormatterInterface;

class EmailFormatter implements EmailFormatterInterface
{

    public function prepareEmailsForSharingWithFriends($data)
    {

        if(!isset($data['emails']) || !is_array($data['emails'])) 
        {
            
            return [];

        }

        $data['emails'] = array_filter(array_unique($data['emails']));

        return $data;

    }
    
}