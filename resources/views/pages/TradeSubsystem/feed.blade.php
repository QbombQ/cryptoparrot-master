@extends('pages.TradeSubsystem.layout', 
[
    'title' => 'Feed - Crypto Parrot',
    'classes' => 'h-100',
    'html_class' => '',
    'description' => '',
	'poster' => ''
])

@section('main') 

    @parent

    @section('styles')
        @parent 
 
        <link rel="stylesheet" href="{{ asset('assets/css/TradeSubsystem/feed.css') }}?v=2.0">   
        <link rel="stylesheet" href="{{ asset('assets/css/TradeSubsystem/trade.css') }}?v=1.0">   
        <script> 

            function sendUserID(user_id,ip){

                if (window.webkit) {

                    var message = {
                        user_id: user_id,
                        ip: ip,
                    };

                    window.webkit.messageHandlers.userLogin.postMessage(message);

                }

            }

            sendUserID({{Auth::id()}},"{{Request::ip()}}");

        </script>

    @endsection  

    @section('content')

        @php
            $portfolioValue = $commonUserData['portfolioValueInUsd'];
            $userId = Auth::id();
            $username = 'My';
            $intro = true;
            $balances = $userBalances;
            $portfolioValueChangeIn = $commonUserData['portfolioValueChangeIn'];
        @endphp

        @auth
           

            @if(isset($currentFilters))
            <script>var currentFilter = @json($currentFilters);</script>
            @endif

        @endauth

        <div class="wrapper">

            <div class="sidebar">
                @include('pages.TradeSubsystem.common.sidebar') 
            </div>
            <div class="main">

                <div class="shade"></div>
                
                @include('pages.TradeSubsystem.common.trade-card')  
                @include('pages.TradeSubsystem.common.header')



                <main class="main-content pt-4 pb-3 pt-sm-3 py-lg-5">




                    <div class="px-3 px-lg-5">
                    <div id="messages-col">
                    </div> 
                    <div id="messages-col-trade" class="0"></div>
                    @if (session('message'))
                        <div class="alert alert-danger mb-4">
                            {!! session('message') !!}
                        </div>
                    @endif 
                    </div>

                    <div class="">
                        <div class="row">
                            <div class="col-12">



                                <div class="px-4 px-lg-5 quick-trade-heading">
                                <h5 class="d-flex mb-0">
                                    <span class="pr-4 align-self-center">Quick Trades</span>
                                    <span class="ml-auto ml-lg-0 d-none d-sm-block">
                                    <select style="width:160px;" id="sort-quick-trades" class="select-2 d-none">
                                        <option value="best">Best Performing</option>
                                        <option value="worst">Worst Performing</option>
                                    </select>
                                    </span>
                                </h5>
                                </div>  

                                <div class="horizontal-scroll market-scroll px-4 px-lg-5 pb-3 pb-lg-5 pt-3 pt-lg-4 hide-scroll">
                                <div class="market-scroll-content"> 
                                    <div class="row flex-row flex-nowrap" id="quick-pairs">

                                        @foreach($tradePairs as $pair)
                                        <div data-change="{{$pair['change']}}" class="col-card col-card-{{$pair['symbol']}} col col-sm-6 col-md-4 col-xl-3 pr-0 pr-sm @if ($loop->last) pr-5 @endif">
                                          

                                            <div data-pair-id="{{$pair['id']}}" class="card-{{$pair['card']}} card-{{$pair['symbol']}} card card-widget p-3"> 

                                            <div class="from-currency"></div>
                                            <h6 class="m-0 p-0 text-dark font-weight-bold">


                                                <img class="pair-icon" src="/assets/images/crypto-icons/color/{{ strtolower($pair['fromCurrencyL']) }}.svg"/>

                                                @if(!$pair['is_stock'])
                                                <img class="pair-icon pair-icon-last" src="/assets/images/crypto-icons/color/{{ strtolower($pair['toCurrencyL']) }}.svg"/>
                                                @endif 

                                                @if($pair['is_stock']) 
                                                    {{$pair['symbolForStock']}} 
                                                @else 
                                                    {{$pair['symbolWithSlash']}}
                                                @endif   

                                                @if($pair['is_stock'])
                                                    <span class="stock-label">{{$pair['name']}}</span>
                                                @endif   

                                            </h6> 
                                            <p class="h2 mb-0 pct float-right {{$pair['pct_class']}}">{{$pair['change']}}%</p>  
                                            <p class="m-0 p-0 text-muted">{{$pair['toSymbol']}}<span class="pair-price-{{$pair['symbol']}}">{{ $pair['price'] }}</span></p>  

                                            </div>

