<?php

namespace App\Http\Controllers\AdminSubsystem;

use App;
use App\Http\Controllers\Controller;

class BaseAdminSubsystemController extends Controller
{
	
	protected $data;
	protected $subsystemViewPrefix;
	
	const SUBSYSTEM_VIEW_PREFIX = 'pages/AdminSubsystem/';

	public function __construct($viewPrefix = '') 
	{

		App::setLocale('en');
		$this->data = [];
		$this->subsystemViewPrefix = self::SUBSYSTEM_VIEW_PREFIX . $viewPrefix . '/';
		
	}

	public function viewWithPrefix($view)
	{

		return $this->subsystemViewPrefix . $view;

	}

}