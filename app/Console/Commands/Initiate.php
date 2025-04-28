<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Symfony\Component\Process\Process;

use App;

class Initiate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'initiate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generates services';

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

        $portfolioService = App::make(App\Model\Contracts\Interfaces\Services\AdminSubsystem\PortfolioServiceInterface::class);
        $portfolioService->createForAll();

        $tradePairService = App::make(App\Model\Contracts\Interfaces\Services\TradeSubsystem\TradePairServiceInterface::class);
        $tradePairService->updateLimits();

    }

}