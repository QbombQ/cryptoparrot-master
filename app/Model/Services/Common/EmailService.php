<?php 

namespace App\Model\Services\Common;
use App\Mail\UserRegistered;
use App\Mail\PasswordRecovery;
use App\Mail\UserContacted;
use App\Mail\UserShared;
use App\Mail\TradeCompleted;
use App\Mail\CompetitionWon;
use App\Mail\BadgeGiven;
use App\Mail\UserFollowed;
use App\Mail\UserCommentedTrade;
use App\Mail\AdministratorNotification;
use App\Mail\EarlyAdopterBadgeGiven;
use App\Mail\UnreadNotifications;
use Illuminate\Http\Request;
use Mail;
use App\Model\Contracts\Interfaces\Services\Common\EmailServiceInterface;
use App\Model\Contracts\Interfaces\Validators\Common\EmailValidatorInterface;
use App\Model\Contracts\Interfaces\Formatters\FrontSubsystem\EmailFormatterInterface;

class EmailService implements EmailServiceInterface
{

	protected $emailValidator;
	protected $emailFormatter;

	const ADMIN_EMAILS = [
        'aidas@niffler.co',
    ];

	public function __construct(EmailValidatorInterface $emailValidator,
								EmailFormatterInterface $emailFormatter) 
	{

		$this->emailValidator = $emailValidator;
		$this->emailFormatter = $emailFormatter;
		
	}		

	public function sendUserConfirmationEmail($email, $url)
	{
		
		Mail::to($email)->send(new UserRegistered($url));        
		
	}

	public function sendPasswordResetConfirmationEmail($email, $url, $username)
	{
		
		Mail::to($email)->send(new PasswordRecovery($url, $username));        
		
	}	

	public function sendEmailToAdministrator($request)
	{

		if(!$this->emailValidator->validateContactsPageForm($request->all())) return $this->emailValidator->getErrors();

		Mail::to('aidas@niffler.co')->send(new UserContacted(
			$request->fullName,
			$request->email,
			$request->message
		));

		return trans('FrontSubsystem/success-messages.success-contact-form');

	}

	public function sendNotificationAboutCompletedTrade($trade)
	{

		Mail::to($trade->author->email)->send(new TradeCompleted($trade->id, $trade->author->username));		

	}

	public function sendNotificationAboutNewFollow($following, $follower)
	{

		Mail::to($following->email)->send(new UserFollowed($following->username, $follower->username, $follower->handle));		

	}

	public function sendNotificationAboutNewTradeComment($commentAuthor, $tradeAuthor, $tradeId)
	{

		Mail::to($tradeAuthor->email)->send(new UserCommentedTrade($tradeAuthor->username, $tradeAuthor->handle, $commentAuthor->username, $tradeId));		

	}

	public function sendNotificationAboutNewBadge($email, $badge, $handle, $username)
	{

		Mail::to($email)->send(new BadgeGiven($badge,$handle,$username));	 

	}  

	public function sendNotificationAboutCompetition($email, $title)
	{

		Mail::to($email)->send(new CompetitionWon($title));	

	}	

	public function sendNotificationAboutUnreadNotifications($email, $username, $total)
	{

		Mail::to($email)->send(new UnreadNotifications($username, $total));	

	}

	public function sendEmailToAdministratorAboutEvent($type, $data)
	{

        foreach(self::ADMIN_EMAILS as $email)
        {

            Mail::to($email)->send(new AdministratorNotification($type, $data));

        }

	}
	
}