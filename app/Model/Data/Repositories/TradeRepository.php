<?php

namespace App\Model\Data\Repositories;

use App\Model\Contracts\Interfaces\Data\TradeRepositoryInterface;
use App\Model\Data\Models\Trade;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class TradeRepository implements TradeRepositoryInterface
{

	public function getTradeStatsLast($months)
	{

		$tradesPerMonth= array();

		for ($i=$months-1; $i>=0; $i--)
		{
		
			$tradesPerMonth[] = Trade::whereMonth('created_at', date('m',strtotime('-'.$i.' month')))->count();
		
		}

		return $tradesPerMonth;

	}

    public function getTradesWithDescriptionLongerThan($length, $currencyId, $userId = null)
    {

        $tradeObject = new Trade();
        $query = $tradeObject->newQuery();

        $query->whereHas('tradePair', function($q) use($currencyId) {
            $q->where('from_currency_id', $currencyId)->orWhere('to_currency_id', $currencyId);
        })->whereRaw('LENGTH(description) > '.$length);

        $query->where(function($query) use ($userId){

            $query->where('public', '>', 0);

            if($userId !== null)
            {

                $query->orWhere('user_id', $userId);

            }

        });
        
        $query->where(function($query) use ($userId){

            $query->whereHas('author', function($query) {
                $query->where('ghosted', '<>', 1);
            });

            if($userId !== null)
            {

                $query->orWhere('user_id', $userId);            

            }

        });

        return $query->orderBy('created_at', 'desc')->paginate(20);

    }

    public function getById($id)
    {

        return Trade::find($id);

    }

    public function create($args)
    {

        $trade = new Trade;
        $trade->fill($args);
        $trade->save();

        return $trade->id;
    }

    public function update($tradeId, $args)
    {

        $trade = Trade::find($tradeId);
        $trade->fill($args);
        $trade->save();

    }    

    public function delete($tradeId)
    {

        $trade = Trade::find($tradeId);

        if($trade)
        {

            $trade->delete();

        }
        
    }

    public function getUserActiveTrades($portfolioId,$tradeType)
    {

        if(!empty($tradeType)) return Trade::where('portfolio_id', $portfolioId)->whereIn('status', ['active','open'])->where('type',$tradeType)->orderBy('created_at','desc')->get();
        else return Trade::where('portfolio_id', $portfolioId)->whereIn('status', ['active','open'])->orderBy('created_at','desc')->get();

    }

    public function getTradesHistory($portfolioId)
    {

        $tradeObject = new Trade();
        $query = $tradeObject->newQuery();
        $query->where('portfolio_id', '=', $portfolioId)
              ->where(function ($query) {
                $query->where('status', 'cancelled')
                  ->orWhere('status', 'finished')
                  ->orWhere('status', 'liquidated');
              });

        return $query->orderBy('created_at','desc')->get();

    }    

    public function getActiveTrades($tradePairId)
    {

        return Trade::where([
            ['status', '=', 'active'],
            ['trade_pair_id', '=', $tradePairId]
        ])->get();

    }

    public function getTodayTradesByPair($userId, $pair, $portfolioId)
    {

        $todayMidnight = Carbon::createFromTimestamp(strtotime('today midnight'))->toDateTimeString();
        $now = Carbon::createFromTimestamp(time())->toDateTimeString();

        return Trade::where([
            ['trade_pair_id', $pair->id],
            ['user_id', $userId],
            ['portfolio_id', $portfolioId]
        ])->whereIn('status', ['open', 'finished'])->whereBetween('updated_at', [$todayMidnight, $now])->get();     

    }

    public function getUserTradesByPairId($userId, $pairId)
    {

        return Trade::where('user_id', $userId)->where('trade_pair_id', $pairId)->get();

    }

    public function checkForFirstTrade($userId,$currency_id)
    {

        $tradeObject = new Trade();
        $query = $tradeObject->newQuery();

        return $query->count();

    }

    public function getOpenedTrades($pairId)
    {

        return Trade::where([
            ['status', '=', 'open'],
            ['trade_pair_id', '=', $pairId]
        ])->get();

    }    

    public function getUserTradesFeed($userId, $followings, $limit, $timestamp, $blackList)
    {

        $tradeObject = new Trade();
        $query = $tradeObject->newQuery();

        $query->where(function($query) use ($userId){
                $query->where('public', '=', 1);
                $query->where(DB::raw('LENGTH(description)'),'>=','10');
                $query->orWhere('user_id', $userId); 
        });

        $query->where(function($query) use ($userId){
            $query->whereHas('author', function($query) {
                $query->where('ghosted', '<>', 1);
            });
            $query->orWhere('user_id', $userId);
        });


        $query->whereNotIn('user_id', $blackList); 

        return $query->orderBy('created_at', 'desc')->paginate(config('custom.perPage.trades')); 

    }    

    public function getUserTradesPrivateFeed($userId, $followings, $limit, $timestamp, $blackList)
    {

        $tradeObject = new Trade();
        $query = $tradeObject->newQuery();
        
        $query->where('user_id', $userId);
        $query->where('created_at', '<', $timestamp);    

        if(count($followings) > 0)
        {

            $query->orWhere(function ($query) use ($followings, $blackList) {

                $query->whereIn('user_id', $followings); 
                $query->whereNotIn('user_id', $blackList);            

            });

        }  

        return $query->orderBy('created_at', 'desc')->paginate(config('custom.perPage.trades'));

    }

    public function getUserTrades($userId)
    {

        return Trade::where('user_id', $userId)->where('archived', 0)->orderBy('created_at', 'desc')->paginate(config('custom.perPage.trades'));

    }

    public function getPortfolioTrades($portfolioId) 
    { 

        $query = Trade::where('portfolio_id', $portfolioId)->where('archived', 0);

        if(isset($_GET['status']) && $_GET['status'] === 'active')
        {

            $query->where(function($q) {
                $q->where('status', 'active')->orWhere('status', 'open');
            });

        }else if(isset($_GET['status']) && $_GET['status'] === 'cancelled')
        {

            $query->where('status', 'cancelled');

        }else if(isset($_GET['status']) && $_GET['status'] === 'liquidated')
        {

            $query->where('status', 'liquidated');

        }else if(isset($_GET['status']) && $_GET['status'] === 'finished')
        {

            $query->where('status', 'finished');

        }
        
        return $query->orderBy('updated_at', 'desc')->paginate(30);

    }

    public function cancel($id)
    {

        $trade = Trade::find($id);

        if($trade)
        {

            $trade->status = 'cancelled';
            $trade->save();

        }

    }

    public function finish($id)
    {

        $trade = Trade::find($id);

        if($trade)
        {

            $trade->status = 'finished';
            $trade->save();

        }

    }    

    public function liquidate($id)
    {

        $trade = Trade::find($id);

        if($trade)
        {

            $trade->status = 'liquidated';
            $trade->save();

        }      

    }

    public function voteUp($tradeId)
    {

        $trade = Trade::find($tradeId);

        if($trade)
        {

            $trade->votes += 1;
            $trade->save();

        }       

    }

    public function voteDown($tradeId)
    {

        $trade = Trade::find($tradeId);

        if($trade)
        {

            $trade->votes -= 1;
            $trade->save();

        }

    }

    public function getTradesCountSince($criteria, $userId)
    {

        return Trade::where('user_id', $userId)->whereBetween('created_at', [$criteria, Carbon::now()->addDays(1)->toDateString()])->count();

    }

    public function getTradesCountBetween($start, $end, $userId)
    {

        return Trade::where('user_id', $userId)->whereBetween('created_at', [$start, $end])->count();

    }

    public function paginate($limit)
    {

        $tradeObject = new Trade();
        $query = $tradeObject->newQuery();  

        if(isset($_GET['visibility']))
        {

            $visibility = $_GET['visibility'];

            if($visibility != 2)
            {

                $query->where('public', $visibility);

            }

            $limit *= 1000;

        }

        if(isset($_GET['description']))
        {

            $description = $_GET['description'];

            if($description != 2)
            {

                if($description == 1)
                {

                    $query->whereNotNull('description');

                } else { 

                    $query->where(function($query){
                        $query->whereNull('description')->orWhere('description', '=', '');                                
                    });  

                }

            }

            $limit *= 1000;

        }  

        if(isset($_GET['users']))
        {

            $users = $_GET['users'];

            if($users != 0)
            {

                $query->where('user_id', $users);
                $limit *= 1000;

            }

        }          

        return $query->orderBy('id', 'desc')->paginate($limit);

    }

    public function getAllTradesCount()
    {
         return Trade::select()->count();
    }  
 
    public function getTradesForAverageProfitLossCount($userId)
    {

        $tradeObject = new Trade();
        $query = $tradeObject->newQuery();
        
        $query->where('user_id', $userId);
        $query->where(function($query){
            $query->where(function($query){
                $query->where('type', 'buy')->where('status', 'finished');
            });
            $query->orWhere(function($query){
                $query->where('type', 'long')->where('status', '!=', 'cancelled');
            });   
            $query->orWhere(function($query){
                $query->where('type', 'short')->where('status', '!=', 'cancelled');
            });                                 
        });              

        return $query->count();

    }

    public function getTradesForSitemap()
    {

        return Trade::where('public', 1)->where('follow', 1)->get();

    }

    public function getSameCurrencyTrades($authorId, $tradePairId)
    {

        $trade = new Trade;
        $query = $trade->newQuery();
        $query->where('user_id', $authorId);
        $query->where('trade_pair_id', $tradePairId);

        return $query->get();

    }

    public function archiveUserTrades($userId, $portfolioId)
    {

        Trade::where('user_id', $userId)->where('portfolio_id', $portfolioId)->update([
            'archived' => 1
        ]);

    }

    public function getFinishedOrLiquidatedTrades($userId)
    {

        $trade = new Trade;
        $query = $trade->newQuery();
        $query->where('user_id', $userId);
        $query->where(function($query) {
            $query->where(function($query) {
                $query->where('status', 'finished');
            })->orWhere(function($query) {
                $query->where('status', 'liquidated');
            }); 
        });         
        
        return $query->get()->count();

    }

}