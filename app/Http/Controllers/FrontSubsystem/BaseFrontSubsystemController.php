<?php

namespace App\Http\Controllers\FrontSubsystem;

use App;
use App\Http\Controllers\Controller;
use App\Model\Contracts\Interfaces\Formatters\TradeSubsystem\UserFormatterInterface;
use Auth;

class BaseFrontSubsystemController extends Controller
{
	
	protected $data;
	protected $subsystemViewPrefix;
	
	const SUBSYSTEM_VIEW_PREFIX = 'pages/FrontSubsystem/';
	
	public function __construct($viewPrefix = '') 
	{

		App::setLocale('en');
		$this->data = [];
		$this->subsystemViewPrefix = self::SUBSYSTEM_VIEW_PREFIX . $viewPrefix . '/';
		
	}

	public function getCommonData()
	{

		$this->userFormatter = App::make(UserFormatterInterface::class);
		$this->data = [];

		if(Auth::check()) 
		{

			$this->data['commonUserData'] = $this->userFormatter->prepareCommonUserDataForTradeSubsystem(Auth::user());

		}

	}	

	public function viewWithPrefix($view)
	{

		return $this->subsystemViewPrefix . $view;

	}

}