<?php

namespace App\Mail;

use App\Model\Data\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserRetention extends Mailable
{
    use Queueable, SerializesModels;

    private $day;
    private $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, $day)
    {
        $this->day = $day;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): UserRetention
    {
        $mailDays = [
            1 => [
                'subject' => 'Placing your first trade',
                'view' => 'emails.FrontSubsystem.userRetentionDay1',
            ],
            2 => [
                'subject' => 'Using rewards system',
                'view' => 'emails.FrontSubsystem.userRetentionDay2',
            ],
            3 => [
                'subject' => 'Managing multiple portfolios',
                'view' => 'emails.FrontSubsystem.userRetentionDay3',
            ],
            4 => [
                'subject' => 'Placing your first leverage trade',
                'view' => 'emails.FrontSubsystem.userRetentionDay4',
            ],
            5 => [
                'subject' => 'Useful information',
                'view' => 'emails.FrontSubsystem.userRetentionDay5',
            ],
            6 => [
                'subject' => 'Participating in a competition',
                'view' => 'emails.FrontSubsystem.userRetentionDay6',
            ],
            7 => [
                'subject' => 'Leaderboard explained',
                'view' => 'emails.FrontSubsystem.userRetentionDay7',
            ],
        ];

        $mailDay = $mailDays[$this->day];

        return $this->subject($mailDay['subject'])
            ->markdown($mailDay['view'])
            ->with([
                'username' => $this->user->username,
                'url' => url('/') . '/unsubscribe-newsletter/' . strtr(base64_encode($this->user->email), '+/=', '._-')
            ]);
    }
}
