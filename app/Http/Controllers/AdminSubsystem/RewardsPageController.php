<?php

namespace App\Http\Controllers\AdminSubsystem;

use App\Http\Controllers\AdminSubsystem\BaseAdminSubsystemController;
use App\Model\Contracts\Interfaces\Services\AdminSubsystem\RewardServiceInterface;
use App\Model\Contracts\Interfaces\Services\AdminSubsystem\SponsorServiceInterface;
use Illuminate\Http\Request;

class RewardsPageController extends BaseAdminSubsystemController
{

    protected $rewardService;
	protected $sponsorService;
	
	const REDIRECT_TO_AFTER_ACTION = '/admin/rewards';

    public function __construct(
		RewardServiceInterface $rewardService,
		SponsorServiceInterface $sponsorService
    )
    {

		parent::__construct('rewards');
        $this->rewardService = $rewardService;
        $this->sponsorService = $sponsorService;

    }
	
	public function main()
	{
        
		$this->data['rewards'] = $this->rewardService->paginate(config('custom.admin.itemsPerPage'));
		
		return view($this->viewWithPrefix('rewards'), $this->data);		
		
    }
    
	public function new()
	{

		$this->data['sponsors'] = $this->sponsorService->all();

		return view($this->viewWithPrefix('new'), $this->data);	
		
	}    

    
    public function create(Request $request)
    {

        $response = $this->rewardService->create($request->all());

		return is_string($response) ? // String means success message
				redirect(self::REDIRECT_TO_AFTER_ACTION)->with('message', $response) :
				back()->withInput()->withErrors($response);

    }     	

	public function edit($rewardId)
	{

		$this->data['sponsors'] = $this->sponsorService->all();
		$this->data['reward'] = $this->rewardService->getForEdit($rewardId);
		
        return view($this->viewWithPrefix('edit'), $this->data);
		
    }      
    
	public function update(Request $request)
	{
        
        $response = $this->rewardService->edit($request->all());
        
		return is_string($response) ? // String means success message
				redirect(self::REDIRECT_TO_AFTER_ACTION)->with('message', $response) :
				back()->withInput()->withErrors($response);
		
	}    

	public function delete($rewardId)
    {

        $response = $this->rewardService->delete($rewardId);

		return is_string($response) ? // String means success message
				redirect(self::REDIRECT_TO_AFTER_ACTION)->with('message', $response) :
				back()->withInput()->withErrors($response);

	}
	
	public function userRewards()
	{

		$this->data['userRewards'] = $this->rewardService->paginateUserRewards(config('custom.admin.itemsPerPage'));
		
		return view($this->viewWithPrefix('user-rewards'), $this->data);

	}

	public function updateUserReward(Request $request)
	{

		return $this->rewardService->updateUserRewardStatus($request->all());

	}

}