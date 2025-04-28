<?php 

namespace App\Model\Validators\AdminSubsystem;

use App\Model\Contracts\Interfaces\Validators\AdminSubsystem\CurrencyValidatorInterface;
use Illuminate\Support\Facades\Validator;

class CurrencyValidator implements CurrencyValidatorInterface
{

    protected $validator;
	
	public function validateCreate($data)
	{
        
		$this->validator = Validator::make($data, [
            'name' => 'required|string|unique:currencies,name',
            'acronym' => 'required|string|unique:currencies,acronym',
            'symbol' => 'required|string|unique:currencies,symbol',
            'usd_value' => 'required|numeric',
            'links.*' => 'sometimes|nullable|url'
        ]);	

		return !$this->validator->fails();
		
    }

	public function validateUpdate($data)
	{
        
        $currencyId = $data['currency_id'];

        if(!$currencyId)
        {
            
            return false;

        }

		$this->validator = Validator::make($data, [
            'name' => 'required|string|unique:currencies,name,'.$currencyId,
            'acronym' => 'required|string|unique:currencies,acronym,'.$currencyId,
            'symbol' => 'required|string|unique:currencies,symbol,'.$currencyId,
            'usd_value' => 'required|numeric',
            'links.*' => 'sometimes|nullable|url'
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