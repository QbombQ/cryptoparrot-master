<?php 

namespace App\Model\Validators\AdminSubsystem;

use App\Model\Contracts\Interfaces\Validators\AdminSubsystem\TradePairValidatorInterface;
use Illuminate\Support\Facades\Validator;

class TradePairValidator implements TradePairValidatorInterface
{

    protected $validator;
	
	public function validateCreate($data)
	{
        
		$this->validator = Validator::make($data, [
            'from_currency_id' => 'required|integer|different:to_currency_id|unique_with:trade_pairs,to_currency_id',
            'to_currency_id' => 'required|integer',
            'rate' => 'required|numeric',
            'rate_sell' => 'required|numeric',
            'show_on_currencies_page' => 'required|in:on,off',
            'disabled' => 'required|in:on,off',
            'priority' => 'required|integer|min:0'
        ]);		

		return !$this->validator->fails();
		
    }

    public function validateUpdate($data)
	{
        
		$this->validator = Validator::make($data, [
            'buy_volume_limit' => 'required|integer|min:1',
            'sell_volume_limit' => 'required|integer|min:1',
            'pair_id' => 'required|integer|exists:trade_pairs,id',
            'show_on_currencies_page' => 'required|in:on,off',
            'disabled' => 'required|in:on,off',
            'priority' => 'required|integer|min:0'
        ]);		

		return !$this->validator->fails();
		
    }

    public function getErrors()
    {
        
        if(!$this->validator) 
        {
            
            return null;

        }

        return $this->validator;

    }
    
}