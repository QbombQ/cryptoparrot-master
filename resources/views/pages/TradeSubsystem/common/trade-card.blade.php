<div class="trade-modal px-2 py-5 py-lg-2">
    <div class="px-3 py-5 py-sm-4 px-sm-4">

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

        <p class="font-weight-bold lead d-flex">Make a trade <a href="" class="ml-auto h3 mb-0" id="close-trade"><span class="iconify" data-icon="ant-design:close-outlined" data-inline="false"></span></a></p>

        <div class="d-sm-flex pt-2 pb-4">
            <div class="pr-sm-5">

                <div  class="">

                    <div class="market-select">
                    <div class="from-currency"></div>
                    <h6 class="m-0 p-0 text-dark" id="current-pair-span">
                        <img class="pair-icon buy-acronym-img"
                            src="/assets/images/crypto-icons/color/{{ strtolower(isset($currentPair) ? $currentPair['buy_acronym'] : 'BTC') }}.svg">
                        <img class="pair-icon pair-icon-last sell-acronym-img"
                            src="/assets/images/crypto-icons/color/{{ strtolower(isset($currentPair) ? $currentPair['sell_acronym'] : 'USD') }}.svg">
                        <span
                            class="buy-acronym">{{ isset($currentPair) ? $currentPair['buy_acronym'] : 'BTC' }}</span>/<span
                            class="sell-acronym">{{ isset($currentPair) ? $currentPair['sell_acronym'] : 'USD' }}</span>
                        <span class="iconify" data-icon="ant-design:arrow-down-outline" data-inline="false"></span>
                    </h6>
                    </div> 
 
                    <div class="border-top-xs-only pt-2 pt-sm-0 mt-2 mt-sm-0">
                    <p id="quick-pct-change" class="market-select h2 mb-0 d-inline-block d-sm-block pr-3 pr-sm-0"><span class="">0.00%</span></p>

                    <p class="m-0 p-0 h2-sm text-muted d-inline-block d-sm-block">
                    <span id="market-rate-symbol">{{ isset($currentPair) ? $currentPair['symbol'] : ''}}</span><span id="market-rate"
                        class="pair-price-{{isset($currentPair) ? $currentPair['buy_acronym'] : ''}}{{ isset($currentPair) ? $currentPair['sell_acronym'] : ''}} rate">{{ isset($currentPair) ? $currentPair['rate'] : $currencies[0]['rate'] }}</span>
                    </p>
                    </div>

                </div>

            </div>
            <div class="ml-sm-auto">

                <div class="border-left-sm pl-sm-5 pr-sm-5 border-top-xs-only pt-2 pt-sm-0 mt-2 mt-sm-0">
                <p class="lead mb-1 d-inline-block d-sm-block pr-2">Your Balance</p>
 
                <h6 class="m-0 p-0 text-dark d-inline-block d-sm-block">
                    <img class="pair-icon quick-view-acronym" src="/assets/images/crypto-icons/color/usd.svg">
                    <span id="quick-portfolio-view" class="pl-2 font-weight-bold lead"></span>
                </h6>
                </div>

            </div>
           
        </div>

        <div id="make-trade">

            <form id="post-trade-form" method="post" action="/app/trade" enctype='multipart/form-data'>
                @csrf
                <input type="hidden" name="trade_pair_id" value="{{ isset($currentPair) ? $currentPair['id'] : 1 }}">
                <div class="">
                    <div class="">

                        @php
                        if(old('type') != 'sell') {
                        $currentLimitLeft = isset($currentPair) ?
                        $currentPair['buy_limit_left_formatted'] :
                        $currencies[0]['buy_limit_left_formatted'];
                        $currentLimit = isset($currentPair) ?
                        $currentPair['buy_volume_limit_formatted'] :
                        $currencies[0]['buy_volume_limit_formatted'];
                        $currentPercent = isset($currentPair) ?
                        $currentPair['buy_limit_percent'] :
                        $currencies[0]['buy_limit_percent'];
                        }else{
                        $currentLimitLeft = isset($currentPair) ?
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

                        <div class="">

                            <div class="btn-group d-flex btn-group-toggle" data-toggle="buttons">
                                <label
                                    class="btn btn-lg btn-order-action-type w-50 btn-secondary-light  @if(old('type') != 'sell') active @endif ">
                                    <input type="radio" name="type" value="buy" autocomplete="off" @if(old('type')
                                        !='sell' ) checked @endif> Buy
                                </label>
                                <label
                                    class="btn btn-lg btn-order-action-type w-50 btn-secondary-light @if(old('type') == 'sell') active @endif">
                                    <input type="radio" name="type" value="sell" autocomplete="off"
                                        @if(old('type')=='sell' ) checked @endif> Sell
                                </label>
                            </div>

                        </div>


                        @php
                        $stop = old('market') == 'off' && old('stop') == 'on' ? 'on' : 'off';
                        @endphp
                        <input type="hidden" name="stop" value="{{$stop}}" autocomplete="off">
                        <input name="market" type="hidden" value="on">
                        <div class="d-flex btn-group-toggle mt-3" data-toggle="buttons">

                            <label id="marketType"
                                class="btn  btn-order-option  @if((old('market') != 'off' && old('stop') == 'off')  || !old('market')) active @endif  ">
                                <input type="radio" name="market" value="on" autocomplete="off" @if((old('market')
                                    !='off' && old('stop')=='off' ) || !old('market')) checked @endif><span
                                    class="iconify" data-icon="ant-design:line-chart-outline"
                                    data-inline="false"></span> Market
                            </label>

                            <label id="limitType"
                                class="btn btn-order-option  @if(old('market') == 'off' && old('stop') == 'off') active @endif ">
                                <input type="radio" name="market" value="off" autocomplete="on" @if(old('market')=='off'
                                    && old('stop')=='off' ) checked @endif><span class="iconify"
                                    data-icon="ant-design:pause-circle-outline" data-inline="false"></span> Limit
                            </label>

                            <label id="stopType"
                                class="btn stopType btn-order-option  @if(old('market') == 'off' && old('stop') == 'on') active @endif ">
                                <input type="radio" name="market" value="off" autocomplete="off"
                                    @if(old('market')=='off' && old('stop')=='on' ) checked @endif><span class="iconify"
                                    data-icon="ant-design:stop-outline" data-inline="false"></span> Stop
                            </label>

                        </div>

                        <div class="pt-2">



                            <div class="p-3 trade-sub-block mb-4">

                                <div class="group-market">

                                    <div class="row">
                                        <div class="col-sm-6 pr-sm-1">

                                            <p class="d-none d-sm-block text-purple-pale lead font-weight-medium mb-2">
                                                <span class="market-field-label">Total</span>
                                            </p>

                                            <div class="input-group-currency mb-2 mb-sm-0">

                                                <a id="market-tooltip" href="#" data-toggle="tooltip"
                                                    data-placement="top" title=""
                                                    data-original-title="Amount of {{ isset($currentPair) ? $currentPair['sell_acronym'] : 'USD' }} </span> to be spent to buy 
                                    {{ isset($currentPair) ? $currentPair['buy_acronym'] : $currencies[0]['buy_acronym'] }} at market price">

                                                    <img id="market-field-acronym" class="pair-icon"
                                                        src="/assets/images/crypto-icons/color/{{ strtolower(isset($currentPair) ? $currentPair['sell_acronym'] : 'USD') }}.svg">

                                                </a>

                                                <input type="text" autocomplete="off" class="form-control numbers-input"
                                                    name="total" value="{{ old('total') }}" placeholder="0.00"
                                                    aria-label="Amount" aria-describedby="inputGroup-sizing-sm">

                                                <span class="market-field-label input-inner-label d-sm-none">Total</span> 

                                            </div>

                                        </div>
                                        <div class="col-sm-6 pl-sm-1" id="calculations">

                                            <p class="d-none d-sm-block text-purple-pale lead font-weight-medium mb-2">
                                                <span class="currentField">Amount</span>
                                            </p>

                                            <div class="input-group-currency">

                                                <img class="pair-icon sell-acronym-img"
                                                    src="/assets/images/crypto-icons/color/{{ strtolower( isset($currentPair) ? $currentPair['sell_acronym'] : 'USD') }}.svg">

                                                <input readonly type="text" autocomplete="off"
                                                    class="form-control numbers-input estimated-total" value="0.00"
                                                    placeholder="0.00">

                                                <span class="currentField input-inner-label d-sm-none">Amount</span> 

                                            </div>

                                        </div>
                                    </div>

                                    <small class="mb-0 limit-exceeded-warning">Limit exceeded</small>

                                </div>
                                <div class="group-limit d-none">

                                    <div class="row">
                                        <div class="col-sm-6 col-md-4 pr-sm-1">

                                            <p class="d-none d-sm-block text-purple-pale lead font-weight-medium mb-2">
                                                <span>Amount</span>
                                            </p> 

                                            <div class="input-group-currency mb-2 mb-sm-0">

                                                <a id="limit-amount-tooltip" href="#" data-toggle="tooltip"
                                                    data-placement="top" title=""
                                                    data-original-title="Amount of {{ isset($currentPair) ? $currentPair['buy_acronym'] : $currencies[0]['buy_acronym'] }} to buy">

                                                    <img class="pair-icon buy-acronym-img"
                                                        src="/assets/images/crypto-icons/color/{{ strtolower(isset($currentPair) ? $currentPair['buy_acronym'] : $currencies[0]['buy_acronym']) }}.svg">

                                                </a>

                                                <input type="text" autocomplete="off"
                                                    class="form-control numbers-input" name="amount"
                                                    value="{{ old('amount') }}" placeholder="0.00" aria-label="Amount"
                                                    aria-describedby="inputGroup-sizing-sm">

                                                <span class="input-inner-label d-sm-none">Amount</span> 

                                            </div>

                                        </div>
                                        <div class="col-sm-6 col-md-4 pr-md-1 pl-sm-1">

                                            <p class="d-none d-sm-block text-purple-pale lead font-weight-medium mb-2">
                                                <span>Price</span>
                                            </p>

                                            <div class="input-group-currency mb-2 mb-sm-0">

                                                <a id="limit-price-tooltip" href="#" data-toggle="tooltip"
                                                    data-placement="top" title=""
                                                    data-original-title="Buy at fixed price per {{ isset($currentPair) ? $currentPair['buy_acronym'] : $currencies[0]['buy_acronym'] }}">

                                                    <img class="pair-icon sell-acronym-img"
                                                        src="/assets/images/crypto-icons/color/{{ strtolower(isset($currentPair) ? $currentPair['sell_acronym'] : 'USD') }}.svg">

                                                    <span class="input-inner-label d-sm-none">Price</span> 

                                                </a>

                                                <input autocomplete="off"
                                                    value="@if( old('price')){{old('price')}}@elseif(isset($currentPair['rate'])){{ $currentPair['rate'] }}@else{{ $currencies[0]['rate'] }}@endif"
                                                    name="price" type="text"
                                                    class="form-control numbers-input" placeholder="0.00"
                                                    aria-label="Price" aria-describedby="inputGroup-sizing-sm">

                                            </div>

                                        </div>
                                        <div class="col-md-4 pr-md-1 pl-md-1">

                                            <p class="d-none d-sm-block text-purple-pale lead font-weight-medium mb-2">
                                                <span>Total</span>
                                            </p>

                                            <div class="input-group-currency">

                                                <img class="pair-icon sell-acronym-img"
                                                    src="/assets/images/crypto-icons/color/{{ strtolower( isset($currentPair) ? $currentPair['sell_acronym'] : 'USD') }}.svg">

                                                <input readonly type="text" autocomplete="off"
                                                    class="form-control numbers-input estimated-total" value="0.00"
                                                    placeholder="0.00">

                                                <span class="input-inner-label d-sm-none">Total</span> 

                                            </div>

                                        </div>
                                    </div>

                                    <small class="mb-0 limit-exceeded-warning">Limit exceeded</small>

                                </div>

                                <p class="text-purple-pale mb-0 mt-3 smaller">

                                    <span class="d-block d-sm-inline-block">
                                    <span
                                        class="current-limit-left-symbol font-weight-bold">{{ isset($currentPair) ? $currentPair['fromSymbol'] : ''}}</span><span
                                        class="left-limit font-weight-bold">{{ $currentLimitLeft }}</span>
                                    left in daily liquidity
                                   
                                    <a href="#" class=" text-purple-pale pl-1" data-toggle="tooltip" data-placement="top"
                                        title=""
                                        data-original-title="In order to simulate real market conditions trading pairs have a liquidity limit. It means volume that you can trade is limited. This limit restores daily.">
                                        <span class="iconify" data-icon="ant-design:question-circle-outline"
                                            data-inline="false"></span>
                                    </a>

                                     </span>

                                    <span class="d-block d-sm-inline-block float-sm-right mb-0 text-purple-pale">Fee: <span
                                            id="fee-calculated"></span></span>

                                </p>
                            </div>





                            <div class="@if(env('APP_FORK') != 'fxparrot') collapse @endif" id="advanced-options">

                                <?php if(old('leverage')) $leverage = old('leverage'); else $leverage = 0; ?>
                                
                                <div class="row">
                                    <div class="col-sm-4 mb-3 mb-sm-0">
                                        <p class="mb-2 pt-0 font-weight-medium">Leverage</p>

                                        <select id="leverage-select" name="leverage" class="select-2 select-2-lg">
                                        @if(env('APP_FORK') != 'fxparrot')<option value="0" @if($leverage==0) selected @endif>None</option>@endif
                                        <option value="1" @if($leverage==1) selected @endif>1X</option>
                                        <option value="2" @if($leverage==2) selected @endif>2X</option>
                                        <option value="3" @if($leverage==3) selected @endif>3X</option>
                                        <option value="4" @if($leverage==4) selected @endif>4X</option>
                                        <option value="5" @if($leverage==5) selected @endif>5X</option>
                                        </select> 

                                        
                                       

                                    </div>
                                    <div class="col-sm-8">
                                        <div class="row">
                                            <div class="col-12">
                                             <p class="mb-2 pt-0 font-weight-medium">Conditional Close</p>
                                            </div>
                                            <div class="col-sm-6 mb-2 mb-sm-0">
                                                
                                                <div class="input-group-currency">

                                                    <img class="pair-icon"
                                                        src="/assets/images/crypto-icons/color/usd.svg">

                                                    <input autocomplete="off"
                                                        value="{{ old('below_limit') }}" name="below_limit"
                                                        type="text" class="form-control numbers-input"
                                                        placeholder="0.00">

                                                    <a class="text-purple-pale input-tooltip"
                                                        id="below_limit_tooltip" href="#"
                                                        data-toggle="tooltip" data-placement="top" title=""
                                                        data-original-title="Enter the {{ isset($currentPair) ? $currentPair['buy_acronym'] : $currencies[0]['buy_acronym'] }} price in USD at which your order will close to prevent further losses. Please ensure that price is lower than the limit or market price.">
                                                        <i class="fad fa-question-circle"></i> <span id="below_limit" class="small line-height d-inline-block">
                                                        SL
                                                        </span>
                                                    </a>

                                                </div>
                                                

                                            </div>
                                            <div class="col-sm-6">
                                               

                                                <div class="input-group-currency">

                                                    <img class="pair-icon"
                                                        src="/assets/images/crypto-icons/color/usd.svg">

                                                    <input autocomplete="off" name="above_limit"
                                                        step="0.00001" value="{{ old('above_limit') }}"
                                                        type="text" class="form-control numbers-input"
                                                        placeholder="0.00">

                                                    <a class="text-purple-pale input-tooltip"
                                                        id="above_limit_tooltip" href="#"
                                                        data-toggle="tooltip" data-placement="top" title=""
                                                        data-original-title="Enter the {{ isset($currentPair) ? $currentPair['buy_acronym'] : $currencies[0]['buy_acronym'] }} price in USD at which your order will close at to take profit. Please ensure that price is higher than the limit or market price.">
                                                        <i class="fad fa-question-circle"></i>
                                                        <span id="above_limit" class="small line-height d-inline-block">
                                                        TP
                                                        </span>
                                                    </a>

                                                </div>

                                              

                                        

                                            </div>
                                             
                                        </div> 
                                    </div>
                                    <div class="col-12 mb-4 mt-2">
                                         <p class="text-purple-pale small line-height-md font-weight-medium mb-0 pt-1">
                                                    Exchange Fee = 0.25% x leverage. Leverage is required for this setting to work.
                                                </p> 
                                    </div>
                                </div>

                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-6 d-flex order-2 order-sm-1">
                                    <label for="publicToggle" class="lead align-self-center mb-0">
                                        Share On Timeline
                                    </label>

                                    <div class="custom-control custom-toggle ml-auto align-self-center">
                                        <input name="public" type="hidden" value="off">
                                        <input name="public" type="checkbox" @if(old('public') !='off' ) checked @endif
                                            id="publicToggle" class="custom-control-input">
                                        <label class="custom-control-label" for="publicToggle"></label>
                                    </div>

                                </div>
                                @if(env('APP_FORK') != 'fxparrot')
                                <div class="col-sm-6 d-flex mb-3 mb-sm-0 text-sm-right order-1 order-sm-2">
                                    <div class="align-self-center w-100">
                                        <a href="" data-toggle="collapse" data-target="#advanced-options"
                                            aria-expanded="true" class="d-block d-sm-inline-block font-weight-medium">
                                            <span class="iconify pr-1" data-icon="ant-design:arrow-down-outline"
                                                data-inline="false"></span> Advanced Options
                                        </a>
                                    </div>
                                </div>
                                @endif
                            </div>

                            <div class="clearfix">

                                <div class="trade-description-holder">

                                    <textarea placeholder="Let others know more about your trade..." name="description"
                                        class="" spellcheck="true"></textarea>

                                    <div class="trade-description-options">
                                        <a href="" data-toggle="tooltip" data-placement="top" title=""
                                            data-original-title="Click to add/upload image or photo"
                                            id="upload-image-analysis-button"
                                            class="btn-upload-photo text-purple-pale mr-1"><span class="iconify"
                                                data-icon="ant-design:picture-outline" data-inline="false"></span></a>
                                        <a href="" data-toggle="tooltip" data-placement="top" title=""
                                            data-original-title="Paste any link within the description field to attach"
                                            class="btn-upload-photo text-purple-pale mr-1"><span class="iconify"
                                                data-icon="ant-design:link-outline" data-inline="false"></span></a>
                                        <a href="" data-toggle="tooltip" data-placement="top" title=""
                                            data-original-title="Paste YouTube link within the description field to attach a video"
                                            class="btn-upload-photo text-purple-pale mr-1"><span class="iconify"
                                                data-icon="ant-design:youtube-outline" data-inline="false"></span></a>
                                        <a href="" data-toggle="tooltip" data-placement="top" title=""
                                            data-original-title="Paste TradingView link within the description field to attach a chart"
                                            class="btn-upload-photo text-purple-pale mr-1"><span class="iconify"
                                                data-icon="ant-design:line-chart-outline"
                                                data-inline="false"></span></a>
                                    </div>

                                </div>
 
                                <div class="full-preview-block">

                                    <div id="analysis-field-wrapper">
                                        <input id="analysis-field" style="position: absolute; top: -999px;" type="file"
                                            name="analysis" class="form-control" />
                                        <button class="btn btn-primary" type="button"
                                            id="delete-analysis-image">Remove</button>
                                    </div>

                                    <div class="spinner-holder">
                                        <div id="spinner"></div>
                                        <div class="link-meta-info mt-2" style="display: none"></div>
                                    </div>

                                </div>



                                <div class="row mt-3">
                                    <div class="col-6 d-flex">

                                    </div>
                                    <div class="col-lg-6">
                                        <button type="submit" data-style="expand-left" id="post-trade"
                                            class="btn btn-primary btn-lg float-right ladda-button">
                                            <span class="ladda-label">
                                                PLACE <span class="trade-type text-uppercase">buy</span> ORDER</span>
                                            <span class="ladda-spinner"></span>
                                        </button>
                                    </div>
                                </div>


                            </div>

                           

                        </div>



                    </div>
                </div>
            </form>

        </div>

        <div id="change-market" class="d-none">

            <p class="mb-4 font-weight-bold lead">Select Market</p>

            <div class="pair-search position-relative mb-4">

                <input id="filterPairs" placeholder="Search" type="text" class="form-control"
                    aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg">
                <span id="clearfilterPairs"><i class="fal fa-times"></i></span>

            </div>

            <form id="select-market" action="/app/change-market/" method="post">
                @csrf
                <div class="row portfolio-buttons mx-0">
                    @foreach($currencies as $cryptoCurrency)
                    <div class="col-xl-6 col-market px-0">
                        <label
                            class="btn btn-market @if(isset($currentPair) && $currentPair['pairId'] == $cryptoCurrency['pairId']) active @endif">

                            <input type="radio" value="" name="market" autocomplete="off" @if(isset($currentPair) &&
                                $currentPair['pairId']==$cryptoCurrency['pairId']) checked @endif
                                data-limit-symbol="{{ $cryptoCurrency['fromSymbol'] }}"
                                data-buy-limit-left-no-format="{{ isset($currentPair) ? $currentPair['buy_limit_left'] : $currencies[0]['buy_limit_left'] }}"
                                data-sell-limit-left-no-format="{{ isset($currentPair) ? $currentPair['sell_limit_left'] : $currencies[0]['sell_limit_left'] }}"
                                data-rate="{{$cryptoCurrency['rateNoFormat']}}"
                                data-trade-pair-id="{{$cryptoCurrency['id']}}"
                                data-pair-id="{{$cryptoCurrency['pairId']}}"
                                data-buy-limit-percent="{{$cryptoCurrency['buy_limit_percent']}}"
                                data-sell-limit-percent="{{$cryptoCurrency['sell_limit_percent']}}"
                                data-buy-limit-left="{{$cryptoCurrency['buy_limit_left_formatted']}}"
                                data-sell-limit-left="{{$cryptoCurrency['sell_limit_left_formatted']}}"
                                data-buy-volume-limit="{{$cryptoCurrency['buy_volume_limit_formatted']}}"
                                data-sell-volume-limit="{{$cryptoCurrency['sell_volume_limit_formatted']}}"
                                data-symbol="{{$cryptoCurrency['symbol']}}"
                                data-is-stock="{{$cryptoCurrency['is_stock']}}"
                                data-market-status="{{$cryptoCurrency['market_status']}}"
                                data-buy-acronym="{{$cryptoCurrency['buy_acronym']}}"
                                data-sell-acronym="{{$cryptoCurrency['sell_acronym']}}">

                            <div class="market-button-text-wrapper">

                                <div class="market-info">

                                    <span class="iconify" data-icon="ant-design:check-circle-fill"
                                        data-inline="false"></span>
                                    <img
                                        src="/assets/images/crypto-icons/color/{{ strtolower($cryptoCurrency['buy_acronym']) }}.svg">

                                    <h6 class="mb-0 font-weight-medium">
                                        @if($cryptoCurrency['is_stock'])
                                        {{ $cryptoCurrency['buy_acronym']}}
                                        @else
                                        {{ $cryptoCurrency['buy_acronym']}} / {{$cryptoCurrency['sell_acronym'] }}
                                        @endif
                                    </h6>    

                                    <p class="mb-0 small line-height text-purple-pale">
                                        <span
                                            class="ellipsis line-height market-asset-name d-inline-block">{{$cryptoCurrency['buy_name']}}</span>
                                        <span class="line-height d-inline-block ellipsis"> /
                                            {{$cryptoCurrency['symbol']}}<span
                                                class="pair-price-{{$cryptoCurrency['buy_acronym']}}{{$cryptoCurrency['sell_acronym']}}">{{$cryptoCurrency['rate']}}</span>
                                        </span>
                                    </p>

                                </div>



                            </div>
                        </label>
                    </div>
                    @endforeach
                </div>
            </form>

        </div>

    </div>
</div>