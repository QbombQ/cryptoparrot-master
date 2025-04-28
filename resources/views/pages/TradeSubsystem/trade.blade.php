@extends('pages.TradeSubsystem.layout', 
[
    'title' => 'Post a new trade',
    'classes' => 'h-100',
    'html_class' => '',
    'description' => '',
	'poster' => ''
])
 
@section('main')

    @parent


    @section('styles')
        @parent
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intro.js/2.9.3/introjs.min.css">
        <link rel="stylesheet" href="https://unpkg.com/scroll-hint@latest/css/scroll-hint.css">
        <link rel="stylesheet" href="{{ asset('assets/css/TradeSubsystem/intro.css') }}"> 
        <link rel="stylesheet" href="{{ asset('assets/css/TradeSubsystem/trade.css') }}"> 
    @endsection  
   
  
    @section('content')

        <div class="container-fluid" id="trade-container">
        <div class="row">

            @include('pages.TradeSubsystem.common.sidebar') 
            <main class="main-content col-xl-10 col-lg-9 col-md-9 col-sm-12 p-0 offset-xl-2 offset-lg-3 offset-md-3">


            @php $page = 'trade'; @endphp
            @include('pages.TradeSubsystem.common.header') 

                <div id="success-alert" class="container-fluid px-0">
                    <div class="alert no-radius alert-success alert-dismissible fade show m-0" role="alert">
                    <span id="success-alert-text"></span>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                </div>            

            @if($commonUserData['status'] == 'unconfirmed')
                <div class="alert no-radius alert-warning alert-dismissible fade show m-0" role="alert">
                <span>Your trade won't be public unless you verify your email.</span>
                <a class="alert-link" id="resend">Re-send verification email</a>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
            @endif

            <div class="main-content-container container-fluid px-4 px-lg-4 pt-4">

            <div class="row">
                    <div class="col col-xl-8 col-md-12 col-sm-12 mb-4">


                        <ul class="nav nav-tabs" id="payment-nav" role="tablist">
                          <li class="nav-item">
                            <a class="nav-link active" id="new-order-tab" data-toggle="tab" href="#new-order" role="tab" aria-controls="new-order" aria-selected="true">
                            New 
                            <span class="d-none d-sm-inline">Order</span>
                            <span class="d-sm-none"><i class="fal fa-exchange ml-1"></i></span>
                            </a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" id="active-orders-tab" data-toggle="tab" href="#active-orders" role="tab" aria-controls="my-patrons" aria-selected="false">Open <span class="d-none d-sm-inline">Orders</span></a> 
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" id="orders-history-tab" data-toggle="tab" href="#orders-history" role="tab" aria-controls="my-transactions" aria-selected="false"><span class="d-none d-sm-inline">Order</span> History</a>
                          </li>
                        </ul> 
                        <div class="tab-content" id="orders-tab">
                          <div class="tab-pane fade show active" id="new-order" role="tabpanel">


                                <div class="card card-small">
                                    <div class="card-body p-4 p-lg-5"> 

                                        @if($errors->any())
                                            <div class="mb-4">
                                                <div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
                                            @foreach ($errors->all() as $error)
                                                
                                                <div><i class="fa fa-exclamation-circle"></i> 
                                                {!! $error !!}</div>
                                                
                                            @endforeach
                                                </div>
                                            </div> 
                                        @endif 

                                        <h6 data-tooltipClass="first-step" data-scrollTo="tooltip" data-position="auto" class="m-0 mt-2 mt-lg-0 text-center text-lg-left pt-1" data-step="1" data-intro="Start by selecting what trading pair you would like. There are many to choose from. Example, for the “trading pair” BTC/USD. With BTC/USD you will buy Bitcoin with USD, or Sell Bitcoin for USD."> 
                                            Select Market:  

                                            <ul class="navbar-nav d-inline-block ">
                                                <li class="nav-item dropdown pairs">
                                                    <a data-buy-limit-left-no-format="{{ isset($currentPair) ? $currentPair['buy_limit_left'] : $currencies[0]['buy_limit_left'] }}" data-sell-limit-left-no-format="{{ isset($currentPair) ? $currentPair['sell_limit_left'] : $currencies[0]['sell_limit_left'] }}" data-rate="{{ isset($currentPair) ? $currentPair['rateNoFormat'] : $currencies[0]['rateNoFormat'] }}" data-pair-id="{{ isset($currentPair) ? $currentPair['pairId'] : $currencies[0]['pairId'] }}" data-buy-limit-percent="{{ isset($currentPair) ? $currentPair['buy_limit_percent'] : $currencies[0]['buy_limit_percent'] }}" data-sell-limit-percent="{{ isset($currentPair) ? $currentPair['sell_limit_percent'] : $currencies[0]['sell_limit_percent'] }}" data-buy-limit-left="{{ isset($currentPair) ? $currentPair['buy_limit_left_formatted'] : $currencies[0]['buy_limit_left_formatted'] }}" data-sell-limit-left="{{ isset($currentPair) ? $currentPair['sell_limit_left_formatted'] : $currencies[0]['sell_limit_left_formatted'] }}" data-buy-volume-limit="{{ isset($currentPair) ? $currentPair['buy_volume_limit_formatted'] : $currencies[0]['buy_volume_limit_formatted'] }}" data-sell-volume-limit="{{ isset($currentPair) ? $currentPair['sell_volume_limit_formatted'] : $currencies[0]['sell_volume_limit_formatted'] }}" class="relative nav-link nav-link-icon text-center px-3 py-0" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                     
                                                        <div class="nav-link-icon__wrapper">
                                                            <i class="far fa-clone"></i> 
                                                            <span style="position: relative;top:-3px;margin-left: 10px;">
                                                                <span class="buy-acronym">
                                                                {{ isset($currentPair) ? $currentPair['buy_acronym'] : 'BTC' }}
                                                                </span> / 
                                                                <span class="sell-acronym">
                                                                {{ isset($currentPair) ? $currentPair['sell_acronym'] : 'USD' }}
                                                                </span> 
                                                                <span data-toggle="tooltip" data-placement="top" title="" data-original-title="Example, for the “trading pair” BTC/USD. With BTC/USD you can buy Bitcoin with USD, or Sell Bitcoin for USD."  style="top: 0;right: -12px;" class="beacon"></span></span> 
                                                        </div> 

                                                    </a>  
                                                    <div id="pair-dropdown" style="right: auto;left: 0px;min-width: 100px;" class="dropdown-menu dropdown-menu-small" aria-labelledby="dropdownMenuLink">
                                                        @foreach($currencies as $cryptoCurrency) 
                                                            <a class="dropdown-item" data-buy-limit-left-no-format="{{ isset($currentPair) ? $currentPair['buy_limit_left'] : $currencies[0]['buy_limit_left'] }}" data-sell-limit-left-no-format="{{ isset($currentPair) ? $currentPair['sell_limit_left'] : $currencies[0]['sell_limit_left'] }}" data-rate="{{$cryptoCurrency['rateNoFormat']}}" data-pair-id="{{$cryptoCurrency['pairId']}}" data-buy-limit-percent="{{$cryptoCurrency['buy_limit_percent']}}" data-sell-limit-percent="{{$cryptoCurrency['sell_limit_percent']}}" data-buy-limit-left="{{$cryptoCurrency['buy_limit_left_formatted']}}" data-sell-limit-left="{{$cryptoCurrency['sell_limit_left_formatted']}}" data-buy-volume-limit="{{$cryptoCurrency['buy_volume_limit_formatted']}}" data-sell-volume-limit="{{$cryptoCurrency['sell_volume_limit_formatted']}}" data-symbol="{{$cryptoCurrency['symbol']}}" data-buy-acronym="{{$cryptoCurrency['buy_acronym']}}" data-sell-acronym="{{$cryptoCurrency['sell_acronym']}}" data-buy="{{$cryptoCurrency['buy_id']}}" data-sell="{{$cryptoCurrency['sell_id']}}" href="#">
                                                                {{ $cryptoCurrency['buy_acronym']}} / {{$cryptoCurrency['sell_acronym'] }}
                                                            </a>
                                                        @endforeach
                                                    </div>
                                                </li>
                                            </ul>   

                                            <span class="d-block mb-4 mb-lg-0  mt-2 mt-lg-0 d-lg-inline-block float-lg-right current-price">1 <span class="buy-acronym">{{ isset($currentPair) ? $currentPair['buy_acronym'] : $currencies[0]['buy_acronym'] }}</span> = <span class="text-success symbol">{{ isset($currentPair) ? $currentPair['symbol'] : '$' }}</span><span id="market-rate" class="text-success rate">{{ isset($currentPair) ? $currentPair['rate'] : $currencies[0]['rate'] }}</span> <i class="far fa-copy"></i></span>
                                        </h6>
 
                                <form id="tradeForm" action="/app/trade" method="post" enctype="multipart/form-data">
                                
                                <input type="hidden" name="trade_pair_id" value="{{ isset($currentPair) ? $currentPair['id'] : 1 }}">
                                @csrf  
                                <div class="row pt-3">

                                    <div class="col-lg-5">

                                         <div class="mb-4"> 

                                            @php
                                                if(old('type') != 'sell') {
                                                    $currentLimitLeft =  isset($currentPair) ? 
                                                                            $currentPair['buy_limit_left_formatted'] : 
                                                                            $currencies[0]['buy_limit_left_formatted'];
                                                    $currentLimit = isset($currentPair) ? 
                                                                        $currentPair['buy_volume_limit_formatted'] :
                                                                        $currencies[0]['buy_volume_limit_formatted'];
                                                    $currentPercent = isset($currentPair) ? 
                                                                        $currentPair['buy_limit_percent'] :
                                                                        $currencies[0]['buy_limit_percent'];
                                                }else{
                                                    $currentLimitLeft =  isset($currentPair) ? 
                                                                            $currentPair['sell_limit_left_formatted'] : 
                                                                            $currencies[0]['sell_limit_left_formatted'];
                                                    $currentLimit = isset($currentPair) ? 
                                                                        $currentPair['sell_volume_limit_formatted'] :
                                                                        $currencies[0]['sell_volume_limit_formatted'];
                                                    $currentPercent = isset($currentPair) ? 
                                                                        $currentPair['sell_limit_percent'] :
                                                                        $currencies[0]['sell_limit_percent'];                                                                                                                                                    
                                                }
                                                
                                            @endphp

                                            <small><span class="left-limit font-weight-bold">
                                                ${{ $currentLimitLeft }}
                                            </span> left of <span class="action-limit font-weight-bold">
                                                ${{ $currentLimit }}
                                            </span> daily liquidity limit 

                                            <a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="In order to simulate real market conditions trading pairs have a daily liquidity limit. That limit changes daily and is based on the 24h trading volume of that particular asset."><i class="ml-2 far fa-question-circle"></i></a> 

                                            </small>
                                            <div class="progress">
                                              <div class="progress-bar" id="limit-progress" role="progressbar" style="width: {{$currentPercent}}%" aria-valuenow="{{$currentPercent}}" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            

                                        </div>

                                        <div data-step="2" data-intro="For your first trade, select &Prime;Buy&Prime; as you have nothing to sell yet." class="btn-group d-flex btn-group-toggle" data-toggle="buttons">
                                        <label class="btn btn-lg w-50 btn-dark @if(old('type') != 'sell') active @endif">
                                            <input type="radio" name="type" value="buy" autocomplete="off" @if(old('type') != 'sell') checked @endif> Buy
                                        </label>
                                        <label class="btn btn-lg w-50 btn-dark @if(old('type') == 'sell') active @endif">
                                            <input type="radio" name="type" value="sell" autocomplete="off" @if(old('type') == 'sell') checked @endif> Sell
                                        </label>
                                        </div>  

                                        @php
                                            $stop = old('market') == 'off' && old('stop') == 'on' ? 'on' : 'off';
                                        @endphp
                                        <input type="hidden" name="stop" value="{{$stop}}" autocomplete="off">
                                        <input name="market" type="hidden" value="on"> 

                                        <div data-step="3" data-intro="Limit allows to set your preferred price at which order will be executed once market price reaches your set price. Market means that order will be executed at current market price. For this demo click on MARKET and press next." class="btn-group d-flex btn-group-toggle mt-3" data-toggle="buttons">
                                        
                                        <label id="marketType" class="btn btn-sm w-50 btn-order-option @if((old('market') != 'off' && old('stop') == 'off')  || !old('market')) active @endif ">
                                            <input type="radio" name="market" value="on" autocomplete="off" @if((old('market') != 'off' && old('stop') == 'off') || !old('market')) checked @endif > Market 
                                        </label> 
                                                                               
                                        <label id="limitType" class="btn btn-sm w-50 btn-order-option  @if(old('market') == 'off' && old('stop') == 'off') active @endif "> 
                                            <input type="radio" name="market" value="off" autocomplete="on"  @if(old('market') == 'off' && old('stop') == 'off') checked @endif> Limit 
                                        </label>

                                        <label id="stopType" class="btn stopType btn-sm w-50 btn-order-option  @if(old('market') == 'off' && old('stop') == 'on') active @endif ">
                                            <input type="radio" name="market" value="off" autocomplete="off"  @if(old('market') == 'off' && old('stop') == 'on') checked @endif > Stop 
                                        </label>  

                                        </div> 

                                        <div class="" data-step="4" data-intro="If you selected MARKET then enter the amount in USD that you want to spend on BTC.">

                                        <div class="group-market ">

                                        <div class="input-group input-label-group input-group-lg mt-3">
                                        <div class="input-group-prepend">
                                                <span class="input-group-text" id="market-field-label">
                                                    Total:
                                                </span>
                                            </div>
                                        <input type="text" autocomplete="off" class="form-control text-right numbers-input"  name="total" value="{{ old('total') }}" placeholder="0.00" aria-label="Amount" aria-describedby="inputGroup-sizing-sm">
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="inputGroup-sizing-lg"><span id="market-field-acronym" class="sell-acronym">{{ isset($currentPair) ? $currentPair['sell_acronym'] : 'USD' }}</span> 


                                            <a id="market-tooltip" href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Amount of {{ isset($currentPair) ? $currentPair['sell_acronym'] : 'USD' }}</span> to be spent to buy {{ isset($currentPair) ? $currentPair['buy_acronym'] : $currencies[0]['buy_acronym'] }} at market price"><i class="ml-2 far fa-question-circle"></i></a> 

                                            </span> 
                                        </div>
                                        
                                        </div>
                                        <small class="mb-0 limit-exceeded-warning">Limit exceeded</small>

                                        </div>
                                        <div class="group-limit d-none">

                                        <div class="input-group input-label-group input-group-lg mt-3">
                                        <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-lg">
                                                    Amount:
                                                </span>
                                            </div>
                                        <input type="text" autocomplete="off" class="form-control text-right numbers-input"  name="amount" value="{{ old('amount') }}" placeholder="0.00" aria-label="Amount" aria-describedby="inputGroup-sizing-sm">
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="inputGroup-sizing-lg"><span class="buy-acronym">{{ isset($currentPair) ? $currentPair['buy_acronym'] : $currencies[0]['buy_acronym'] }}</span> 

                                            <a id="limit-amount-tooltip" href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Amount of {{ isset($currentPair) ? $currentPair['buy_acronym'] : $currencies[0]['buy_acronym'] }} to buy"><i class="ml-2 far fa-question-circle"></i></a>


                                            </span>
                                        </div>
                                        </div>
                                   
                                        <div class="input-group input-label-group input-group-lg mt-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-lg">
                                                    Price:
                                                </span>
                                            </div>
                                            <input autocomplete="off" value="@if( old('price')){{old('price')}}@elseif(isset($currentPair['rate'])){{ $currentPair['rate'] }}@else{{ $currencies[0]['rate'] }}@endif"  name="price"  type="text" class="form-control text-right numbers-input" placeholder="0.00" aria-label="Price" aria-describedby="inputGroup-sizing-sm"> 
                                            <div class="input-group-append">
                                            <span class="input-group-text" id="inputGroup-sizing-lg"><span class="sell-acronym">{{ isset($currentPair) ? $currentPair['sell_acronym'] : 'USD' }}</span> 

                                            <a id="limit-price-tooltip" href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Buy at fixed price per {{ isset($currentPair) ? $currentPair['buy_acronym'] : $currencies[0]['buy_acronym'] }}">
                                                <i class="ml-2 far fa-question-circle"></i> 
                                            </a> 

                                            </span>  
                                            </div>
                                        </div>
                                        <small class="mb-0 limit-exceeded-warning">Limit exceeded</small>
                                    
                                        </div>
                                        </div>

                                        <h6 class="mt-3" id="calculations"><span id="currentField">Total</span> (<span class="sell-acronym">{{ isset($currentPair) ? $currentPair['sell_acronym'] : 'USD' }}</span>) ≈
 <span class="font-weight-bold" id="estimated-total">$0.00</span>
                                        </h6>
  
                                        <!-- {{ isset($currentPair) ? $currentPair['sell_acronym'] : $currencies[0]['sell_acronym'] }} -->
                                        <!-- {{ isset($currentPair) ? $currentPair['sell_acronym'] : 'USD' }} -->


                                        <div class="form-row">
                                        <label for="advanceToggle" class="col-8 col-form-label"> Advanced
                                            <small class="form-text text-muted"> Try leverage trading. Leveraging involves borrowing a fixed amount of money from the exchange.</small> 
                                        </label>                                        
                                        <div class="col d-flex">
                                            <div class="custom-control custom-toggle ml-auto my-auto">
                                            <input type="checkbox" id="advanceToggle" @if(old('leverage') && old('leverage') !== 0) checked @endif class="custom-control-input">
                                            <label class="custom-control-label" for="advanceToggle"></label>
                                            </div>
                                        </div>
                                        <?php if(old('leverage')) $leverage = old('leverage'); else $leverage = 0; ?>
                                        <input type="hidden" name="leverage" value="{{$leverage}}"/>

                                        <div @if($leverage == 0) style="display: none;" @endif id="leverage-options" class="col-12">
                                            <div class="btn-group d-flex w-100 btn-group-toggle mt-3" data-toggle="buttons">
                                                <label class="btn w-20 btn-dark px-0 @if($leverage == 0) active @endif">
                                                    <input type="radio" name="leverage" @if($leverage == 0) selected @endif value="0"  autocomplete="off">
                                                    <small class="d-block">None</small>
                                                </label>  
                                                <label class="btn w-20 btn-dark px-0 @if($leverage == 1) active @endif">
                                                    <input type="radio" name="leverage" @if($leverage == 1) selected @endif value="1"  autocomplete="off"> 
                                                    <small class="d-block">1x</small>
                                                </label>
                                                <label class="btn w-20 btn-dark px-0 @if($leverage == 2) active @endif">
                                                    <input type="radio" name="leverage" @if($leverage == 2) selected @endif value="2"  autocomplete="off"> 
                                                    <small class="d-block">2x</small>
                                                </label>
                                                <label class="btn w-20 btn-dark px-0 @if($leverage == 3) active @endif">
                                                    <input type="radio" name="leverage" @if($leverage == 3) selected @endif value="3"  autocomplete="off"> 
                                                    <small class="d-block">3x</small>
                                                </label>
                                                <label class="btn w-20 btn-dark px-0 @if($leverage == 4) active @endif">
                                                    <input type="radio" name="leverage" @if($leverage == 4) selected @endif value="4"  autocomplete="off"> 
                                                    <small class="d-block">4x</small>
                                                </label>
                                                <label class="btn  w-20 btn-dark px-0 @if($leverage == 5)  active @endif">
                                                    <input type="radio" name="leverage" @if($leverage == 5) selected @endif value="5"  autocomplete="off"> 
                                                    <small class="d-block">5x</small>
                                                </label>                      
                                            </div>

                                            <div class="row">
                                                
                                            
                                                <div class="col-12">

                                                    <small class="text-danger">Exchange Fee = 0.25% x leverage</small>

                                                    <h6 class="mb-0 mt-4">Conditional close<h6>

                                                    <div class="input-group input-label-group input-group-lg mt-3">
                                                        <div class="input-group-prepend">
                                                            <span id="below_limit" class="input-group-text">
                                                                Stop loss:
                                                            </span>
                                                        </div>  
                                                        <input autocomplete="off" value="{{ old('below_limit') }}" name="below_limit"  type="text" class="form-control text-right numbers-input" placeholder="0.00"> 
                                                        <div class="input-group-append">
                                                        <span class="input-group-text">
                                                        <a id="below_limit_tooltip" href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Enter the {{ isset($currentPair) ? $currentPair['buy_acronym'] : $currencies[0]['buy_acronym'] }} price in USD at which your order will close to prevent further losses. Please ensure that price is lower than the limit or market price.">
                                                            <i class="far fa-question-circle"></i> 
                                                        </a> 
                                                        </span>  
                                                        </div>
                                                    </div>
 
                                                    <div class="input-group input-label-group input-group-lg mt-3">
                                                        <div class="input-group-prepend">
                                                            <span id="above_limit" class="input-group-text">
                                                                Take profit:
                                                            </span>
                                                        </div> 
                                                        <input autocomplete="off" name="above_limit" step="0.00001" value="{{ old('above_limit') }}"  type="text" class="form-control text-right numbers-input" placeholder="0.00"> 
                                                        <div class="input-group-append"> 
                                                        <span class="input-group-text">
                                                        <a id="above_limit_tooltip"  href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Enter the {{ isset($currentPair) ? $currentPair['buy_acronym'] : $currencies[0]['buy_acronym'] }} price in USD at which your order will close at to take profit. Please ensure that price is higher than the limit or market price.">
                                                            <i class="far fa-question-circle"></i> 
                                                        </a> 
                                                        </span>  
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                            

                                        </div>

                                        </div>


                                    </div>

                                    <div class="col-lg-7 pt-4 pt-lg-0">

                                    <div class="" id="public-fields">

                                        <div data-step="5" data-intro="Here you can add links, images, trading view screenshots and even videos to back up your trading actions rationale. Don't forget to add your &Prime;Thoughts&Prime; on why you decided to make this trade.  By doing so, others in the community can comment and either learn from you, or help advise you on future trades."> 

                                        <div class="btn-group d-flex btn-group-toggle mt-0" data-toggle="buttons">
                                        <label class="btn btn-lg w-20 btn-dark px-0">
                                            <input type="radio" name="source_type" value="link"  autocomplete="off"> 
                                            <i class="far fa-link"></i>
                                            <small class="d-block">Link</small>
                                        </label> 
                                        <label class="btn btn-lg w-25 btn-dark px-0">
                                            <input type="radio" name="source_type" value="image"  autocomplete="off"> 
                                            <i class="far fa-image"></i> 
                                            <small class="d-block">Image</small>
                                        </label>
                                        <label class="btn btn-lg w-30 btn-dark px-0 trading-view-tab">
                                            <input type="radio" name="source_type" value="trading_view"  autocomplete="off"> 
                                            <img class="icon-tv" style="width: 25px;" src="{{ asset('assets/images/trading-view.svg') }}">
                                            <img class="icon-tv-white" style="width: 25px;" src="{{ asset('assets/images/trading-view-white.svg') }}">
                                            <small class="d-block">Trading View</small>
                                        </label>
                                        <label class="btn btn-lg w-25 btn-dark px-0">
                                            <input type="radio" name="source_type" value="video"  autocomplete="off"> 
                                            <i class="fab fa-youtube"></i>
                                            <small class="d-block">Video</small>
                                        </label>
                                        </div>  
 
                                        <div style="position: relative;" class="collapse" id="public-link">

                                            <div class="link-preview mt-2">

                                                <div style="position: relative">
                                                    <div class="input-group input-group">
                                                        <input value="" name="link" type="text" class="form-control" placeholder="Enter Link" aria-label="Price" aria-describedby="inputGroup-sizing-sm"> 
                                                    </div>   
                                                </div>

                                                <div class="spinner-holder">
                                                <div id="spinner"></div>
                                                <div class="link-meta-info " style="display: none">
                                                </div>
                                                </div>

                                            </div>

                                        </div>
 
                                        <div class="collapse" id="public-image">
                                    
                                            <div class="image-upload mt-2">

                                            <div class="custom-file w-100 "><input accept="image/*" type="file" name="analysis" class="custom-file-input" id="customFile"><label class="custom-file-label" for="customFile"><i class="fal fa-cloud-upload"></i> Upload Image...</label></div>

                                            <div id="imagePreview" class="image-preview">
                                            </div>

                                            </div>  

                                          

                                        </div>

                                        <div class="collapse" id="public-tradingview">

                                            <div class="tradingview-preview mt-2">

                                            <div  class="input-group input-group ">
                                                <input id="tradingview-link" value="" name="trading_view" type="text" class="form-control" placeholder="Enter Trading View Link" aria-label="Price" aria-describedby="inputGroup-sizing-sm"> 
                                            </div>  
                                        
                                            <div class=""> 
                                            <!-- TradingView Chart BEGIN -->
                                            <script type="text/javascript" src="https://s3.tradingview.com/tv.js"></script>
                                            <div class="" id="tradingview-preview-container">
                                            </div>
                                            <!-- TradingView Chart END -->
                                            </div>

                                            </div>

                                        </div>


                                        <div class="collapse" id="public-youtube">

                                            

                                            <div class="youtube-preview mt-2">
                                            <div class="input-group input-group">
                                                <input value="" id="youtube-video" name="video" type="text" class="form-control" placeholder="Enter Video Link" aria-label="Video Link" aria-describedby="inputGroup-sizing-sm"> 
                                              
                                            </div>
                                              <small>Supported: Youtube & BitTube</small>
                                            <div style="display: none;" class="videoWrapper mt-2">
                                            </div>
                                            <div style="display: none;" class="video-error">
                                            </div>
                                            </div>

                                        </div>


                                        <div class="form-group mt-3">
                                            <label for="userBio">
                                                Thoughts 

                                                <a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="By posting your thoughts and making this trade public, the community will see your logic and can either learn from it or correct you."><i class="ml-2 far fa-question-circle"></i></a>

                                            </label> 
                                            <textarea placeholder="Let others know more about your trade..." style="min-height: 87px;" id="userBio" name="description" class="form-control">{{ old('description') }}</textarea>
                                        </div> 

                                        </div> 

                                    </div>

                                     <div data-step="7" data-intro="By making your trading action public, your trade will be visible to the community and posted to your feed page.  In some cases, you may just be experimenting with a trade and don't want anyone else to see it.  In this case, toggle off public trade.">
                                     <div class="form-row">
                                        <label for="publicToggle" class="col-8 col-form-label"> Public
                                        <small class="form-text text-muted"> Make this trade visible to the community.</small>
                                        </label>
                                        <div class="col d-flex">
                                        <div class="custom-control custom-toggle ml-auto my-auto">
                                            <input name="public" type="hidden" value="off">
                                            <input name="public" type="checkbox" @if(old('public') != 'off') checked @endif id="publicToggle" class="custom-control-input"> 
                                            <label class="custom-control-label" for="publicToggle"></label>
                                        </div>
                                        </div>
                                    </div> 
                                    </div>
                                    
 
                               
                                    <button type="submit" data-style="expand-left" id="post-trade" data-step="8" data-intro="That's it! Post your order and you're done! Congratulations on making your first trade on Niffler.co and welcome to the community!" class="btn btn-primary btn-lg mt-3">PLACE <span class="trade-type text-uppercase">Buy</span> ORDER</button>
                                

                                    </div>

                                                                       
                                    
                                </div>
                            </form>
                                    </div>
                                </div>
                          </div>
                          <div class="tab-pane fade" id="active-orders" role="tabpanel">
                                
                                <div class="card card-small">
                                    <div class="card-body p-3">
                                        <div class="table-responsive js-scrollable">
                                        <table id="active-orders-table" class="table table-striped table-no-wrap">
                                          <thead>
                                            <tr> 
                                              <th scope="col">#</th>
                                              <th scope="col">Action</th>
                                              <th scope="col">Order Type</th>
                                              <th scope="col">Pair</th>
                                              <th scope="col">Price</th>
                                              <th scope="col">Volume</th>
                                              <th scope="col">Cost</th>
                                              <th scope="col">Status</th>
                                              <th scope="col">Leverage</th>
                                              <th scope="col">Fee</th>
                                              <th scope="col">Opened</th>
                                              <th scope="col">Profit/Loss</th>
                                              <th scope="col">Stop loss</th>
                                              <th scope="col">Take profit</th>
                                              
                                            </tr>
                                          </thead>
                                          <tbody>
                                          </tbody>
                                        </table>
                                        </div>
                                    </div>
                                </div>

                          </div> 
                          <div class="tab-pane fade" id="orders-history" role="tabpanel">
                               
                                <div class="card card-small">
                                    <div class="card-body p-3">
                                        <div class="table-responsive js-scrollable">
                                            <table id="orders-history-table" class="table table-striped table-no-wrap mb-0">
                                                <thead>
                                                    <tr>
                                                    <th scope="col">#</th> 
                                                    <th scope="col">Action</th>
                                                    <th scope="col">Order Type</th>
                                                    <th scope="col">Pair</th>
                                                    <th scope="col">Price</th>
                                                    <th scope="col">Volume</th>
                                                    <th scope="col">Cost</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Leverage</th>
                                                    <th scope="col">Closed</th>
                                                    <th scope="col">Profit/Loss</th>
                                                    <th scope="col">Stop loss</th>
                                                    <th scope="col">Take profit</th>                                                     
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                          </div>
                        </div>

                

                </div> 

                <div class="col-xl-4 mb-4">
                    @php
                    $portfolioValue = $commonUserData['portfolioValueInUsd'];
                        $userId = Auth::id();
                        $username = 'My';
                        $intro = false;
                        $balances = $userBalances;
                        $portfolioValueChangeIn = $commonUserData['portfolioValueChangeIn'];
                        $doNotShowPercentChange = Auth::user()->main_portfolio_id !== Auth::user()->current_portfolio_id;
                    @endphp
                    @include('pages.TradeSubsystem.common.portfolio-card')                      
                </div>

                </div>
                </div>
                
                 @include('pages.TradeSubsystem.common.footer')     
  

            </main>
        </div>
        </div>

        
    @endsection

    @section('body-scripts')
        @parent
        <script src="https://cdnjs.cloudflare.com/ajax/libs/intro.js/2.9.3/intro.min.js"></script>    
        <script src="https://unpkg.com/scroll-hint@latest/js/scroll-hint.min.js"></script>
        <script>
            @if(Request::segment(3) && Request::segment(3) == 'intro')
                var doIntro = true;
            @else
                var doIntro = false;                                       
            @endif
        </script> 
        <script src="{{ mix('assets/js/TradeSubsystem/trade.js') }}"></script>
    @endsection    

    

@endsection