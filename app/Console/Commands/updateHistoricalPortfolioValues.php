<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use Log;

class updateHistoricalPortfolioValues extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'portfolio:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return mixed
     */
    public function handle()
    {

        $userService =  \App::make('App\Model\Contracts\Interfaces\Services\Common\UserServiceInterface');
        $historicalPortfolioValueRepository =  \App::make('App\Model\Contracts\Interfaces\Data\HistoricalPortfolioValueRepositoryInterface');
        $historicalFormatter =  \App::make('App\Model\Contracts\Interfaces\Formatters\Common\HistoricalFormatterInterface');
 
        $date = Carbon::now()->toDateString();
        $users = $userService->all(); 

        \Log::error('Started:'.count($users));
        $this->info('USER COUNT:'.count($users)); 
  
        foreach($users as $key => $user)
        {

            try {

                if(!$historicalPortfolioValueRepository->exists($user->id, $date))
                {

                    $sum = 0;

                    foreach($user->mainPortfolio->balances as $balance)
                    {

                        $currency = $balance->currency;
                        $usdValue = $currency->average_usd_value * $balance->amount;

                        if($usdValue < 0) $usdValue = 0;

                        $sum += $usdValue;

                    } 

                    $this->info('Count:'. $key .' UserID:'.$user->id .' SUM:'.$sum); 

                    $userEarnPlayDollars = $user->userEarnPlayDollars;
                    $userRewards = $user->userRewards;
                    $userExchanges = $user->exchanges;
            
                    if(!$userRewards->isEmpty())
                    {
            
                        foreach($userRewards as $reward)
                        {
            
                            $sum += $reward->price_earned;
            
                        }
            
                    }

                    if(!$userRewards->isEmpty())
                    {
            
                        foreach($userExchanges as $exchange)
                        {
            
                            $sum += $exchange->amount;
            
                        }
            
                    }
            
                    if(!$userEarnPlayDollars->isEmpty())
                    {
            
                        foreach($userEarnPlayDollars as $earnedDollar)
                        {
            
                            $sum -= $earnedDollar->price_paid;
            
                        }
            
                    }

                    $historicalPortfolioValueRepository->create($historicalFormatter->prepareDataForCreation($user->id, $sum));      
                
                }else{

                     $this->error('Count:'. $key .' UserID:'.$user->id .' - Exist'); 

                }

            }catch(\Exception $e)
            {
 
                
                $this->error('historical error'); 
                $this->error($e); 

            } 

        }   

        \Log::error('Finished updating portfolios - Last key'.$key);  


    }
} 
