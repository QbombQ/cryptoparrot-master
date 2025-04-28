<?php

namespace App\Model\Services\AdminSubsystem;

use App\Model\Contracts\Interfaces\Services\AdminSubsystem\TradeServiceInterface;
use App\Model\Contracts\Interfaces\Services\Common\FileServiceInterface;
use App\Model\Contracts\Interfaces\Formatters\AdminSubsystem\TradeFormatterInterface;
use App\Model\Contracts\Interfaces\Validators\AdminSubsystem\TradeValidatorInterface;
use App\Model\Contracts\Interfaces\Data\TradeRepositoryInterface;
use File;
use Carbon\Carbon;

class TradeService implements TradeServiceInterface
{

    protected $tradeRepository;
    protected $tradeFormatter;
    protected $tradeValidator;
    protected $fileService;

    const RESERVED_SUM_SINCE = '2019-07-10 14:00:00';

    public function __construct(
        TradeFormatterInterface $tradeFormatter,
        TradeRepositoryInterface $tradeRepository,
        TradeValidatorInterface $tradeValidator,
        FileServiceInterface $fileService
    )
    {

        $this->tradeRepository = $tradeRepository;
        $this->tradeFormatter = $tradeFormatter;
        $this->tradeValidator = $tradeValidator;
        $this->fileService = $fileService;

    }

    public function getLastYearStats()
    {

        $data['stats'] = $this->tradeRepository->getTradeStatsLast(6);
        $first  = strtotime('first day this month');
        
        for ($i = 5; $i >= 0; $i--)
        {

            $data['labels'][] = date('F', strtotime("-$i month", $first));

        }
        
        return $data;

    }

    public function getFinishedTradesWithReservedSums()
    {

        $result = [];
        $trades = \App\Model\Data\Models\Trade::where(function($q) {
            $q->where([
                ['status', '=', 'finished']
            ])->orWhere([
                ['status', '=', 'liquidated']
            ]);
        })->where([
            ['reserved_sum', '>', 0.5]
        ])->where([
            ['created_at', '>', Carbon::parse(self::RESERVED_SUM_SINCE)]
        ])->get();

        foreach($trades as $trade)
        {

            $result[] = [
                'tradeId' => $trade->id,
                'reservedSum' => $trade->reserved_sum,
                'username' => $trade->author->username
            ];

        }

        return $result;

    }

    public function getFinishedTradesWithMoreThanOneRelease()
    {

        $result = [];
        $trades = \App\Model\Data\Models\Trade::where(function($q) {
            $q->where([
                ['status', '=', 'finished']
            ])->orWhere([
                ['status', '=', 'liquidated']
            ]);
        })->where([
            ['reserve_released', '>', 1]
        ])->where([
            ['created_at', '>', Carbon::parse(self::RESERVED_SUM_SINCE)]
        ])->get();

        foreach($trades as $trade)
        {

            $result[] = [
                'tradeId' => $trade->id,
                'reservedSum' => $trade->reserved_sum,
                'reserveReleased' => $trade->reserve_released,
                'username' => $trade->author->username
            ];

        }

        return $result;  

    }

    public function countAllTrades()
    { 

        return $this->tradeRepository->getAllTradesCount();

    }  

    public function paginate($limit)
    {

        $trades = $this->tradeRepository->paginate($limit);

        return $this->tradeFormatter->prepareForDisplay($trades);

    }

    public function getForEdit($tradeId)
    {

        $trade = $this->tradeRepository->getById($tradeId);
        
        return $this->tradeFormatter->prepareForEdit($trade);         

    }

    public function edit($request)
    {

        $data = $request->all();

        if(!$this->tradeValidator->validateUpdate($data))
        {

            return $this->tradeValidator->getErrors();

        }

        $this->tradeRepository->update(
            $data['trade_id'],
            $this->tradeFormatter->prepareDataForUpdate($request)
        );    

        $this->fileService->uploadTechnicalAnalysis($request, $data['trade_id']);

        return trans('AdminSubsystem/success-messages.trade-update-success'); 

    }

    public function generateSitemap()
    {

        $xml = '<?xml version="1.0" encoding="UTF-8"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

        try {

            $trades = $this->tradeRepository->getTradesForSitemap();

            if($trades->count() == 0)
            {
                
                return trans('AdminSubsystem/error-messages.no-trades-sitemap');

            }

            foreach($trades as $trade)
            {

                $xml .= $this->tradeFormatter->prepareTradeForSitemap($trade);

            }
            
            $xml .= '</urlset>';
            File::put(env('PATH_TO_PUBLIC') . 'public/trades_sitemap.xml', $xml);

            return trans('AdminSubsystem/success-messages.sitemap-generated'); 

        }catch(\Exception $e)
        {

            return $e->getMessage();

        }

    }

}