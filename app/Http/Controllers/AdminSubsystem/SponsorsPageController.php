<?php

namespace App\Http\Controllers\AdminSubsystem;

use App\Http\Controllers\AdminSubsystem\BaseAdminSubsystemController;
use App\Model\Contracts\Interfaces\Services\AdminSubsystem\SponsorServiceInterface;
use Illuminate\Http\Request;

class SponsorsPageController extends BaseAdminSubsystemController
{

    protected $sponsorService;

	const REDIRECT_TO_AFTER_ACTION = '/admin/sponsors';

    public function __construct(
        SponsorServiceInterface $sponsorService
    )
    {

		parent::__construct('sponsors');
        $this->sponsorService = $sponsorService;

    }
	
	public function main()
	{
        
		$this->data['sponsors'] = $this->sponsorService->paginate(config('custom.admin.itemsPerPage'));
		
		return view($this->viewWithPrefix('sponsors'), $this->data);		
		
    }
    
	public function new()
	{

		return view($this->viewWithPrefix('new'));	
		
	}    

    
    public function create(Request $request)
    {

        $response = $this->sponsorService->create($request->all());

		return is_string($response) ? // String means success message
				redirect(self::REDIRECT_TO_AFTER_ACTION)->with('message', $response) :
				back()->withInput()->withErrors($response);

    }     	

	public function edit($sponsorId)
	{

		$this->data['sponsor'] = $this->sponsorService->getForEdit($sponsorId);
		
        return view($this->viewWithPrefix('edit'), $this->data);
		
    }      
    
	public function update(Request $request)
	{
        
        $response = $this->sponsorService->edit($request->all());
        
		return is_string($response) ? // String means success message
				redirect(self::REDIRECT_TO_AFTER_ACTION)->with('message', $response) :
				back()->withInput()->withErrors($response);
		
	}    

	public function delete($sponsorId)
    {

        $response = $this->sponsorService->delete($sponsorId);

		return is_string($response) ? // String means success message
				redirect(self::REDIRECT_TO_AFTER_ACTION)->with('message', $response) :
				back()->withInput()->withErrors($response);

    }

}