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
                                   

                                  <span class="ml-auto text-success font-weight-bold"> ${{$currencyData['currencyData']['usd_value']}} </span>


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

                    

                            </div> 


                            <div class="col-12">


                           

                              <ul class="nav nav-tabs border-bottom-0 mb-3 border-top pt-3" id="myTab" role="tablist">
                                <li class="" role="presentation">
                                  <a class="lead font-weight-medium link pr-3 active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Stats</a>
                                </li>
                                <li class="" role="presentation">
                                  <a class="lead font-weight-medium link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Latest Trades</a>
                                </li>
                               
                              </ul>


                              <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                  


                                  @if($tvConfig['pair'] !== 'THRBTC')

                                <div class="tradingview-widget-container">
                                  <div id="tradingview_dc13c"></div>
                                  <div class="tradingview-widget-copyright"><a href="https://www.tradingview.com/symbols/{{$tvConfig['exchange']}}-{{$tvConfig['pair']}}/" rel="noopener" target="_blank"><span class="blue-text">{{$tvConfig['pair']}} chart</span></a> by TradingView</div>
                                  <script type="text/javascript" src="https://s3.tradingview.com/tv.js"></script>
                                  <script type="text/javascript">
                                  new TradingView.widget(
                                  {
                                  "width" : '100%',
                                  "height" : 550,
                                  "symbol": "{{$tvConfig['exchange']}}:{{$tvConfig['pair']}}",
                                  "interval": "H",
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

                                  <h5 class="mt-4 mb-3 font-weight-bold">Profile</h5>

                                   {!! $currencyData['currencyData']['asset_description'] !!}




                                </div>
                                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                  
                                  <div class="row ">
                                    <div class="col-12">
                                      <div class="border-top"></div>
                                    </div>
                                  <div class="col-lg-7 pb-5 pb-lg-0">
                                

                                      <h5 class="mt-4 mb-3 font-weight-bold">From the feed</h5>

                                      @php
                                          $socket = false;
                                      @endphp
                              

                                        @forelse($newestLongDescriptionTrades['data'] as $trade)

                                          @include('pages.TradeSubsystem.common.trade')

                                        @empty

                                        <div class="card">
                                        <div class="card-body text-center">
                                          No recent trades
                                        </div>
                                        </div>
                                      


                                        @endforelse

                                      

                             
                                  </div>
                                  <div class="col-lg-5 pb-5 pb-lg-0">

                                    <h5 class="mt-4 mb-3 font-weight-bold">Start trading</h5>

                                 <div class="card">
                                    <div class="card-body">
                                      
                                          <div class="align-self-center w-100 mb-3">
                                          <a onclick="gtag('event', 'generate_lead_ref', {'event_label' : 'etoro'} );" href="/etoro" Target="_Top">
                                          <img style="max-width: 150px"  src="https://1mr3lc1zt3xi1fzits1il485-wpengine.netdna-ssl.com/wp-content/uploads/2017/10/logo.svg" class="w-100">
                                          </a>
                                          </div>
                                   
                                      
                                  
                                          <p>Trade and invest in cryptocurrencies, stocks, ETFs, currencies, indices and commodities or copy leading investors on eToro's disruptive trading platform.</p>

                                          <a onclick="gtag('event', 'generate_lead_ref', {'event_label' : 'etoro'} );" href="/etoro" Target="_Top" class="text-purple font-weight-bold"> Visit Website</a> 

                                    </div>
                                  </div>
                                  <p class="mb-2  small pt-1 text-right"> <a href="" data-target="#etoroDisclaimer" data-toggle="modal" class="text-muted">Disclaimer</a> </p>


                                  </div>
                                  </div>

                                </div>
                    
                              </div>

                               

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
