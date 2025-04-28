<?php

namespace App\Model\Observers;

use App\Model\Contracts\Interfaces\Services\Common\CurrencyServiceInterface;
use App\Model\Data\Models\Currency;
use App\Model\Data\Models\User;
use App\Model\Events\CurrencyUpdated;
use App;

class CurrencyObserver
{

    protected $currencyService;
	
    public function __construct(
        CurrencyServiceInterface $currencyService
    )
	{

        $this->currencyService = $currencyService;
		
	}    

    public function updated(Currency $currency)
    {
        
        $users = User::all();

        foreach($users as $user)
        {

            if($user->id == $trade->author->id) continue;

            if($user->isOnline())
            {

                event(new CurrencyUpdated($user->id, $currency));

            }
            
        }
		
    }

}