<?php

namespace App\Http\Controllers\FrontSubsystem;

use App\Http\Controllers\FrontSubsystem\BaseFrontSubsystemController;
use App\Model\Contracts\Interfaces\Services\TradeSubsystem\CryptoCurrencyServiceInterface;

class PagesController extends BaseFrontSubsystemController
{

	protected $cryptoCurrencyService; 

    public function __construct(CryptoCurrencyServiceInterface $cryptoCurrencyService)
    {

        parent::__construct();
        $this->cryptoCurrencyService = $cryptoCurrencyService;

    }
 
	public function privacyPolicy()
	{
		
		parent::getCommonData();

		return view($this->viewWithPrefix('privacy-policy'), $this->data);		
		
	}

	public function termsOfService()
	{
		
		parent::getCommonData();

		return view($this->viewWithPrefix('tos'), $this->data);		
		
	}
 
 	private function format_cash($cash) {
                // strip any commas 
                $cash = (0 + STR_REPLACE(',', '', $cash));
             
                // make sure it's a number...
                if(!is_numeric($cash)){ return FALSE;}
             
                // filter and format it 
                if($cash>1000000000000){ 
                    return number_format(round(($cash/1000000000000),2),2,'.',',').' trillion';
                }elseif($cash>1000000000){ 
                    return number_format(round(($cash/1000000000),2),2,'.',',').' billion';
                }elseif($cash>1000000){ 
                    return number_format(round(($cash/1000000),2),2,'.',',').' million';
                }elseif($cash>1000){ 
                    return number_format(round(($cash/1000),2),2,'.',',').' thousand';
                }
             
                return number_format($cash);
    }

 	public function cryptoMoon()
	{
		
		parent::getCommonData();

		$tradePairs = $this->cryptoCurrencyService->getGraphData();
    
    	$array = array();
    	$i = 0;
		foreach ($tradePairs as $key => $trade) {
			$array[$i]['rank'] = $trade['pair']->getRank();
			$array[$i]['name'] = $trade['pair']->getName();
			$array[$i]['symbol'] = $trade['pair']->getSymbol();
			$array[$i]['price'] = $trade['pair']->getPriceUSD();
			$array[$i]['circulatingSupply'] = $trade['pair']->getCirculatingSupply();
			$array[$i]['mkt'] = $this->format_cash($array[$i]['circulatingSupply'] * 384400);
			$array[$i]['percentChange24h'] = $trade['pair']->getPercentChange24h();
			$array[$i]['percentChange7d'] = $trade['pair']->getPercentChange7d();
			$i++;
		} 



		usort($array, function($a, $b) {
		    return $a['rank'] - $b['rank'];
		});

		$this->data['currencies'] = $array;

		return view($this->viewWithPrefix('crypto-moon'), $this->data);		
		 
	}
 
	public function about()
	{
		
		parent::getCommonData();

		return view($this->viewWithPrefix('about'), $this->data);		
		 
	}

	public function organizations()
	{
		
		parent::getCommonData();

		return view($this->viewWithPrefix('organizations'), $this->data);		
		 
	}

	public function banned()
	{
		
		parent::getCommonData();

		return view($this->viewWithPrefix('banned'), $this->data);		
		 
	}

	public function faq()
	{
		
		parent::getCommonData();

		return view($this->viewWithPrefix('faq'), $this->data);		
		
	}

	public function careers()
	{
		
		parent::getCommonData();

		return view($this->viewWithPrefix('careers'), $this->data);		
		
	} 

	public function contact()
	{
		
		parent::getCommonData();

		return view($this->viewWithPrefix('contact'), $this->data);		
		
	} 

	public function disclaimer()
	{
		 
		parent::getCommonData();

		return view($this->viewWithPrefix('disclaimer'), $this->data);		
		
	}  

	public function partnerships()
	{
		 
		parent::getCommonData();

		return view($this->viewWithPrefix('partnerships'), $this->data);		
		
	}  

	public function loadRecoverPasswordView()
	{
		
		parent::getCommonData();

        return view($this->viewWithPrefix('forgot-password'), $this->data);	
		
	}	
	
	public function success()
	{
		
		parent::getCommonData();

		return view($this->viewWithPrefix('registration-success'), $this->data);		
		
	}	
	
	public function pickYourHandle()
	{

		parent::getCommonData();

		return view($this->viewWithPrefix('pick-your-handle'), $this->data);		
		
	}   

    public function loadLoginView()
    {

		parent::getCommonData();

		return view($this->viewWithPrefix('login'), $this->data);		

	}

	public function unsubscribe()
	{
		
		parent::getCommonData();
		
		return view($this->viewWithPrefix('unsubscribe'), $this->data);		
		 
	} 

} 