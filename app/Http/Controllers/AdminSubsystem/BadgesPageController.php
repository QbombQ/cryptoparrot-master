<?php

namespace App\Http\Controllers\AdminSubsystem;

use App\Http\Controllers\AdminSubsystem\BaseAdminSubsystemController;
use App\Model\Contracts\Interfaces\Services\AdminSubsystem\BadgeServiceInterface;
use Illuminate\Http\Request;

class BadgesPageController extends BaseAdminSubsystemController
{

	protected $badgeService;
	
	const REDIRECT_TO_AFTER_ACTION = '/admin/badges';

    public function __construct(
        BadgeServiceInterface $badgeService
    )
    {

		parent::__construct('badges');
        $this->badgeService = $badgeService;

    }
	
	public function main()
	{
        
		$this->data['badges'] = $this->badgeService->paginate(config('custom.admin.itemsPerPage'));
		
		return view($this->viewWithPrefix('badges'), $this->data);		
		
    }
    
	public function new()
	{

		return view($this->viewWithPrefix('new'));	
		
	}    
	
	public function give(Request $request)
	{

		return $this->badgeService->give($request->all());

	}

	public function edit($badgeId)
	{

		$this->data['badge'] = $this->badgeService->getForEdit($badgeId);

		//dd($this->data['badge']);
		
        return view($this->viewWithPrefix('edit'), $this->data);
		
    }      
    
    public function create(Request $request)
    {

        $response = $this->badgeService->create($request->all());

		return is_string($response) ? // String means success message
				redirect(self::REDIRECT_TO_AFTER_ACTION)->with('message', $response) :
				back()->withInput()->withErrors($response);

    }     
    
	public function update(Request $request)
	{
        
        $response = $this->badgeService->edit($request->all());
        
		return is_string($response) ? // String means success message
				redirect(self::REDIRECT_TO_AFTER_ACTION)->with('message', $response) :
				back()->withInput()->withErrors($response);
		
	}    

}