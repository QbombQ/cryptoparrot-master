<?php

namespace App\Http\Controllers\AdminSubsystem;

use App\Http\Controllers\AdminSubsystem\BaseAdminSubsystemController;
use App\Model\Contracts\Interfaces\Services\AdminSubsystem\EarnPlayDollarServiceInterface;
use Illuminate\Http\Request;

class EarnPlayDollarsPageController extends BaseAdminSubsystemController
{

    protected $earnPlayDollarService;
	protected $sponsorService;
	
	const REDIRECT_TO_AFTER_ACTION = '/admin/earnPlayDollars';

    public function __construct(
		EarnPlayDollarServiceInterface $earnPlayDollarService
    )
    {

		parent::__construct('earnPlayDollars');
        $this->earnPlayDollarService = $earnPlayDollarService;

    }
	
	public function main()
	{
        
		$this->data['earnPlayDollars'] = $this->earnPlayDollarService->paginate(config('custom.admin.itemsPerPage'));
		
		return view($this->viewWithPrefix('earnPlayDollars'), $this->data);		
		
    }
    
	public function new()
	{
		
		return view($this->viewWithPrefix('new'));	
		
	}    

    public function create(Request $request)
    {

        $response = $this->earnPlayDollarService->create($request->all());

		return is_string($response) ? // String means success message
				redirect(self::REDIRECT_TO_AFTER_ACTION)->with('message', $response) :
				back()->withInput()->withErrors($response);

    }     	

	public function edit($earnPlayDollarId)
	{

		$this->data['earnPlayDollar'] = $this->earnPlayDollarService->getForEdit($earnPlayDollarId);
		
        return view($this->viewWithPrefix('edit'), $this->data);
		
    }      
    
	public function update(Request $request)
	{
        
        $response = $this->earnPlayDollarService->edit($request->all());
        
		return is_string($response) ? // String means success message
				redirect(self::REDIRECT_TO_AFTER_ACTION)->with('message', $response) :
				back()->withInput()->withErrors($response);
		
	}    

	public function delete($earnPlayDollarId)
    {

        $response = $this->earnPlayDollarService->delete($earnPlayDollarId);

		return is_string($response) ? // String means success message
				redirect(self::REDIRECT_TO_AFTER_ACTION)->with('message', $response) :
				back()->withInput()->withErrors($response);

    }

}