<?php

namespace App\Http\Controllers\TradeSubsystem;

use App\Http\Controllers\TradeSubsystem\BaseTradeSubsystemController;
use App\Model\Contracts\Interfaces\Formatters\TradeSubsystem\UserFormatterInterface;
use App\Model\Contracts\Interfaces\Services\TradeSubsystem\CompetitionServiceInterface;
use Illuminate\Http\Request;

class CompetitionsPageController extends BaseTradeSubsystemController
{

    protected $competitionService;

    public function __construct(
		UserFormatterInterface $userFormatter,
		CompetitionServiceInterface $competitionService
	) 
	{

        parent::__construct($userFormatter);
        $this->competitionService = $competitionService;
		
	}    
	
	public function main()
	{

		parent::getCommonData();
		$this->data['competitions'] = $this->competitionService->paginate(config('custom.perPage.competitions'));

		return view($this->viewWithPrefix('competitions'), $this->data);		
		
	}

	public function participate($competitionId,Request $request)
	{

		$password = $request->input('password');
		$response = $this->competitionService->participate($competitionId,$password);
		
		return redirect('/app/competitions')->with('message', json_encode($response));
		
	}

	public function single($competitionId)
	{

		parent::getCommonData();
		$this->data['competitionData'] = $this->competitionService->get($competitionId);
		
		return view($this->viewWithPrefix('competition'), $this->data);			

	}	

}