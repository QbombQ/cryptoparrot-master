<?php

namespace App\Http\Controllers\AdminSubsystem;

use App\Http\Controllers\AdminSubsystem\BaseAdminSubsystemController;
use App\Model\Contracts\Interfaces\Services\AdminSubsystem\TradeServiceInterface;
use App\Model\Contracts\Interfaces\Services\AdminSubsystem\UserServiceInterface;
use Illuminate\Http\Request;

class TradesPageController extends BaseAdminSubsystemController
{

    protected $tradeService;
	protected $userService;
	
	const REDIRECT_TO_AFTER_ACTION = '/admin/trades';

    public function __construct(
		TradeServiceInterface $tradeService,
		UserServiceInterface $userService
    )
    {

        parent::__construct('trades');
        $this->tradeService = $tradeService;
        $this->userService = $userService;

    }
	
	public function main()
	{

		$this->data['trades'] = $this->tradeService->paginate(config('custom.admin.itemsPerPage'));
		$this->data['users'] = $this->userService->all();

		return view($this->viewWithPrefix('trades'), $this->data);		
		
	}

	public function edit($tradeId)
	{

		$this->data['trade'] = $this->tradeService->getForEdit($tradeId);
		
        return view($this->viewWithPrefix('edit'), $this->data);
		
    }     
    
	public function update(Request $request)
	{
        
        $response = $this->tradeService->edit($request);
        
		return is_string($response) ? // String means success message
				redirect(self::REDIRECT_TO_AFTER_ACTION)->with('message', $response) :
				back()->withInput()->withErrors($response);
		
	}        

	public function sitemap()
	{

		$response = $this->tradeService->generateSitemap();
		
		return redirect(self::REDIRECT_TO_AFTER_ACTION)->with('message', $response);

	}

	public function updateTrades()
	{
	
		$backupTrades = \App\Trade::all();

		$first = \Carbon\Carbon::create(2019, 2, 8, 17);
		$second = \Carbon\Carbon::create(2019, 2, 9, 20);

		foreach($backupTrades as $backupTrade)
		{

			$trade = \App\Model\Data\Models\Trade::find($backupTrade->id);
			if(\Carbon\Carbon::parse($trade->updated_at)->between($first, $second)) {
				$trade->updated_at = $backupTrade->updated_at;
				$trade->save();
			}

		}

	}
 
}