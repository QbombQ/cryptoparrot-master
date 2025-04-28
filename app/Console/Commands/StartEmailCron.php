<?php

namespace App\Console\Commands;

use App;
use Carbon\Carbon;
use App\Model\Data\Models\User;
use Illuminate\Console\Command;
use App\Model\Services\AdminSubsystem\EmailService;

class StartEmailCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'begin:retention-email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Start cron for retention email';

    private $emailService;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(){
        $this->info("Starting retention mail sender");
        $this->createServices();

        $startDate = config('custom.userRetention.startDate');

        if (!$startDate) {
            $this->warn("User retention email is not enabled.");
            return;
        }

        $users = User::join('user_notification_settings', 'users.id', '=', 'user_notification_settings.user_id')
        ->select('users.id', 'users.created_at', 'users.email', 'user_notification_settings.newsletters')
        ->where('user_notification_settings.newsletters', '=', '1')
        ->where('users.created_at', ">=", $startDate)
        ->where('users.created_at', ">=", Carbon::now()->subDay(7))
        ->get();

        foreach ($users as $user) {
            $day = $user->created_at->diffInDays(Carbon::now()) + 1;
            $this->emailService->sendRetentionEmail($user, $day);
        }
        $this->info("Finishing mail sender");
    }

    private function createServices()
    {
        $this->emailService = App::make(EmailService::class);
    }

}
