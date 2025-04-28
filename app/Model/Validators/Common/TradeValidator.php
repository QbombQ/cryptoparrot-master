<?php 

namespace App\Model\Validators\Common;

use App\Model\Contracts\Interfaces\Validators\Common\TradeValidatorInterface;
use App\Model\Data\Models\Currency;
use Illuminate\Support\Facades\Validator;
use App\Rules\EnoughFundsForTrade;
use App\Rules\MinimumTradeValue;
use App\Rules\LeveragePairHasDollar;
use App\Rules\ValidTradingView;
use App\Rules\HigherThanFee;
use App\Rules\LowerThanFee;
use App\Rules\LeverageMoreThanZero;
use App\Rules\LimitNotExceeded;

class TradeValidator implements TradeValidatorInterface
{

    protected $validator;

	public function validateCreation($data)
	{
        
        $amount = isset($data['amount']) ? $data['amount'] : null;
        $leverage = isset($data['leverage']) ? $data['leverage'] : null;
        $price = isset($data['price']) ? $data['price'] : null;
        $type = isset($data['type']) ? $data['type'] : null;
        $market = isset($data['market']) ? $data['market'] : null;
        $stop = isset($data['stop']) ? $data['stop'] : null;
        $total = isset($data['total']) ? $data['total'] : null;
        $tradePairId = isset($data['trade_pair_id']) ? $data['trade_pair_id'] : null;

        $sourceType = isset($data['source_type']) ? $data['source_type'] : null;
        $belowLimit = isset($data['below_limit']) ? $data['below_limit'] : null;
        $aboveLimit = isset($data['above_limit']) ? $data['above_limit'] : null;
        $portfolioId = isset($data['portfolio_id']) ? $data['portfolio_id'] : null;

        if($type !== null && $leverage !== null && $tradePairId !== null)
        {

            if($leverage > 0)
            {

                $dollarCurrency = Currency::orderBy('id', 'asc')->first();
                $currency = $dollarCurrency->id;
                $type = $type == 'sell' ? 'short' : 'long';

            } else {

                $tradePairRepository = \App::make('App\Model\Contracts\Interfaces\Data\TradePairRepositoryInterface');
                $tradePair = $tradePairRepository->get($tradePairId);

                if($type == 'sell')
                {

                    $currency = $tradePair->from_currency_id;

                } else if($type == 'buy')
                {

                    $currency = $tradePair->to_currency_id;

                }  

            }      

        } else {

            return false;

        }
        
		$v = $this->validator = Validator::make($data, [
            'leverage' => ['required','numeric','in:0,1,2,3,4,5', new LeveragePairHasDollar($tradePairId), new LeverageMoreThanZero($aboveLimit, $belowLimit)],            
            'amount' => ['required_if:market,off','sometimes','nullable','numeric','min:0.0000001'],
            'total' => 'required_if:market,on',
            'type' => 'required|in:buy,sell',
            'trade_pair_id' => 'required|exists:trade_pairs,id',
            'price' => ['required_if:market,off','sometimes','nullable','numeric','min:0.0000001', new LimitNotExceeded($tradePairId, $type, $amount, $market, $total, $leverage), new EnoughFundsForTrade($amount, $type, $currency, $market, $total, $tradePairId, $portfolioId), new MinimumTradeValue($amount, $type, $currency, $market, $total, $tradePairId)],
            'description' => 'required_if:public,on|sometimes|nullable|string|max:10000',
            'analysis' => 'required_if:source_type,image|nullable|file|mimetypes:image/jpeg,image/png|max:4096',
            'source_type' => 'sometimes|nullable|in:link,image,trading_view,video',
            'public' => 'required|in:on,off',
            'market' => 'required|in:on,off',
            'stop' => 'required|in:on,off',
            'total' => 'required_if:market,on|sometimes|nullable|numeric|min:0.0000001',
            'below_limit' => ['nullable','numeric','min:0.0000001'],
            'above_limit' => ['nullable','numeric','min:0.0000001'],
            'portfolio_id' => 'required|exists:portfolios,id'
        ], [
            'required_if' => 'The :attribute field is required.',            
            'description.required_if' => 'Please provide a thought or rationale behind your trade if toggled to public.',     
            'above_limit.gte' => 'Above limit must be greater than below limit'       
        ]);
        
        $v->sometimes('above_limit', 'gte:below_limit', function ($input) {
            return $input->below_limit !== null;
        });
        $v->sometimes('above_limit', new HigherThanFee($amount, $type, $currency, $market, $total, $tradePairId, $leverage, $price), function ($input) {
            return $input->above_limit !== null;
        });
        $v->sometimes('below_limit', new LowerThanFee($amount, $type, $currency, $market, $total, $tradePairId, $leverage, $price), function ($input) {
            return $input->below_limit !== null;
        });

		return !$this->validator->fails();
		
    } 

