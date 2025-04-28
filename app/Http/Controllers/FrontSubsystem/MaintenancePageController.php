<?php

namespace App\Http\Controllers\FrontSubsystem;

use App\Http\Controllers\FrontSubsystem\BaseFrontSubsystemController;
use Illuminate\Http\Request;

class MaintenancePageController extends BaseFrontSubsystemController
{

    public function __construct()
    {

        parent::__construct();

    }
	
	public function main()
	{

		return view($this->viewWithPrefix('maintenance'));		
		
    }
    
    public function login(Request $request)
    {

        if($request->email == env('MAINTENANCE_EMAIL') && $request->password == env('MAINTENANCE_PASSWORD'))
        {

            return response(view($this->viewWithPrefix('landing')))->cookie(
                'authenticated', '1', config('custom.ref_code_expire_time_in_mins')
            );        

        }

        return redirect('/');

    }

}