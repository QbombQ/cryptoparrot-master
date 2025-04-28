<?php

namespace App\Http\Controllers\AdminSubsystem;

use App\Http\Controllers\AdminSubsystem\BaseAdminSubsystemController;
use App\Model\Contracts\Interfaces\Services\AdminSubsystem\UserServiceInterface;
use App\Model\Contracts\Interfaces\Services\AdminSubsystem\UserNotificationServiceInterface;
use App\Model\Contracts\Interfaces\Services\Common\UserServiceInterface as CommonUserServiceInterface;
use App\Model\Contracts\Interfaces\Services\AdminSubsystem\BadgeServiceInterface;
use App\Model\Contracts\Interfaces\Services\AdminSubsystem\EmailServiceInterface;
use App\Model\Contracts\Interfaces\Services\AdminSubsystem\CompetitionServiceInterface;
use Illuminate\Http\Request;

class UsersPageController extends BaseAdminSubsystemController
{

	protected $userService;
	protected $badgeService;
	protected $emailService;
	protected $competitionService;
	protected $commonUserService;
	protected $userNotificationService;

	const REDIRECT_TO_AFTER_ACTION = '/admin/users';

    public function __construct(
		UserServiceInterface $userService,
		BadgeServiceInterface $badgeService,
		EmailServiceInterface $emailService,
		CompetitionServiceInterface $competitionService,
		CommonUserServiceInterface $commonUserService,
		UserNotificationServiceInterface $userNotificationService
    )
    {

		parent::__construct('users');
		$this->userService = $userService;
		$this->badgeService = $badgeService;
		$this->emailService = $emailService;
		$this->competitionService = $competitionService;
		$this->commonUserService = $commonUserService;
		$this->userNotificationService = $userNotificationService;

    }
	
	public function main()
	{

		$this->data['users'] = $this->userService->paginate(config('custom.admin.itemsPerPage'));
		$this->data['stats'] = $this->userService->getStats();

		return view($this->viewWithPrefix('users'), $this->data);
		
    }
    
	public function edit($handle)
	{
        
		$this->data['user'] = $this->userService->getForEdit($handle);
		
		return view($this->viewWithPrefix('edit'), $this->data);
		
	}

	public function reset($id)
	{
        
		$this->commonUserService->resetUser($id);
		
		return redirect(self::REDIRECT_TO_AFTER_ACTION)->with('message', 'Action succeeded!');
		
	}	

	public function delete($id)
	{
        
		$this->userService->deleteUser($id);
		
		return redirect(self::REDIRECT_TO_AFTER_ACTION)->with('message', 'Action succeeded!');
		
	}	

	public function ban($id)
	{
        
		$this->userService->banUser($id);
		
		return redirect(self::REDIRECT_TO_AFTER_ACTION)->with('message', 'Action succeeded!');
		
	}	

	public function unBan($id)
	{
        
		$this->userService->unBanUser($id);
		
		return redirect(self::REDIRECT_TO_AFTER_ACTION)->with('message', 'Action succeeded!');
		
	}	

	public function massEmail()
	{
        
		$this->data['badges'] = $this->badgeService->all();
		$this->data['competitions'] = $this->competitionService->getForSelect();
		$this->data['users'] = $this->userService->all();

		return view($this->viewWithPrefix('mass-email'), $this->data);
		
	}	

	public function massNotifications()
	{
		
		$this->data['competitions'] = $this->competitionService->getForSelect();

		return view($this->viewWithPrefix('mass-notification'), $this->data);
		
	}	
	
    public function sendMassEmail(Request $request)
    {

        $response = $this->emailService->sendMassEmail($request->all());

		return is_string($response) ? // String means success message
				back()->withInput()->with('message', $response) :
				back()->withInput()->withErrors($response);

	}

	public function sendMassNotifications(Request $request)
    {

        $response = $this->userNotificationService->sendMassNotifications($request->all());

		return is_string($response) ? // String means success message
				back()->withInput()->with('message', $response) :
				back()->withInput()->withErrors($response);

	}
	
	public function resendVerification()
    {

		$users = $this->userService->getUnverifiedUsers();
		$response = $this->emailService->resendVerification($users);
		
		return back()->withInput()->with('message', $response);

	}	

	public function activityToday()
	{

		$this->data['usersActivity'] = $this->userService->getTodayUserActivity();
		$this->data['heading'] = 'Activity Today';

		return view($this->viewWithPrefix('activity'), $this->data);

	}

	public function activityThisWeek()
	{

		$this->data['usersActivity'] = $this->userService->getThisWeekUserActivity();
		$this->data['heading'] = 'Activity This week';
		
		return view($this->viewWithPrefix('activity'), $this->data);

	}

}