{{--                                            <a href="/visit/tradeor" target="_blank" class="mt-1 py-1 d-block">--}}

{{--                                            <span class="small font-weight-bold">Trade on <svg width="20" height="20" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
{{--                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M25.2779 4.34745C22.5775 1.63682 19.087 0.196022 15.5417 0.0195743C14.9059 -0.0137522 14.2651 -0.00416506 13.6267 0.0455964C12.0226 0.174337 10.4328 0.560102 8.9308 1.21043C10.008 1.45832 11.0332 1.99177 11.8828 2.81124C11.9278 2.84685 11.9658 2.88497 12.0037 2.92309C12.1745 3.09474 12.3335 3.27324 12.4806 3.45882C14.5 5.99095 14.341 9.70434 12.0037 12.0504L9.41017 14.6538L7.45947 12.696V16.6118V21.1755L14.2769 14.3322C17.2455 11.3524 17.872 6.90309 16.1516 3.30429C16.6879 3.36615 17.217 3.46384 17.7392 3.60171C19.4879 4.05687 21.1491 4.92861 22.5679 6.21487C22.7176 6.35046 22.8622 6.48628 23.0046 6.62917C23.1731 6.79832 23.3345 6.96974 23.4887 7.14847C27.5181 11.7124 27.3567 18.7196 23.0023 23.0904C21.7138 24.3837 20.1949 25.308 18.5767 25.8654L18.5958 25.8846L18.6265 25.9106L18.6504 25.9343C19.3695 26.6228 20.2686 27.0777 21.2487 27.2516C21.2594 27.2535 21.2701 27.2553 21.2808 27.2571C22.2136 27.4139 23.1794 27.1578 23.9244 26.5728C24.3931 26.2048 24.845 25.8044 25.2757 25.3721C31.0513 19.5747 31.0513 10.1426 25.2779 4.34745Z" fill="#54DFC4"/>--}}
{{--                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M20.1975 15.0636L22.148 17.0214V8.54207L15.3283 15.3875C12.362 18.3647 11.738 22.8165 13.4561 26.4133C12.9221 26.3537 12.3929 26.256 11.8708 26.1179C10.1221 25.663 8.45857 24.7887 7.03728 23.5048C6.89242 23.3692 6.74756 23.2333 6.60521 23.0905C6.43692 22.9213 6.27319 22.7474 6.11651 22.5712C2.08959 18.0052 2.25104 10.9977 6.60293 6.62922C7.89369 5.3336 9.41254 4.40936 11.0333 3.85445L11.0119 3.83299L10.981 3.80674L10.9573 3.783C10.2383 3.09456 9.33886 2.63963 8.35669 2.46798C8.35078 2.46706 8.3451 2.46615 8.33941 2.46524C7.35474 2.29221 6.35142 2.60813 5.57028 3.23426C5.14116 3.57802 4.72682 3.94895 4.32977 4.3475C-1.44364 10.1424 -1.44364 19.5747 4.33205 25.3722C7.03 28.0803 10.5232 29.5241 14.0682 29.7001C14.7041 29.7336 15.3449 29.724 15.981 29.6715C17.5874 29.5453 19.1747 29.157 20.6769 28.5069C19.5997 28.2593 18.5745 27.7256 17.7227 26.9086C17.6799 26.8705 17.6419 26.8324 17.604 26.7943C17.433 26.6228 17.2742 26.4441 17.1271 26.2583C15.1075 23.7264 15.2665 20.013 17.6015 17.6692L20.1975 15.0636Z" fill="#0C306F"/>--}}
{{--                                            </svg> TradeOr <i class="far fa-long-arrow-right"></i></span>--}}

{{--                                            </a> --}}
 
                                        </div>
                                        @endforeach

                                    </div>
                                </div>
                                </div>

                            </div>
                        </div>
                    </div>  
                
                    <div class="main-content-container main-feed px-4 px-lg-5">
                    
                        <div class="row">
                     


                            <div class="col-xl-8 order-2 order-xl-1">

                                <div class="d-none">
                                    <h4 class="font-weight-bold mb-4">Bitcoin price bet</h4>

                                    <div class="card mb-4">
                                    <div class="card-body">

                                        <div class="row">

                                            <div class="col-6">

                                                <h5 class="font-weight-bold">Slot #1 <small class="ml-2 text-muted">10am (EST) 10 Nov, 2021</small></h5>
                                                <p>Make a guess where <img class="pair-icon pair-icon-last" style="left:0px;" src="/assets/images/crypto-icons/color/btc.svg"> Bitcoin price will be at 10am (EST) 10 Nov, 2021, closest guess takes the play dollar prize pool.</p>

                                                <div class="">
                                                    <div class="position-relative redeem-input-holder">
                                                        <a href="" class="increase-redeem"><span class="iconify" data-icon="ant-design:plus-circle-outlined" data-inline="false"></span></a>
                                                        <input id="play_dollars_sats_amount" readonly value="60000.000" name="amount" type="text" class="text-center form-control form-control-lg"  placeholder="Play dollars to redeem">
                                                        <a href="" class="decrease-redeem"><span class="iconify" data-icon="ant-design:minus-circle-outlined" data-inline="false"></span></a>
                                                    </div>
                                                </div>


                                                <button type="submit" class="btn mt-2 btn-primary btn-lg ladda-button">Place guess</button>

                                                <p class="info small text-muted mt-2 mb-0">It costs $5,000 play dollars to place a bet. CryptoParrot platform will take 10% fee for each bet.</p>


                                                <span class="pair-price-BTCUSD"></span>

                                            </div>
                                            <div class="col-6 d-flex align-items-center">

                                                <div class="align-self-center w-100">
                                                <p class="text-center"><svg width="70" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="piggy-bank" class="svg-inline--fa fa-piggy-bank text-muted" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path fill="currentColor" d="M255.1 96c0 0 138.8 .375 143.9 .75c0-.25 .125-.5 .125-.75c0-53-42.1-96-95.1-96S207.1 43 207.1 96c0 2.125 .5 4.125 .625 6.25C223.7 98.25 239.6 96 255.1 96zM559.1 224l-29.53 .0035c-8.75-20-21.6-37.73-37.35-52.48L511.1 96l-32 .0063c-29.38 0-55.38 13.53-73 34.28C399.4 129.3 391.9 128 383.1 128H255.1C178.6 128 114.2 183 99.3 256l-43.32 .0039c-14.75 0-26.5-13.51-23.5-28.76C34.74 215.7 45.36 208 56.99 208h.9998c3.25 0 6-2.75 6-5.999v-20C63.99 178.8 61.24 176 57.99 176c-28.5 0-53.89 20.38-57.51 48.63c-4.375 34.13 22.26 63.38 55.51 63.38L95.99 288c0 52.25 25.36 98.13 63.99 127.3L159.1 480c0 17.6 14.4 32 32 32H223.1c17.6 0 32-14.4 32-32l.0026-32h128l-.0033 32c0 17.6 14.4 32 32 32h32c17.6 0 32-14.4 32-32l-.0002-64.73c11.75-8.875 22.32-19.39 31.32-31.26L559.1 384C568.8 384 576 376.8 576 368v-128C576 231.2 568.8 224 559.1 224zM431.1 288c-8.75 0-16-7.25-16-16S423.2 256 431.1 256s16 7.25 16 16S440.7 288 431.1 288z"></path></svg></p>
                                                <h2 class="text-center text-success font-weight-bold">$95,000</h2>
                                                    <p class="text-center small">35 participants,<br/> last bet done by CryptoPizza.</p>
                                                </div>

                                            </div>

                                        </div>

                                    </div>
                                    </div>
                                </div>

                                @if(!$commonUserData['made_trade'])

                                <script src="https://cdn.plyr.io/3.6.7/plyr.js"></script>
                                <link rel="stylesheet" href="https://cdn.plyr.io/3.6.7/plyr.css" />

                                <h4 class="font-weight-bold mb-4">Learn how to get started</h4>

                                <div style="border-radius: 10px;overflow: hidden;" class="mb-4">
                                <video id="player" playsinline controls>
                                  <source src="/assets/placingorder.mp4" type="video/mp4" />
                                </video>
                            </div>

                                <script>
                                  const player = new Plyr('#player');
                                </script>

                                @endif  

                                <div class="mb-3 mb-sm-4 d-none d-sm-block">
                                    <a href="" class="@if(!$myFeedOn) active @endif lead font-weight-medium link pr-3" id="turn-my-feed-off">Global feed</a>
                                    <a href="" class="@if($myFeedOn) active @endif lead font-weight-medium link" id="turn-my-feed-on">My feed</a>
                                </div>

                            
                                <button id="unread-trades-button" style="display: none;" class="btn btn-secondary btn-block mb-3 btn-lg"><i class="fas fa-bell mr-2"></i> <span data-count="0" id="unread-trades-count">0</span> new <span id="unread-trades-count-trades-word">trades</span></button>
                                <div id="replacable-main-content" class="feed-wrapper"> 

                                </div>
                            </div>  

                            <div class="col-xl-4 order-1 order-xl-2 pb-4"> 


                                <div class="sticky-sidebar">
                                <div class="sidebar__inner">

                                    

                                    <div class="fixChild">

                                     @if(count($competitions) > 0)


                                        @foreach($competitions as $competition)
                                       
                                            <div class="card bg-purple card-small mb-4">
                                                <div class="">
                                                    <div class="card-body p-4">  

                                                        <p class="mb-0">
                                                        You are participating in the {{$competition['competitionTitle']}}. When making competition trades, please be sure to switch your portfolio to the  “{{$competition['competitionTitle']}} Portfolio” in order for your trades to register for that particular competition.
                                                        </p>
                                                
                                                    </div>
                                                </div> 
                                            </div>
                                    
                                        @endforeach

                                    @endif

                                    <div class="">

                                        <div class="mb-4">
                                            <a href="" class="lead font-weight-medium link pr-3 active"data-target="#sidebar-carousel" data-slide-to="0">Overview</a>
                                            <a href="" data-target="#sidebar-carousel" data-slide-to="1" class="lead font-weight-medium link">Open Positions ({{ count($activeTrades) }})</a>
                                        </div>
             
                                    
                                    </div>



                                    <div id="active-orders-card" class="">
                                    <div class="card">
                                    <div class="card-body">


                                        <div id="sidebar-carousel" class="carousel slide carousel-fade" data-interval="false" data-wrap="false">
                                          <div class="carousel-inner"> 
                                            <div class="carousel-item active">


                                                <p class="font-weight-medium"> 
                                                    @if(isset($inline)) Main Portfolio
                                                    @else {{Auth::user()->currentPortfolio->title}} Portfolio
                                                    @endif 
                                                </p>

                                                <div class="mb-4">


                                                <div >

                                                <div class="mt-3">
                                                 
                                                    <div class="row">
                                                    <div class="col-6 text-light">Holdings</div>
                                                    <div class="col-6 text-light">Amount</div>
                                                    </div>
                                                    @foreach($balances as $balance)
                                                        @include('pages.TradeSubsystem.common.portfolio')
                                                    @endforeach
                                                </div>

                                                </div>


                                                </div> 


                                            </div>
                                            <div class="carousel-item">



                                        

                                


                                                @if(count($activeBuyTrades) > 0)

                                                <h6 class="mb-3 font-weight-bold text-purple-pale">Buy Orders</h6>
                                                <ul class="list-group list-group-small list-group-flush">
                                                @foreach($activeBuyTrades as $trade)
                                                    
                                                    @include('pages.TradeSubsystem.common.active-trade')
                                             
                                                @endforeach
                                                </ul> 
                                                @endif


                                                @if(count($activeSellTrades) > 0)

                                                <h6 class="mb-3 font-weight-bold text-purple-pale @if(count($activeBuyTrades) > 0) mt-3 @endif">Sell Orders</h6>
                                                <ul class="list-group list-group-small list-group-flush">
                                                @foreach($activeSellTrades as $trade)
                                                    
                                                    @include('pages.TradeSubsystem.common.active-trade')
                                             
                                                @endforeach
                                                </ul>
                                                @endif

                                                @if(count($activeLongTrades) > 0)

                                                <h6 class="mb-3 font-weight-bold text-purple-pale @if(count($activeBuyTrades) > 0 || count($activeSellTrades) > 0) mt-3 @endif">Long Positions</h6>
                                                <ul class="list-group list-group-small list-group-flush">
                                                @foreach($activeLongTrades as $trade)
                                                    
                                                    @include('pages.TradeSubsystem.common.active-trade')
                                             
                                                @endforeach
                                                </ul>
                                                @endif

                                                @if(count($activeShortTrades) > 0)

                                                <h6 class="mb-3 font-weight-bold text-purple-pale @if(count($activeBuyTrades) > 0 || count($activeSellTrades) > 0) || count($activeLongTrades) > 0) mt-3 @endif">Short Positions</h6>
                                                <ul class="list-group list-group-small list-group-flush">
                                                @foreach($activeShortTrades as $trade)
                                                    
                                                    @include('pages.TradeSubsystem.common.active-trade')
                                             
                                                @endforeach
                                                </ul>
                                                @endif

                                                @if(count($activeTrades) == 0)
                                                <div class="text-center px-4 py-5">

                                                    <span class="iconify display-4" data-icon="ant-design:ellipsis-outline" data-inline="false"></span>
                                                
                                                    <p class="lead mb-0">No open positions</p>
                                                    <button class="btn btn-primary btn-lg new-trade mt-4">New Trade</button> 

                                                </div>
                                                @endif

                                            </div>
                                            
                                          </div>
                                       
                                        </div>
                                               
                                      
                                        
                                    </div>
                                    </div>
                                    </div>

                                    <div class="card mt-3">
                                      <div class="card-body text-center">

                                        <p class="font-weight-medium"> 
                                                                        Recommended investing tools
                                                                         
                                                                    </p>

                                        <div class="row align-self-center">
                                          <div class="col-md-12 d-flex px-lg-4">
                                            <div class="align-self-center w-100 text-center py-3">
                                            <a onclick="gtag('event', 'generate_lead_ref', {'event_label' : 'stocklytics'} );" href="https://stocklytics.com?ref=cryptoparrot" Target="_Top">

                                                <svg style="width: 200px;" viewBox="0 0 800 154" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <g clip-path="url(#clip0_5917_168394)">
                                                        <g opacity="0.16">
                                                            <path d="M74.9268 146.572C37.897 146.572 7.81836 115.352 7.81836 76.9998C7.81836 38.6476 37.897 7.42758 74.9268 7.42758C111.957 7.42758 142.1 38.6476 142.1 76.9998C142.1 115.352 111.957 146.572 74.9268 146.572ZM74.9268 21.7592C45.5628 21.7592 21.5909 46.5199 21.5909 76.9998C21.5909 107.48 45.4978 132.24 74.9268 132.24C104.356 132.24 128.263 107.48 128.263 76.9998C128.263 46.5199 104.356 21.7592 74.9268 21.7592Z" fill="#5438FF"/>
                                                        </g>
                                                        <path d="M72.31 92.2161C80.7056 92.1812 87.4842 85.1039 87.4505 76.4085C87.4168 67.7131 80.5835 60.6923 72.1879 60.7272C63.7923 60.7621 57.0136 67.8395 57.0474 76.5349C57.0811 85.2303 63.9144 92.251 72.31 92.2161Z" fill="#5438FF"/>
                                                        <path d="M75.2508 0.766541C34.7129 0.766541 1.71094 34.9471 1.71094 76.9326C1.71094 81.1043 3.59491 84.8722 6.51832 87.2944C9.1169 89.9858 12.69 91.6679 16.6528 91.6679H28.6063C36.467 91.6679 42.8985 85.0068 42.8985 76.8653C42.8985 69.1276 37.1166 62.8702 29.8406 62.1973C35.8823 42.2138 53.9425 27.6804 75.2508 27.6804C82.3969 27.6804 88.2438 21.6247 88.2438 14.2234C88.2438 6.82215 82.3969 0.766541 75.2508 0.766541Z" fill="url(#paint0_linear_5917_168394)"/>
                                                        <path d="M143.399 66.6381C140.801 63.9467 137.228 62.2646 133.265 62.2646H121.311C113.451 62.2646 107.019 68.9258 107.019 77.0672C107.019 84.8049 112.801 91.0624 120.077 91.7352C114.035 111.719 95.9751 126.252 74.6667 126.252C67.5206 126.252 61.6738 132.308 61.6738 139.709C61.6738 147.11 67.5206 153.166 74.6667 153.166C115.205 153.166 148.207 118.985 148.207 76.9999C148.207 72.761 146.323 69.0604 143.399 66.6381Z" fill="url(#paint1_linear_5917_168394)"/>
                                                        <path opacity="0.56" d="M79.6041 110.912C66.8061 112.728 54.7226 106.673 47.9014 96.3108" stroke="#5438FF" stroke-width="9.74466" stroke-linecap="round" stroke-linejoin="round"/>
                                                        <path opacity="0.56" d="M70.6382 43.2906C82.3968 41.6085 93.5707 46.5876 100.587 55.4691" stroke="#5438FF" stroke-width="9.74466" stroke-linecap="round" stroke-linejoin="round"/>
                                                    </g>
                                                    <g clip-path="url(#clip1_5917_168394)">
                                                        <path d="M228.278 112.715C206.732 112.715 191.816 103.718 190.75 84.4216C190.75 83.593 191.461 82.8827 192.289 82.8827H208.034C208.863 82.8827 209.573 83.4746 209.692 84.4216C210.994 93.4187 215.256 99.2194 228.633 99.2194C239.406 99.2194 245.325 96.0231 245.325 88.2099C245.325 69.5055 192.408 84.3033 192.408 51.393C192.408 35.873 204.483 26.1657 225.673 26.1657C244.851 26.1657 258.228 33.5054 260.833 50.9076C260.951 51.7363 260.359 52.4466 259.531 52.4466H243.786C242.839 52.4466 242.128 51.8547 242.01 50.9076C240.826 43.6863 234.789 39.7797 224.963 39.7797C216.439 39.7797 210.284 42.7392 210.284 49.6054C210.284 67.2444 263.437 52.9201 263.437 85.712C263.437 103.233 249.942 112.703 228.278 112.703V112.715Z" fill="#1D1D1D"/>
                                                        <path d="M307.594 108.098C307.594 109.045 307.002 109.874 306.174 110.111C302.859 111.176 299.071 112.005 295.519 112.005C285.22 112.005 275.394 106.796 275.394 92.9451L275.513 62.4025H269.12C268.291 62.4025 267.581 61.6922 267.581 60.8635V51.3929C267.581 50.5643 268.291 49.854 269.12 49.854H275.394L275.158 36.1216C275.158 35.2929 275.868 34.5826 276.696 34.5826H291.849C292.678 34.5826 293.388 35.2929 293.388 36.1216L293.152 49.854H306.174C307.002 49.854 307.713 50.5643 307.713 51.3929V60.8635C307.713 61.6922 307.002 62.4025 306.174 62.4025H293.033L293.152 92.4716C293.152 97.6804 295.756 99.3378 299.663 99.3378C302.267 99.3378 304.398 98.8643 306.055 98.5091C306.884 98.2723 307.594 98.8643 307.594 99.5745V108.098Z" fill="#1D1D1D"/>
                                                        <path d="M343.109 112.348C323.221 112.348 311.738 99.9179 311.738 80.5032C311.738 61.0885 323.221 48.3032 343.109 48.3032C362.997 48.3032 374.244 60.7334 374.244 80.1481C374.244 99.5628 362.997 112.348 343.109 112.348ZM343.109 100.51C351.869 100.51 356.013 94.4723 356.013 80.5032C356.013 66.5341 351.751 60.1415 342.991 60.1415C333.994 60.2598 329.85 66.8892 329.85 80.6216C329.85 94.354 334.23 100.51 343.109 100.51Z" fill="#1D1D1D"/>
                                                        <path d="M412.008 112.348C392.475 112.348 380.873 99.9179 380.873 80.5032C380.873 61.0885 392.475 48.3032 412.363 48.3032C427.871 48.3032 437.933 56.9451 439.591 69.9672C439.709 70.7959 438.999 71.5062 438.17 71.5062H424.911C423.964 71.5062 423.136 70.9142 423.017 69.9672C421.597 63.4562 417.335 60.2598 412.363 60.2598C403.366 60.3782 399.104 66.8892 399.104 80.3848C399.104 93.8804 403.484 100.391 412.363 100.51C418.282 100.628 422.662 96.6032 423.609 88.9084C423.727 87.9613 424.438 87.3694 425.385 87.3694H438.999C439.827 87.3694 440.538 88.0797 440.419 88.9084C438.88 102.522 427.752 112.348 412.008 112.348Z" fill="#1D1D1D"/>
                                                        <path d="M479.13 98.0238L471.553 84.5282L465.753 91.7495L466.108 109.27C466.108 110.099 465.398 110.809 464.569 110.809H449.653C448.824 110.809 448.114 110.099 448.114 109.27L448.942 69.3752L448.114 29.4804C448.114 28.6517 448.824 27.9414 449.653 27.9414H464.569C465.398 27.9414 466.108 28.6517 466.108 29.4804L465.398 69.0201L465.516 72.6899L482.918 51.026C483.51 50.3157 484.457 49.8421 485.404 49.8421H501.859C502.451 49.8421 502.806 50.5524 502.333 51.026L483.865 71.7429L505.648 109.507C505.884 110.099 505.529 110.809 504.819 110.809H487.298C486.351 110.809 485.523 110.217 485.049 109.388L479.13 98.0238Z" fill="#1D1D1D"/>
                                                        <path d="M512.395 110.809C511.566 110.809 510.856 110.099 510.856 109.27L511.685 69.3752L510.856 29.4804C510.856 28.6517 511.566 27.9414 512.395 27.9414H527.311C528.14 27.9414 528.85 28.6517 528.85 29.4804L528.021 69.3752L528.85 109.27C528.85 110.099 528.14 110.809 527.311 110.809H512.395Z" fill="#1D1D1D"/>
                                                        <path d="M568.983 129.525C568.746 130.354 567.917 130.946 566.97 130.946H553.119C552.409 130.946 551.817 130.236 552.054 129.525L558.328 111.413L534.06 51.2746C533.705 50.5643 534.297 49.854 535.007 49.854H551.936C552.883 49.854 553.711 50.4459 553.948 51.2746L567.088 88.9202L577.861 51.2746C578.098 50.4459 579.045 49.854 579.874 49.854H594.79C595.619 49.854 596.092 50.5643 595.855 51.2746L568.983 129.525Z" fill="#1D1D1D"/>
                                                        <path d="M639.183 108.098C639.183 109.045 638.591 109.874 637.763 110.111C634.448 111.176 630.66 112.005 627.108 112.005C616.809 112.005 606.983 106.796 606.983 92.9451L607.102 62.4025H600.709C599.88 62.4025 599.17 61.6922 599.17 60.8635V51.3929C599.17 50.5643 599.88 49.854 600.709 49.854H606.983L606.746 36.1216C606.746 35.2929 607.457 34.5826 608.285 34.5826H623.438C624.267 34.5826 624.977 35.2929 624.977 36.1216L624.741 49.854H637.763C638.591 49.854 639.302 50.5643 639.302 51.3929V60.8635C639.302 61.6922 638.591 62.4025 637.763 62.4025H624.622L624.741 92.4716C624.741 97.6804 627.345 99.3378 631.252 99.3378C633.856 99.3378 635.987 98.8643 637.644 98.5091C638.473 98.2723 639.183 98.8643 639.183 99.5745V108.098Z" fill="#1D1D1D"/>
                                                        <path d="M648.761 110.809C647.932 110.809 647.222 110.099 647.222 109.27L647.932 80.3848L647.222 51.3811C647.222 50.5524 647.932 49.8421 648.761 49.8421H664.15C664.979 49.8421 665.689 50.5524 665.689 51.3811L664.979 80.3848L665.689 109.27C665.689 110.099 664.979 110.809 664.15 110.809H648.761ZM648.997 43.923C648.169 43.923 647.458 43.2127 647.458 42.3841V29.4804C647.458 28.6517 648.169 27.9414 648.997 27.9414H663.914C664.742 27.9414 665.453 28.6517 665.453 29.4804V42.3841C665.453 43.2127 664.742 43.923 663.914 43.923H648.997Z" fill="#1D1D1D"/>
                                                        <path d="M705.583 112.348C686.05 112.348 674.448 99.9179 674.448 80.5032C674.448 61.0885 686.05 48.3032 705.938 48.3032C721.446 48.3032 731.509 56.9451 733.166 69.9672C733.284 70.7959 732.574 71.5062 731.745 71.5062H718.486C717.539 71.5062 716.711 70.9142 716.592 69.9672C715.172 63.4562 710.91 60.2598 705.938 60.2598C696.941 60.3782 692.679 66.8892 692.679 80.3848C692.679 93.8804 697.059 100.391 705.938 100.51C711.857 100.628 716.237 96.6032 717.184 88.9084C717.303 87.9613 718.013 87.3694 718.96 87.3694H732.574C733.403 87.3694 734.113 88.0797 733.995 88.9084C732.456 102.522 721.328 112.348 705.583 112.348Z" fill="#1D1D1D"/>
                                                        <path d="M770.576 112.242C753.884 112.242 740.98 105.257 740.033 91.8798C740.033 91.0511 740.744 90.3409 741.572 90.3409H755.66C756.607 90.3409 757.317 90.9328 757.435 91.8798C758.027 98.3909 762.407 101.232 770.576 101.232C777.56 101.232 781.349 98.5092 781.349 93.7739C781.349 82.1725 741.454 93.4188 741.454 67.8482C741.454 55.1813 751.635 48.4335 768.09 48.4335C784.545 48.4335 794.607 54.7078 795.91 67.1379C796.028 67.9666 795.318 68.6769 794.489 68.6769H781.112C780.165 68.6769 779.455 68.085 779.218 67.1379C778.152 62.2842 774.838 59.2063 767.853 59.2063C762.052 59.2063 758.382 61.3372 758.382 66.546C758.382 78.1475 798.277 66.3092 798.277 92.235C798.277 105.02 786.202 112.242 770.576 112.242Z" fill="#1D1D1D"/>
                                                    </g>
                                                    <defs>
                                                        <linearGradient id="paint0_linear_5917_168394" x1="44.9774" y1="0.766541" x2="44.9774" y2="91.6679" gradientUnits="userSpaceOnUse">
                                                            <stop stop-color="#2A1F6D"/>
                                                            <stop offset="0.364583" stop-color="#5438FF"/>
                                                        </linearGradient>
                                                        <linearGradient id="paint1_linear_5917_168394" x1="104.94" y1="62.2646" x2="104.94" y2="153.166" gradientUnits="userSpaceOnUse">
                                                            <stop offset="0.609375" stop-color="#5438FF"/>
                                                            <stop offset="1" stop-color="#2A1F6D"/>
                                                        </linearGradient>
                                                        <clipPath id="clip0_5917_168394">
                                                            <rect width="147.209" height="152.467" fill="white" transform="translate(1.71094 0.766541)"/>
                                                        </clipPath>
                                                        <clipPath id="clip1_5917_168394">
                                                            <rect width="607.538" height="104.78" fill="white" transform="translate(190.75 26.1657)"/>
                                                        </clipPath>
                                                    </defs>
                                                </svg>


                                            </a>
                                            </div>
                                          </div>
                                          <div class="col-md-12">
                                            
                                            <p>Stocks screener, portfolio tracking and more</p>

                                            <a onclick="gtag('event', 'generate_lead_ref', {'event_label' : 'stocklytics'} );" href="https://stocklytics.com?ref=cryptoparrot" Target="_Top" class="btn btn-primary btn-sm">Learn more</a>

                                          </div>  
                                        </div>
                                      </div>
                                    </div>



                                    </div>

                                </div>   
                                </div>     
                            </div>

                        </div>
           
                    </div>

                </main>

            </div>

        </div>
 
 
    @endsection

    @section('body-scripts')
        @parent     
        <script src="{{ asset('assets/js/plugins/sticky-sidebar/ResizeSensor.js') }}"></script>     
        <script src="{{ asset('assets/js/plugins/sticky-sidebar/sticky-sidebar.js') }}"></script> 
        <script src="{{ mix('assets/js/TradeSubsystem/feed.js') }}"></script>
        <script src="{{ mix('assets/js/TradeSubsystem/trade.js') }}"></script>
        <script src="{{ asset('assets/js/TradeSubsystem/guide.js') }}"></script> 
    @endsection    


@endsection