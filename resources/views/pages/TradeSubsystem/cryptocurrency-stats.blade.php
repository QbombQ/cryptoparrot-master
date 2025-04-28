@extends('pages.TradeSubsystem.layout', 
[
    'title' => $currencyData['currencyData']['seo_title'],
    'classes' => 'h-100',
    'html_class' => '',
    'description' => $currencyData['currencyData']['seo_description'],
	  'poster' => ''
])

@section('main')

    @parent

     @section('styles')
        @parent
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chartist/0.11.0/chartist.min.css">
        <link rel="stylesheet" href="{{ asset('assets/css/TradeSubsystem/feed.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/TradeSubsystem/cryptocurrencies.css') }}"> 
    @endsection  


    @section('content')

        <div class="container-fluid">
        <div class="row">

            @include('pages.TradeSubsystem.common.sidebar') 
            <main class="main-content col-xl-10 col-lg-9 col-md-9 col-sm-12 p-0 offset-xl-2 offset-lg-3 offset-md-3">

            @include('pages.TradeSubsystem.common.header') 


            <div class="main-content-container">

                <div class="container pt-4 pt-xl-5 pb-3 pb-xl-4">

                    <div class="row">

                            <div class="col-12 pb-3"> 
                                <div class="card card-currency card-transparent card-small mb-3 card-crypto-{{str_slug($currencyData['currencyData']['name'],'-')}}">
                                <div class="card-body">

                                    <div class="row">
                                        <div class="col-lg-8">
                                            <h1 class="mb-0 h3 font-weight-bold">{{$currencyData['currencyData']['name']}}</h1>
                                            <p class="d-block mb-0">{{$currencyData['currencyData']['description']}}</p>
                                            <p class="d-block mb-0">{!!$currencyData['currencyData']['asset_description']!!}</p>
                                        </div>
                                        <div class="col-lg-4 text-right d-none d-lg-block">
                                            <a href="/app" class="btn btn-primary btn-lg"><i class="fal fa-exchange mr-2"></i> Make a trade</a>
                                        </div>
                                    </div>
                                   
                                </div> 
                                </div>  
                            </div>
                            <div class="col-lg-4">
                                <div class="card card-small mb-4">
                                <div class="card-body p-4">

                                <div class="border-bottom pb-2">
                                   <h4 class="mb-0 font-weight-bold">${{$currencyData['currencyData']['usd_value']}} <small class="@if($currencyData['pair']->getPercentChange24h() > 0) positive @else negative @endif">{{$currencyData['pair']->getPercentChange24h()}}%</small></h4>
                                   <small class="d-block text-muted">Current price</small>
                                </div>

                                <div class="border-bottom pt-2 pb-2">
                                   ${{number_format($currencyData['pair']->getMarketCapUSD(),0)}}
                                   <small class="d-block text-muted">Market Cap</small>
                                </div>

                                <div class="border-bottom pt-2 pb-2">
                                   {{number_format($currencyData['pair']->getCirculatingSupply(),0)}} {{$currencyData['pair']->getSymbol()}}
                                   <small class="d-block text-muted">Circulating Supply</small>
                                </div>

                                <div class="pt-2 mb-3">
                                   {{number_format($currencyData['pair']->getMaxSupply(),0)}} {{$currencyData['pair']->getSymbol()}}
                                   <small class="d-block text-muted">Max Supply</small>
                                </div> 

                                @if($currencyData['currencyData']['links'] && strlen($currencyData['currencyData']['links']['www']) > 0)
                                    <a href="{{$currencyData['currencyData']['links']['www']}}" class="d-block external-link"><i class="far fa-link"></i> Website</a>
                                @endif
                                @if($currencyData['currencyData']['links'] && strlen($currencyData['currencyData']['links']['announcement']) > 0)
                                    <a rel="nofollow noopener"  href="{{$currencyData['currencyData']['links']['announcement']}}" class="d-block external-link"><i class="fal fa-megaphone"></i> Announcement</a>
                                @endif
                                @if($currencyData['currencyData']['links'] && strlen($currencyData['currencyData']['links']['source_code']) > 0)
                                    <a rel="nofollow noopener"  href="{{$currencyData['currencyData']['links']['source_code']}}" class="d-block external-link"><i class="far fa-code"></i> Source Code</a> 
                                @endif
                                @if($currencyData['currencyData']['links'] && strlen($currencyData['currencyData']['links']['technical_documentation']) > 0)
                                    <a rel="nofollow noopener"  href="{{$currencyData['currencyData']['links']['technical_documentation']}}" class="d-block external-link"><i class="fal fa-book"></i> Technical Documentation</a>
                                @endif

                                </div>
                                </div>

                                @if($currencyData['currencyData']['full_description'])
                                    <h3 class="h4 font-weight-bold">About {{$currencyData['currencyData']['name']}}</h3> 
                                    <p>{!! nl2br($currencyData['currencyData']['full_description']) !!}</p>

                                    @if($currencyData['currencyData']['links'] && strlen($currencyData['currencyData']['links']['www']) > 0)

                                    <a href="{{$currencyData['currencyData']['links']['www']}}" rel="nofollow noopener" class="btn btn-primary mb-4">Visit Website</a>

                                    @endif

                                @endif

                                 <h5 class="mt-4 mb-3 font-weight-bold">Start trading</h5>

                                 <div class="card">
                  <div class="card-body text-center">
                    <div class="row align-self-center">
                      <div class="col-md-12 d-flex px-lg-4">
                        <div class="align-self-center w-100 text-center py-3">
                        <a onclick="gtag('event', 'generate_lead_ref', {'event_label' : 'etoro'} );" href="/etoro" Target="_Top">
                        <img style="max-width: 150px"  src="https://1mr3lc1zt3xi1fzits1il485-wpengine.netdna-ssl.com/wp-content/uploads/2017/10/logo.svg" class="w-100">
                        </a>
                        </div>
                      </div>
                      <div class="col-md-12">
                        
                        <p>Trade and invest in cryptocurrencies, stocks, ETFs, currencies, indices and commodities or copy leading investors on eToro's disruptive trading platform.</p>

                        <a onclick="gtag('event', 'generate_lead_ref', {'event_label' : 'etoro'} );" href="/etoro" Target="_Top" class="btn btn-primary btn-sm"><img border="0" src="http://partners.etoro.com/B4658_A79102_TGet.aspx" width="1" height="1"> Learn more</a> 

                    
                      </div> 
                    </div>
                  </div>
                </div>
                 <p class="mb-2  small"> <a href="" data-target="#etoroDisclaimer" data-toggle="modal" class="text-muted">Disclaimer</a> </p>

                                 @if(count($otherCurrencies) > 1)
                                  <h5 class="mt-4 mb-3 font-weight-bold">Learn about other assets</h5>
                                  @foreach($otherCurrencies as $currency)
                                    @if($currency['currencyData']['id'] !== $currencyData['currencyData']['id'])
                                        <div class="card card-currency card-small mb-3 card-crypto-{{str_slug($currency['currencyData']['name'],'-')}}">
                                            <div class="card-body ">

                                                <div class="row">
                        
                                                    <div class="col-12 col-xl-8  align-self-center mb-2 mb-md-0">
                                                        
                                                            <h5 class="mb-0 font-weight-bold"><a href="/app/cryptocurrencies/{{$currency['currencyData']['acronym']}}">{{$currency['currencyData']['name']}}</a></h5>
                   
                                                    </div> 
                                                   
                                                    <div class="col-sm-2 col-xl-3 align-self-center text-sm-center">
                                                        <a href="/app/cryptocurrencies/{{$currency['currencyData']['acronym']}}"> <span class="d-sm-none">Learn more</span> <i class="fas fa-arrow-circle-right"></i></a> 
                                                    </div>  

                                                </div>

                                            </div>
                                        </div>
                                    @endif
                                  @endforeach
                                @endif

                            </div>  
 
                            <div class="col-lg-8">
                                <!-- TradingView Widget BEGIN -->
                                <!-- TradingView Widget BEGIN -->

                                
                                @if($tvConfig['pair'] !== 'THRBTC')

                                <div class="tradingview-widget-container">
                                  <div id="tradingview_dc13c"></div>
                                  <div class="tradingview-widget-copyright"><a href="https://www.tradingview.com/symbols/{{$tvConfig['exchange']}}-{{$tvConfig['pair']}}/" rel="noopener" target="_blank"><span class="blue-text">{{$tvConfig['pair']}} chart</span></a> by TradingView</div>
                                  <script type="text/javascript" src="https://s3.tradingview.com/tv.js"></script>
                                  <script type="text/javascript">
                                  new TradingView.widget(
                                  {
                                  "width" : '100%',
                                  "height" : 600,
                                  "symbol": "{{$tvConfig['exchange']}}:{{$tvConfig['pair']}}",
                                  "interval": "D",
                                  "timezone": "Etc/UTC",
                                  "theme": "Light",
                                  "style": "1",
                                  "locale": "en",
                                  "toolbar_bg": "#f1f3f6",
                                  "enable_publishing": false,
                                  "withdateranges": true,
                                  "hide_side_toolbar": false,
                                  "allow_symbol_change": false,
                                  "container_id": "tradingview_dc13c"
                                  }
                                  ); 
                                  </script>
                                </div> 
                                <!-- TradingView Widget END -->

                                @endif

                                <h5 class="mt-4 mb-3 font-weight-bold">Recent {{$currencyData['currencyData']['name']}} trades on Niffler.co</h5>

                                @php
                                    $socket = false;
                                @endphp
                                @if($newestLongDescriptionTrades['data'])

                                  @foreach($newestLongDescriptionTrades['data'] as $trade)

                                    @include('pages.TradeSubsystem.common.trade')

                                  @endforeach

                                @endif 

                       
                            </div>
                            <!-- TradingView Widget END -->
                           

                            <?php //print_r('<pre>'); print_r($currencyData); print_r('</pre>'); ?>

                        </div>

                	

                </div>

            </div> 

            @include('pages.TradeSubsystem.common.footer')
            </main>
        </div>
        </div>

    @endsection


@endsection

@section('footer-scripts')
     @parent
@endsection
