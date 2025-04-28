<?php

namespace App\Model\Formatters\AdminSubsystem;

use App\Model\Contracts\Interfaces\Formatters\AdminSubsystem\TradeFormatterInterface;
use App\Model\Contracts\Interfaces\Services\Common\HtmlParserServiceInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Pagination;
use Carbon\Carbon;
use Dongm2ez\Mention\Mention;
use Strings;
use Media;

class TradeFormatter implements TradeFormatterInterface
{

    private $htmlParserService;

    public function __construct(
        HtmlParserServiceInterface $htmlParserService
    )
    {

        $this->htmlParserService = $htmlParserService;

    }

    public function prepareForDisplay($trades)
    {

        $results = [
            'data' => [],
            'pagination' => ''
        ];

        if($trades instanceof LengthAwarePaginator) 
        {

            $results['pagination'] = Pagination::defaultPagination($trades);  

        }        

        if($trades->count())
        {

            foreach($trades as $trade)
            {

                $results['data'][] = [
                    'id' => $trade->id,
                    'authorUsername' => $trade->author->username,
                    'authorHandle' => $trade->author->handle,
                    'pair' => $trade->tradePair->fromCurrency->acronym.'/'.$trade->tradePair->toCurrency->acronym,
                    'type' => $trade->type,
                    'public' => $trade->public ? '<i class="fa fa-check" aria-hidden="true"></i>' : '<i class="fa fa-times" aria-hidden="true"></i>',
                    'follow' => $trade->follow ? '<i class="fa fa-check" aria-hidden="true"></i>' : '<i class="fa fa-times" aria-hidden="true"></i>',
                    'commentsCount' => $trade->comments->count(),
                    'date' => $trade->created_at->format('j M, Y'),
                ];

            }
            
        }

        return $results;          

    }

    private function getSourceData($request)
    {

        $data = [];

        if(!isset($request->analysis))
        {

            $request = Strings::extractLinkFromDescription($request);

        }

        if($request->source_type && $request->source_type === 'image')
        {

            $data = [
                'analysis_link' => Strings::sanitizeForUrl($request->analysis->getClientOriginalName()).'.jpg'
            ];

        } else if($request->source_type && $request->source_type === 'trading_view')
        {

            $code = Media::getTradingViewCode($request->trading_view);

            if($code)
            {
                
                $data = ['trading_view_code' => $code, 'trading_view_link' => $request->trading_view];

            }

        } else if($request->source_type && $request->source_type === 'video')
        {

            $data = [
                'video_link' => $request->video
            ];

        } else {

            if($request->source_type && $request->source_type == 'link')
            {

                $data = $this->htmlParserService->getSourceMetadata($request);

            }

        }

        return $data;

    }

    public function prepareForEdit($trade)
    {

        return [
            'id' => $trade->id,
            'public' => $trade->public,
            'market' => $trade->market,
            'stop' => $trade->stop,
            'amount' => $trade->amount,
            'status' => $trade->status,
            'profit' => $trade->profit,
            'archived' => $trade->archived,
            'reserved_sum' => $trade->reserved_sum,
            'portfolio' => $trade->portfolio->title,
            'below_limit' => $trade->tradeCondition ? $trade->tradeCondition->below_limit : 0,
            'above_limit' => $trade->tradeCondition ? $trade->tradeCondition->above_limit : 0,
            'fee' => $trade->tradeFee ? $trade->tradeFee->fee : 0,
            'description' => $trade->description,
            'total_trade_value' => $trade->getTotalTradeValue(),
            'source_type' => $trade->source_type,
            'type' => $trade->type,
            'target_price' => $trade->target_price,
            'start_price' => $trade->start_price,
            'leverage' => $trade->leverage,
            'votes' => $trade->votes,
            'pair' => $trade->tradePair->fromCurrency->acronym.'/'.$trade->tradePair->toCurrency->acronym,
            'follow' => $trade->follow
        ];

    }

    public function prepareDataForUpdate($request)
    {

        $data = $this->getSourceData($request);
        $mention = new Mention;
        $parsedDescription = $mention->parse(strip_tags($request->description));
        $description = $parsedDescription ? $parsedDescription : strip_tags($request->description);
        $type = $request->type;

        return [
            'source_type' => $request->source_type ? $request->source_type : null,
            'description' => $description ? $description : null,
            'source' => json_encode($data),
            'public' => $request->public && $request->public == 'on' ? 1 : 0,
            'follow' => $request->follow && $request->follow == 'on' ? 1 : 0
        ];

    }

    public function prepareTradeForSitemap($trade)
    {

        return '<url>
                    <loc>'.url('/'.$trade->author->handle.'/trade/'.$trade->id).'</loc>
                    <lastmod>'.date('c', Carbon::parse($trade->updated_at)->timestamp).'</lastmod>
                    <changefreq>daily</changefreq>
                    <priority>0.8</priority>
                </url>';

    }

}