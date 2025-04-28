<?php

namespace App\Http\Controllers\TradeSubsystem;

use App\Http\Controllers\TradeSubsystem\BaseTradeSubsystemController;
use App\Model\Contracts\Interfaces\Formatters\TradeSubsystem\UserFormatterInterface;
use App\Model\Contracts\Interfaces\Services\Common\PortfolioServiceInterface;
use App\Model\Contracts\Interfaces\Services\Common\UserServiceInterface;
use Auth;
use Illuminate\Http\Request;

class PortfoliosController extends BaseTradeSubsystemController
{

	protected $portfolioService;
	protected $userService;

	public function __construct(
        UserFormatterInterface $userFormatter,
        PortfolioServiceInterface $portfolioService,
        UserServiceInterface $userService
    ) 
	{

		parent::__construct($userFormatter);
		$this->portfolioService = $portfolioService;
		$this->userService = $userService;
		
	}
    
    public function create(Request $request)
    {

        $request->merge(['user_id' => Auth::id()]);

        return $this->portfolioService->create($request->all());

    }        

    public function updateCurrentPortfolio(Request $request)
    {

        $this->userService->updateCurrentPortfolio($request->all());
        
        return back();

    }

    public function close($portfolioId)
    {

        $response = $this->portfolioService->close($portfolioId, Auth::user());

        if($response === true)
        {

            return redirect('app');

        }

        return redirect('app')->with('message', $response);

    }

}