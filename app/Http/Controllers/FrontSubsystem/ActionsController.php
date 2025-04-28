<?php

namespace App\Http\Controllers\FrontSubsystem;

use App\Http\Controllers\FrontSubsystem\BaseFrontSubsystemController;
use App\Model\Contracts\Interfaces\Services\Common\EmailServiceInterface;
use App\Model\Contracts\Interfaces\Services\TradeSubsystem\TradeServiceInterface;
use App\Model\Contracts\Interfaces\Services\Common\HistoricalServiceInterface;
use App\Model\Contracts\Interfaces\Services\Common\NotificationServiceInterface;
use App\Model\Contracts\Interfaces\Services\FrontSubsystem\UserServiceInterface;
use App\Model\Contracts\Interfaces\Services\TradeSubsystem\CurrencyServiceInterface;
use App\Model\Contracts\Interfaces\Services\TradeSubsystem\BalanceServiceInterface;
use App\Model\Contracts\Interfaces\Services\TradeSubsystem\TradePairServiceInterface;
use App\Model\Contracts\Interfaces\Services\FrontSubsystem\DeviceServiceInterface;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Auth;
use Session;
use Cookie;
use Illuminate\Support\Facades\DB;

class ActionsController extends BaseFrontSubsystemController
{

	protected $emailService;
	protected $userService;
	protected $tradeService;
	protected $currencyService;
	protected $balanceService;
	protected $historicalService;
	protected $notificationService;
	protected $tradePairService;
	protected $deviceService;

	public function __construct(EmailServiceInterface $emailService,
								TradeServiceInterface $tradeService,
								BalanceServiceInterface $balanceService,
								CurrencyServiceInterface $currencyService,
								HistoricalServiceInterface $historicalService,
								NotificationServiceInterface $notificationService,
								TradePairServiceInterface $tradePairService,
								DeviceServiceInterface $deviceService,
								UserServiceInterface $userService) 
	{

		parent::__construct();
		$this->emailService = $emailService;
		$this->userService = $userService;
		$this->tradeService = $tradeService;
		$this->currencyService = $currencyService;
		$this->balanceService = $balanceService;
		$this->historicalService = $historicalService;
		$this->notificationService = $notificationService;
		$this->tradePairService = $tradePairService;
		$this->deviceService = $deviceService;
		
	}		

	public function updateDevice(Request $request)
	{
		
		$secret = Input::get('secret');

		if(!$secret || $secret !== env('API_SECRET_KEY'))
		{

            return [
				'success' => false,
				'message' => trans('FrontSubsystem/error-messages.incorrect-secret-key')
			];

		}
		
		return $this->deviceService->createOrUpdate($request->all());

	}

	public function sendMessage(Request $request)
	{
		
		$response = $this->emailService->sendEmailToAdministrator($request);

		return is_string($response) ? // String means success message
				back()->with('message', $response) :
				back()->withInput()->withErrors($response);
		
	}	

	public function shareWithFriends(Request $request)
	{
        
        return $this->emailService->sendNotificationsAboutWebsite($request);
		
	}

	public function recoverPassword(Request $request)
	{
        
		$response = $this->userService->recoverPassword($request);
		
		return is_string($response) ? // String means success message
				back()->with('message', $response) :
				back()->withInput()->withErrors($response);		
		
	}	

	public function loadChangePasswordView($token)
	{

		$this->data['token'] = $token;

		return $this->userService->passwordRecoveryTokenValid($token) ? 
				view($this->viewWithPrefix('change-password'), $this->data) :
				redirect('/')->with('errorMessage', trans('FrontSubsystem/error-messages.error-password-change'));
		
	} 	

	public function changePassword(Request $request)
	{

		$response = $this->userService->changePassword($request);

		return is_string($response) ? 
				redirect('/app')->with('message', trans('FrontSubsystem/success-messages.password-changed')) :
				back()->withErrors($response);
		
	} 	

	public function logout()
	{

		Auth::logout();
		return redirect('/', 302);
		
	} 		 

	public function addRefCodeToCookie(Request $request, $code)
	{ 

		parent::getCommonData();

		$allowedGoals = config('custom.allowed_goals');    

		if(in_array($code, $allowedGoals))
		{

			$this->data['totalRegisteredWithCode'] = $this->userService->getCodeCount($code);

			return response(view($this->viewWithPrefix('goals/'.$code), $this->data))->cookie(
			    'ref_code', $code, config('custom.ref_code_expire_time_in_mins')
			);  

		}else{

			abort(404);

		}

	}  

	public function addRefCodeToCookieAndRedirectHome(Request $request, $code)
	{ 

		parent::getCommonData();

		$allowedGoals = config('custom.allowed_goals');      

		if(in_array($code, $allowedGoals))
		{

			$this->data['totalRegisteredWithCode'] = $this->userService->getCodeCount($code);
			Cookie::queue('ref_code', $code, config('custom.ref_code_expire_time_in_mins'));

			return redirect('/', 301);

		}else{

			abort(404);

		}

	}		 

	public function updateTrades($fromId, $toId)
	{

		$this->tradeService->updateTrades($fromId, $toId);
		
	} 	

	public function updateCurrencies()
	{

		$this->currencyService->updateCurrenciesRates();
		
	} 	
	
	public function updateCurrenciesAverage()
	{

		$this->currencyService->updateCurrenciesRatesAverage();
		
	} 		

	public function updateBalances()
	{

		$this->balanceService->updateAllUsdValues();
		
	} 	

	public function updateHistoricalPortfolioValues()
	{

		$this->historicalService->updateHistoricalPortfolioValues();

	}	

	public function unsubscribeNewsletter($token)
	{

		$this->notificationService->unsubscribeNewsletter($token);
		
		return redirect('/unsubscribe');

	}

}