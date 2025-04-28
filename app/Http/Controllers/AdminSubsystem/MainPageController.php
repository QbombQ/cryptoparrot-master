<?php

namespace App\Http\Controllers\AdminSubsystem;

use App\Http\Controllers\AdminSubsystem\BaseAdminSubsystemController;
use App\Model\Contracts\Interfaces\Services\AdminSubsystem\UserServiceInterface;
use App\Model\Contracts\Interfaces\Services\AdminSubsystem\TradeServiceInterface;
use App\Model\Contracts\Interfaces\Services\AdminSubsystem\BadgeServiceInterface;
use App\Model\Contracts\Interfaces\Services\AdminSubsystem\NewsletterMessageServiceInterface;
use App\Model\Contracts\Interfaces\Services\AdminSubsystem\QueueServiceInterface;

class MainPageController extends BaseAdminSubsystemController
{

	protected $userService;
	protected $tradeService;
	protected $badgeService;
	protected $newsletterMessageService;
	protected $queueService;

    public function __construct(
		UserServiceInterface $userService,
		TradeServiceInterface $tradeService,
		BadgeServiceInterface $badgeService,
		NewsletterMessageServiceInterface $newsletterMessageService,
		QueueServiceInterface $queueService
    )
    {

		parent::__construct();
		$this->userService = $userService;
		$this->tradeService = $tradeService;
		$this->badgeService = $badgeService; 
		$this->newsletterMessageService = $newsletterMessageService; 
		$this->queueService = $queueService; 

	}	
	
	public function main()
	{

		$this->data['queuedJobs'] = $this->queueService->getJobsCurrentlyInQueue();
		$this->data['users'] = $this->userService->all();
		$this->data['tradeCount'] = $this->tradeService->countAllTrades();  
		$this->data['badges'] = $this->badgeService->all();
		$this->data['usersActivity'] = $this->userService->getUserActivity();
		$this->data['newsletter'] = $this->newsletterMessageService->getCurrentProgress();
		$this->data['finishedTradesWithReservedSums'] = $this->tradeService->getFinishedTradesWithReservedSums();
		$this->data['finishedTradesWithMoreThanOneRelease'] = $this->tradeService->getFinishedTradesWithMoreThanOneRelease();
		$this->data['last6MonthsUserStatuses'] = $this->userService->getLastYearStats();
		$this->data['last6MonthsTrades'] = $this->tradeService->getLastYearStats();

		return view($this->viewWithPrefix('landing'), $this->data);

	}

}