<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Symfony\Component\Process\Process;

class CreateTradePairIds extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:pairs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $trades = \App\Model\Data\Models\Trade::all();
		$tradePairRepository = \App::make('App\Model\Contracts\Interfaces\Data\TradePairRepositoryInterface');

		foreach($trades as $trade)
		{

			$tradePair = $tradePairRepository->getByIds($trade->buying_currency_id, $trade->paying_with_currency_id);

			if(!$tradePair)
			{

				$tradePair = $tradePairRepository->getByIds($trade->paying_with_currency_id, $trade->buying_currency_id);

			}

			if(!$tradePair)
			{

				continue;

			}

			$trade->trade_pair_id = $tradePair->id;
			$trade->save();

        }
        
        echo "FINISHED";
               
    }

}
