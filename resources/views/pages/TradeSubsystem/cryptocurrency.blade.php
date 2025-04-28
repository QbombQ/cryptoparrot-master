@extends('pages.TradeSubsystem.layout', 
[
    'title' => $currencyData['currencyData']['meta_title'],
    'classes' => 'h-100',
    'html_class' => '',
    'description' => $currencyData['currencyData']['meta_description'],
	  'poster' => 'assets/images/poster.jpg'
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


        <div class="wrapper">

            <div class="sidebar">
                @include('pages.TradeSubsystem.common.sidebar') 
            </div>
            <div class="main">

                <div class="shade"></div>
                
                @include('pages.TradeSubsystem.common.header') 

                <main class="main-content py-4 main-content-md py-lg-5">

                    <div class="px-4 px-lg-5">

                        <div class="row">

                            <div class="col-12 pb-3"> 

 
                                <div class="currrency-icon-inner icon-{{str_slug($currencyData['currencyData']['name'],'-')}}">
                                  <h1 class="mb-0 h3 font-weight-normal d-flex">{{$currencyData['currencyData']['name']}} 
                                  <span class="font-weight-normal small ml-3 text-muted pr-4 align-self-center">{{$currencyData['currencyData']['acronym']}}</span>


                                  @if($currencyData['currencyData']['links'] && strlen($currencyData['currencyData']['links']['technical_documentation']) > 0)
                                    <a rel="nofollow noopener"  href="{{$currencyData['currencyData']['links']['technical_documentation']}}" class="text-purple-pale font-weight-light  pl-2 ml-auto ml-xl-1 d-none d-sm-inline-block"><span class="iconify font-weight-light" data-icon="ant-design:file-done-outlined" data-inline="false"></span></a>
                                  @endif

                                  @if($currencyData['currencyData']['links'] && strlen($currencyData['currencyData']['links']['www']) > 0)
                                    <a href="{{$currencyData['currencyData']['links']['www']}}" class="d-none d-sm-inline-block text-purple-pale font-weight-light pl-2"><span class="iconify" data-icon="ant-design:link-outlined" data-inline="false"></span></a>
                                  @endif

                                   @if($currencyData['currencyData']['links'] && strlen($currencyData['currencyData']['links']['announcement']) > 0)
                                    <a rel="nofollow noopener"  href="{{$currencyData['currencyData']['links']['announcement']}}" class="d-none d-sm-inline-block text-purple-pale font-weight-light pl-2"><span class="iconify" data-icon="ant-design:notification-outlined" data-inline="false"></span></a>
                                  @endif

                                  @if($currencyData['currencyData']['links'] && strlen($currencyData['currencyData']['links']['source_code']) > 0)
                                    <a rel="nofollow noopener"  href="{{$currencyData['currencyData']['links']['source_code']}}" class="d-none d-sm-inline-block text-purple-pale font-weight-light pl-2"><span class="iconify" data-icon="ant-design:code-outlined" data-inline="false"></span></a> 
                                  @endif

                                  </h1>
                                </div>

                                <p class="d-block mb-0 text-muted pt-2">{{$currencyData['currencyData']['description']}}</p>


                            </div> 





                            <div class="col-lg-6 d-flex mb-3 mb-lg-0"> 

                              <div class="card card-small  h-100 w-100">
                                <div class="card-body p-4 w-100">

                                <div class="pb-4">

                                   <h4 class="h6 mb-0 font-weight-bold">${{$currencyData['currencyData']['usd_value']}} <span class="font-weight-light smaller @if($currencyData['pair']->getPercentChange24h() > 0) positive @else negative @endif">{{$currencyData['pair']->getPercentChange24h()}}%</span>
 
                                    <span class="ml-2 ml-lg-4 font-weight-light text-muted smaller ">Current price</span>

                                   </h4>  
                                   
                                </div>

                                

                                <div class="pb-4">

                                   <h4 class="h6 mb-0">${{number_format($currencyData['pair']->getMarketCapUSD(),0)}}
 
                                    <span class="ml-2 ml-lg-4 font-weight-light text-muted smaller ">Market Cap</span>

                                   </h4>  
                                    
                                </div>

                                <div class="pb-4">
                                   <h4 class="h6 mb-0">{{number_format($currencyData['pair']->getCirculatingSupply(),0)}} {{$currencyData['pair']->getSymbol()}}
 
                                    <span class="ml-2 ml-lg-4 font-weight-light text-muted smaller ">Circulating Supply</span>

                                   </h4>  
                                    
                                </div>

                                <div class="pb-4 border-bottom">
                                   <h4 class="h6 mb-0"> {{number_format($currencyData['pair']->getMaxSupply(),0)}} {{$currencyData['pair']->getSymbol()}}
 
                                    <span class="ml-2 ml-lg-4 font-weight-light text-muted smaller ">Max Supply</span>

                                   </h4>  
                                    
                                </div>
 
                             
                                <div class="row pt-3">
                                <div class="col-12 col-xl-6 pt-2 pr-xl-1">
                                   @if($currencyData['currencyData']['links'] && strlen($currencyData['currencyData']['links']['technical_documentation']) > 0)
                                    <a rel="nofollow noopener"  href="{{$currencyData['currencyData']['links']['technical_documentation']}}" class="d-block text-purple font-weight-light"><span class="iconify" data-icon="ant-design:file-done-outlined" data-inline="false"></span><span class="pl-1">Technical Docs</span></a>
                                  @endif
                                </div> 
                                <div class="col-12 col-xl-6 pt-2 pl-xl-1">
                                  
                                  @if($currencyData['currencyData']['links'] && strlen($currencyData['currencyData']['links']['www']) > 0)
                                    <a href="{{$currencyData['currencyData']['links']['www']}}" class="d-block text-purple font-weight-light"><span class="iconify" data-icon="ant-design:link-outlined" data-inline="false"></span>
                                      <span class="pl-1">Website</span></a>
                                  @endif

                                </div>
                                <div class="col-12 col-xl-6 pt-2 pr-xl-1">
                                  
                                   @if($currencyData['currencyData']['links'] && strlen($currencyData['currencyData']['links']['announcement']) > 0)
                                    <a rel="nofollow noopener"  href="{{$currencyData['currencyData']['links']['announcement']}}" class="d-block text-purple font-weight-light"><span class="iconify" data-icon="ant-design:notification-outlined" data-inline="false"></span> <span class="pl-1">Announcement</span></a>
                                  @endif

                                </div>
                                <div class="col-12 col-xl-6 pt-2 pl-xl-1">

                                   @if($currencyData['currencyData']['links'] && strlen($currencyData['currencyData']['links']['source_code']) > 0)
                                    <a rel="nofollow noopener"  href="{{$currencyData['currencyData']['links']['source_code']}}" class="d-block text-purple font-weight-light"><span class="iconify" data-icon="ant-design:code-outlined" data-inline="false"></span> <span class="pl-1">Source Code</span></a> 
                                  @endif

                                </div>                                
                                </div> 

                                </div>
                                </div>

                            </div>
 
                            <div class="col-lg-6 d-flex">

                              
                              <div class="card h-100 w-100 d-flex">
                              <div class="card-body text-center d-flex h-100">
                              <!-- TradingView Widget BEGIN -->
                                <!-- TradingView Widget BEGIN -->
                                <div class="align-self-center w-100">
                                
                                @if($tvConfig['pair'] !== 'THRBTC')

                                <div class="tradingview-widget-container">
                                  <div id="tradingview_dc13c"></div>
                                  <div class="tradingview-widget-copyright"><a href="https://www.tradingview.com/symbols/{{$tvConfig['exchange']}}-{{$tvConfig['pair']}}/" rel="noopener" target="_blank"><span class="blue-text">{{$tvConfig['pair']}} chart</span></a> by TradingView</div>
                                  <script type="text/javascript" src="https://s3.tradingview.com/tv.js"></script>
                                  <script type="text/javascript">
                                  new TradingView.widget(
                                  {
                                  "width" : '100%',
                                  "height" : 350,
                                  "symbol": "{{$tvConfig['exchange']}}:{{$tvConfig['pair']}}",
                                  "interval": "D",
                                  "timezone": "Etc/UTC",
                                  "theme": "Light",
                                  "style": "1",
                                  "locale": "en",
                                  "toolbar_bg": "#f1f3f6",
                                  "enable_publishing": false,
                                  "withdateranges": true,
                                  "hide_side_toolbar": true,
                                  "allow_symbol_change": false,
                                  "container_id": "tradingview_dc13c"
                                  }
                                  ); 
                                  </script> 
                                </div> 
                                <!-- TradingView Widget END -->

                                @endif
                                </div>

                                </div>
                                </div>
                           

                            </div>


                            <div class="col-lg-5">
                                
 
                                @if($currencyData['currencyData']['full_description'])
                                    <h3 class="h5 font-weight-bold mt-4 mb-3">About {{$currencyData['currencyData']['name']}}</h3> 

                                    <div class="card">
                                    <div class="card-body">

                                    <p>{!! nl2br($currencyData['currencyData']['full_description']) !!}</p>

                                    @if($currencyData['currencyData']['links'] && strlen($currencyData['currencyData']['links']['www']) > 0)

                                    <a href="{{$currencyData['currencyData']['links']['www']}}" rel="nofollow noopener" class="text-purple font-weight-bold">Visit Website</a>


                                    @endif

                                    </div>
                                    </div>

                                @endif

                                 <h5 class="mt-4 mb-3 font-weight-bold">Start trading</h5>

                                 <div class="card mt-3">
                                      <div class="card-body text-center">

                                        <p class="font-weight-medium"> 
                                                                        Recommended crypto exchange
                                                                         
                                                                    </p>

                                        <div class="row align-self-center">
                                          <div class="col-md-12 d-flex px-lg-4">
                                            <div class="align-self-center w-100 text-center py-3">
                                            <a onclick="gtag('event', 'generate_lead_ref', {'event_label' : 'binance'} );" href="/binance" Target="_Top">
                                           

                                            <svg viewBox="0 0 633.04 126.61"  style="width: 200px;" xmlns="http://www.w3.org/2000/svg"><g fill="#f3ba2f"><path d="m38.72 53.2 24.59-24.58 24.6 24.6 14.3-14.31-38.9-38.91-38.9 38.9z"/><path d="m3.64 53.19h20.23v20.23h-20.23z" transform="matrix(.70710678 -.70710678 .70710678 .70710678 -40.19 28.27)"/><path d="m38.72 73.41 24.59 24.59 24.6-24.6 14.31 14.29-.01.01-38.9 38.91-38.9-38.89-.02-.02z"/><path d="m101.64 53.19h20.23v20.23h-20.23z" transform="matrix(.70710678 -.70710678 .70710678 .70710678 -11.49 97.57)"/><path d="m77.82 63.3-14.51-14.52-10.73 10.73-1.24 1.23-2.54 2.54-.02.02.02.03 14.51 14.5 14.51-14.52.01-.01z"/><g transform="translate(.55)"><path d="m148.37 30.68h31.12q11.58 0 17.52 6a15.5 15.5 0 0 1 4.59 11.32v.19a16.67 16.67 0 0 1 -.71 5.08 15.6 15.6 0 0 1 -1.91 4 14.77 14.77 0 0 1 -2.76 3.12 17.92 17.92 0 0 1 -3.39 2.3 22.66 22.66 0 0 1 9.17 6q3.34 3.8 3.34 10.5v.19a17.44 17.44 0 0 1 -1.77 8.06 15.72 15.72 0 0 1 -5.07 5.76 24.05 24.05 0 0 1 -7.95 3.45 42.7 42.7 0 0 1 -10.29 1.15h-31.89zm28 27.14a15.39 15.39 0 0 0 7.77-1.68 5.8 5.8 0 0 0 2.86-5.42v-.19a5.93 5.93 0 0 0 -2.49-5.13q-2.49-1.77-7.19-1.77h-14.56v14.19zm3.93 27.05a14.2 14.2 0 0 0 7.7-1.77 6.08 6.08 0 0 0 2.78-5.52v-.19a6.31 6.31 0 0 0 -2.59-5.32q-2.58-2-8.34-2h-17.09v14.8z"/><path d="m223.88 30.68h14.77v67.14h-14.77z"/><path d="m261 30.68h13.62l31.48 41.32v-41.32h14.58v67.14h-12.57l-32.51-42.68v42.68h-14.6z"/><path d="m365.4 30.2h13.6l28.77 67.62h-15.42l-6.14-15.06h-28.39l-6.14 15.06h-15.06zm15.54 39.52-8.94-21.78-8.9 21.78z"/><path d="m423.74 30.68h13.62l31.46 41.32v-41.32h14.58v67.14h-12.57l-32.51-42.68v42.68h-14.58z"/><path d="m536.56 99a34.93 34.93 0 0 1 -13.72-2.68 33.17 33.17 0 0 1 -18.13-18.32 35.54 35.54 0 0 1 -2.59-13.53v-.19a34.84 34.84 0 0 1 9.79-24.51 33.23 33.23 0 0 1 11-7.48 35.9 35.9 0 0 1 14.19-2.73 44.49 44.49 0 0 1 8.58.77 35.66 35.66 0 0 1 7.06 2.11 30.5 30.5 0 0 1 5.85 3.26 39.52 39.52 0 0 1 5 4.22l-9.39 10.84a35.71 35.71 0 0 0 -8-5.57 20.47 20.47 0 0 0 -9.16-2 18.58 18.58 0 0 0 -14 6.14 21.09 21.09 0 0 0 -4.04 6.67 22.87 22.87 0 0 0 -1.43 8.11v.19a23.21 23.21 0 0 0 1.43 8.1 21.32 21.32 0 0 0 4 6.71 18.46 18.46 0 0 0 14 6.24 20.52 20.52 0 0 0 9.73-2.11 37.62 37.62 0 0 0 7.91-5.76l9.4 9.5a47.93 47.93 0 0 1 -5.37 5 32 32 0 0 1 -6.09 3.79 31.56 31.56 0 0 1 -7.24 2.39 43.11 43.11 0 0 1 -8.78.84z"/><path d="m581.47 30.68h50.53v13.14h-36v13.62h31.7v13.14h-31.65v14.1h36.45v13.14h-51z"/></g></g></svg>


                                            </a>
                                            </div>
                                          </div>
                                          <div class="col-md-12">
                                            
                                            <p>Buy & sell Crypto in minutes. Join the world's largest crypto exchange</p>

                                            <a onclick="gtag('event', 'generate_lead_ref', {'event_label' : 'binance'} );" href="/binance" Target="_Top" class="btn btn-primary btn-sm">Learn more</a> 

                                        
                                          </div>  
                                        </div>
                                      </div>
                                    </div>

 

                                  @if(count($otherCurrencies) > 1)

                                  <h5 class="mt-4 mb-3 font-weight-bold">Learn about other assets</h5>

                                  <div class="">
                                  <table id="table-cryptocurrencies" class="table table-no-wrap table-currencies">
                                    
                                      <tbody>
                                      
                                          @foreach($otherCurrencies as $key => $currency) 
                                          <tr>
                                            <td scope="row"><span class="td-inner d-flex">
                                                
                                                <div class="align-self-center w-100">

                                                  <div class="mx-auto currency-icon currency-icon-{{str_slug($currency['currencyData']['name'],'-')}}">
                                                  </div>

                                                </div>

                                            </span></td>
                                            <td scope="row"><span class="td-inner d-flex">
                                                  <span class="align-self-center">
                                                  <a class="font-weight-bold" href="/app/cryptocurrencies/{{$currency['currencyData']['acronym']}}">{{$currency['currencyData']['name']}}</a>
                                                  </span> 
                                            </span></td>
                                            <td scope="row"><span class="td-inner d-flex">
                                                 <span class="align-self-center">
                                                         ${{$currency['currencyData']['usd_value']}}  
                                                  </span>
                                            </span></td>
                                          
                                       
                                            <td scope="row"><span class="td-inner d-flex">
                                                  <span class="align-self-center">
                                                   <a class="d-block p-2" href="/app/cryptocurrencies/{{$currency['currencyData']['acronym']}}"><span class="iconify" data-icon="ant-design:arrow-right-outlined" data-inline="false"></span></a> 
                                                  </span>
                                            </span></td>
                                          </tr> 
                                          @endforeach

                              
                                      </tbody>
                                    </table> 
                                  </div>
                                  @endif
 


                            

                            </div>  
 
                            <div class="col-lg-7 pb-5 pb-lg-0">
                                

                                <h5 class="mt-4 mb-3 font-weight-bold">Recent {{$currencyData['currencyData']['name']}} trades on Crypto Parrot</h5>

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

                </main>
            </div>

        </div>

  

    @endsection


@endsection

@section('footer-scripts')
     @parent
@endsection
