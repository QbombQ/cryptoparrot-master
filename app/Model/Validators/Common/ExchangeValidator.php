<?php

namespace App\Model\Validators\Common;

use App\Model\Contracts\Interfaces\Validators\Common\ExchangeValidatorInterface;
use Illuminate\Support\Facades\Validator;
use App\Rules\EnoughFunds;
use App\Rules\CorrectExchangeAmount;
use App\Rules\LastExchangeOlderThanTenMinutes;
use App\Rules\ExchangedAmountIn24Hours;
use App\Rules\UserHasConfirmedStatus;
use App\Rules\UserIpUsedInRewards;
use App\Rules\UserIsUsingVPN;
use App; 
use Log;  
use Carbon\Carbon;
 
class ExchangeValidator implements ExchangeValidatorInterface
{

    protected $validator;
  
    public function validateCreation($data,$user,$btcRate)
    {

        $invoiceAddress = array_key_exists('invoice_address', $data) ? $data['invoice_address'] : null;

		$this->validator = Validator::make($data, [
            'user_id' => ['required','exists:users,id', new UserHasConfirmedStatus(), new UserIpUsedInRewards(),new UserIsUsingVPN()],
            'amount' => ['required', 'numeric', 'min:1000', 'max:10000000', new EnoughFunds(), new CorrectExchangeAmount($invoiceAddress,$btcRate)],
            'invoice_address' => 'required|string', 
        ]);
 
        if($this->validator->fails())
        {

            return false;

        } 

        $exchangeRepository = App::make('App\Model\Contracts\Interfaces\Data\ExchangeRepositoryInterface');
        $lastExchange = $exchangeRepository->getLastExchange($user->id);
        $exhangedAmount = $exchangeRepository->getExchangedAmountInLast24Hours($user->id);


        $data['created_at'] = (isset($lastExchange->created_at)) ? $lastExchange->created_at : Carbon::now()->subDays(2);
        $data['exchanged_amount'] = $exhangedAmount;
 
        \Log::error('$exhangedAmount');
        \Log::error($exhangedAmount); 

        $this->validator = Validator::make($data, [
            'created_at' => [new LastExchangeOlderThanTenMinutes()],
            'exchanged_amount' => [new ExchangedAmountIn24Hours()],
        ]);

        return !$this->validator->fails();

    }    
    
    public function getErrors()
    {
        
        if(!$this->validator) return null;
        
        return $this->validator;

    }

}