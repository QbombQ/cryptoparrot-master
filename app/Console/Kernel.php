<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Artisan;
use App;
use Carbon\Carbon;
use Cache;
use Log;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {

        $schedule->call(function () {
            $competitionService = App::make('App\Model\Contracts\Interfaces\Services\TradeSubsystem\CompetitionServiceInterface');
            $competitionService->startCompetitions();
            $competitionService->endCompetitions();
        })->everyMinute();


        $schedule->call(function () {
            $competitionService = App::make('App\Model\Contracts\Interfaces\Services\TradeSubsystem\CompetitionServiceInterface');
            $competitionService->updateCompetitionParticipants();
        })->hourly();

        $schedule->command('begin:retention-email')->dailyAt('11:00');
        
        $schedule->command('session:gc')->everyMinute();
        $schedule->command('portfolio:update')->hourly(); 

        $schedule->call(function () {
            $cryptoCurrencyService = App::make('App\Model\Contracts\Interfaces\Services\TradeSubsystem\CryptoCurrencyServiceInterface');
            $cryptoCurrencyService->updateGraphData('3h', 56);
        })->everyTenMinutes();

        $schedule->call(function () {
            $conversationService = App::make('App\Model\Contracts\Interfaces\Services\Common\ConversationServiceInterface');
            $conversationService->deleteEmptyConversations();
        })->everyMinute();

        $schedule->call(function() {
            $notificationService = App::make('App\Model\Contracts\Interfaces\Services\Common\NotificationServiceInterface');
            $notificationService->notifyUsersAboutUnreadNotifications();
        })->cron('0 */6 * * *');

        $schedule->call(function() {
            Cache::put('today-users', [], Carbon::now()->addHours(24)); 
        })->daily();
        $schedule->call(function() {
            Cache::put('this-week-users', [], Carbon::now()->addHours(288)); 
        })->weekly();


        $schedule->call(function() {
            $userService = App::make('App\Model\Contracts\Interfaces\Services\TradeSubsystem\UserServiceInterface');
            $userService->giveEarlyAdopterBadgesForNewUsers();
        })->hourly();

        /*$schedule->call(function () {
            $userService = App::make(App\Model\Contracts\Interfaces\Services\AdminSubsystem\UserServiceInterface::class);
            $userService->followRandomUsers();
        })->dailyAt('11:00');*/


        $schedule->call(function () {
            $TradePairService = App::make('App\Model\Contracts\Interfaces\Services\TradeSubsystem\TradePairServiceInterface');
            $TradePairService->getWeeklyChangeForEachPair();
        })->hourly(); 

    }
 
    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