    public function validateLimit($data)
	{
        
        $amount = isset($data['amount']) ? $data['amount'] : null;
        $leverage = isset($data['leverage']) ? $data['leverage'] : null;
        $price = isset($data['price']) ? $data['price'] : null;
        $type = isset($data['type']) ? $data['type'] : null;
        $market = isset($data['market']) ? $data['market'] : null;
        $total = isset($data['total']) ? $data['total'] : null;
        $tradePairId = isset($data['trade_pair_id']) ? $data['trade_pair_id'] : null;

        if($type !== null && $leverage !== null && $tradePairId !== null)
        {

            if($leverage > 0)
            {

                $type = $type == 'sell' ? 'short' : 'long';

            }    

        } else {

            return false;

        }
        
		$this->validator = Validator::make($data, [
            'price' => [ new LimitNotExceeded($tradePairId, $type, $amount, $market, $total, $leverage) ],
        ]);

		return !$this->validator->fails();
		
    } 

    public function validateUpdate($data, $trade)
    {

        $amount = $trade->amount;
        $leverage = $trade->leverage;
        $price = $trade->target_price;
        $type = $trade->type;
        $market = $trade->market;

        if($type !== null && $leverage !== null && $trade->trade_pair_id)
        {

            if($leverage > 0)
            {

                $dollarCurrency = Currency::orderBy('id', 'asc')->first();
                $currency = $dollarCurrency->id;
                $type = $type == 'sell' ? 'short' : 'long';

            } else {

                if($type == 'sell' || $type == 'short')
                {

                    $currency = $trade->tradePair->from_currency_id;

                } else if($type == 'buy' || $type == 'long')
                {

                    $currency = $trade->tradePair->to_currency_id;

                }  

            }      

        } else {

            return false;

        }
        
		$v = $this->validator = Validator::make($data, [
            'stop_loss' => ['nullable','numeric','min:0.0000001'],
            'take_profit' => ['nullable','numeric','min:0.0000001']
        ], [
            'required_if' => 'The :attribute field is required.',
            'take_profit.gte' => 'Above limit must be greater than below limit'
        ]);
        
        // $v->sometimes('take_profit', 'gte:stop_loss', function ($input) {
        //     return $input->stop_loss !== null;
        // });
        // $v->sometimes('take_profit', new HigherThanFee($amount, $type, $currency, $market, 0, $trade->trade_pair_id, $leverage, $price), function ($input) {
        //     return $input->take_profit !== null;
        // });
        // $v->sometimes('stop_loss', new LowerThanFee($amount, $type, $currency, $market, 0, $trade->trade_pair_id, $leverage, $price), function ($input) {
        //     return $input->stop_loss !== null;
        // });

		return !$this->validator->fails();

    }

	public function validateSource($data)
	{
        
		$this->validator = Validator::make($data, [
            //'sourceLink' => 'required|url',
            'description' => 'required|string'
        ]);		

		return !$this->validator->fails();
		
    }    

    public function getErrors()
    {
        
        if(!$this->validator) return null;
        
        return $this->validator;

    }
    
}