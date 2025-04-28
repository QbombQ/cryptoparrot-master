<?php

namespace App\Http\Controllers\AdminSubsystem;

use App\Http\Controllers\AdminSubsystem\BaseAdminSubsystemController;
use App\Model\Contracts\Interfaces\Services\AdminSubsystem\CompetitionServiceInterface;
use App\Model\Contracts\Interfaces\Services\AdminSubsystem\BadgeServiceInterface;
use Illuminate\Http\Request;

class CompetitionPageController extends BaseAdminSubsystemController
{

    protected $competitionService;
    protected $badgeService;

    const REDIRECT_TO_AFTER_ACTION = '/admin/competitions';

    public function __construct(
        CompetitionServiceInterface $competitionService,
        BadgeServiceInterface $badgeService
    )
    {

        parent::__construct('competitions');
        $this->competitionService = $competitionService;
        $this->badgeService = $badgeService;

    }
	
	public function main()
	{
        
        $this->data['badges'] = $this->badgeService->all();

		return view($this->viewWithPrefix('new'), $this->data);		
		 
    }
    
    public function create(Request $request)
    {

        $response = $this->competitionService->create($request->all());

		return is_string($response) ? // String means success message
				redirect(self::REDIRECT_TO_AFTER_ACTION)->with('message', $response) :
				back()->withInput()->withErrors($response);

    }    

    public function edit($competitionId)
    {

        $this->data['badges'] = $this->badgeService->all();
        $this->data['competition'] = $this->competitionService->getForEdit($competitionId);

        return view($this->viewWithPrefix('edit'), $this->data);	

    }    

    public function update(Request $request)
    {

        $response = $this->competitionService->update($request->all());

		return is_string($response) ? // String means success message
				redirect(self::REDIRECT_TO_AFTER_ACTION)->with('message', $response) :
				back()->withInput()->withErrors($response);

    }        

    public function register(Request $request)
    {

        $response = $this->competitionService->register($request->all());
        
		return is_string($response) ? // String means success message
				redirect(self::REDIRECT_TO_AFTER_ACTION)->with('message', $response) :
				back()->withInput()->withErrors($response);

    }           

}