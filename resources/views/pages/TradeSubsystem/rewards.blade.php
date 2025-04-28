<?php
    $array = [
        'title' => 'Exchange your play dollar profits for real Bitcoin',
        'classes' => 'h-100',
        'html_class' => '',
        'description' => 'Trade on our simulated cryptocurrency exchange and trade-in your play dollar profits for real Bitcoin over the Lightning Network.',
        'poster' => 'assets/images/reward-poster.png'
    ];
    if(isset($canonical))
    { 
        $array['canonical'] = $canonical;
    }
?>
  

@extends('pages.TradeSubsystem.layout', $array)

@section('main')

    @parent

    @section('styles')
        @parent
        <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}"> 
    @endsection   

    @section('content')

        <div class="wrapper">

            <div class="sidebar">
                @include('pages.TradeSubsystem.common.sidebar') 
            </div>
            <div class="main">

                <div class="shade"></div>
                
                @include('pages.TradeSubsystem.common.header')  

                <main class="main-content  main-content-md pt-4 pb-4 pt-sm-4 py-lg-5 ">
                  <div class="px-4 px-sm-4 px-lg-5">
                    <div class="row justify-content-center">

                    <div class="col-12">
                        @if (session('message_success'))
                            <div class="alert mb-3 alert-success mb-3">
                                {{ session('message_success') }}
                            </div>
                        @endif 
                        @if (session('message_failed'))
                            <div class="alert mb-3 alert-danger mb-3">
                                {{ session('message_failed') }}
                            </div>
                        @endif 
                    </div>   



                    <div class="col-xl-11">
                        
                         <div class="mb-3 mb-sm-4 mb-lg-5">
 
                                <a href="/app/rewards" class="lead font-weight-medium link pr-4 active">
                                    <span class="mb-0 iconify h4 mr-1" data-icon="ant-design:gift-outline" data-inline="false"></span><span> Rewards</span>
                                </a>
                                <a href="/app/reward-history"class="lead font-weight-medium link pr-4">
                                    <span class="mb-0  iconify h4 mr-1" data-icon="ant-design:bell-outline" data-inline="false"></span><span> Reward History</span>
                                </a>
                               
                            </div>

                    </div>
                    <div class="col-md-7 col-xl-6">

                            <h4 class="mb-4 font-weight-bold"><span class="text-success">Ahoy-Matey!</span> Exchange your play dollar profits for real Bitcoin</h4>
                         
                            <h6 class="mb-4 text-purple-pale d-none">Each play dollar on {{ env('APP_NAME') }} can be exchanged for real Bitcoin over a Lightning network. You can redeem anything you made above the initial 100k play dollars that were given for you on signup.</h6>  
                 
                            <form id="redeem-sats" action="/app/exchanges" method="post">

                            @csrf 

       
    
                            <div class="d-flex mb-4 mt-4">

                                <div class="">
                                       <div class="position-relative redeem-input-holder">
                                        <a href="" class="increase-redeem"><span class="iconify" data-icon="ant-design:plus-circle-outlined" data-inline="false"></span></a>
                                        <input id="play_dollars_sats_amount" readonly value="{{$eligibleAmountLeftNoFormatRounded}}" name="amount" type="text" class="text-center form-control form-control-lg"  placeholder="Play dollars to redeem">
                                        <a href="" class="decrease-redeem"><span class="iconify" data-icon="ant-design:minus-circle-outlined" data-inline="false"></span></a>
                                        </div>
                                </div>
                                <div class="align-self-center pl-3 text-purple-pale ">
                                   Select amount of play dollars to exchange
                                </div>





                            </div>

                             <h6 class="font-weight-bold mb-3 border-top pt-3">Create Lightning invoice for <span id="sats" class="text-success">{{$rewardPerThousand * $thousandsLeft}}</span> sats</h6>

                             <textarea id="invoice_address" class="form-control" name="invoice_address" placeholder="Paste Lightning Invoice here" aria-label="With textarea"></textarea>


                            <div class="d-flex mb-4 mt-4">

                                <div class="">

                                    @if(Auth::check()) 
                                      <button type="submit" class="btn btn-primary btn-lg ladda-button">Redeem</button>
                                    @endif

                                </div>
                                <div class="align-self-center pl-3 text-purple-pale ">
                                    <span class="font-weight-bold">~$<span class="usd-estimate">{{$usdEstimate}}</span></span> or <span class="font-weight-bold btc-estimate">{{$btcEstimate}}BTC</span>
                                </div> 

                            </div>

                            <script type="text/javascript">
                                var btc_rate = '{{$btcRate}}';
                                var reward_per_thousand = '{{$rewardPerThousand}}';
                            </script>

                            </form> 
                                
                            @if(!Auth::check()) 
                                    
                                <button data-toggle="modal" data-target="#guest-login-modal" type="submit" class="btn btn-primary btn-lg">Redeem</button>  
                                @include('pages.TradeSubsystem.modals.guest-login')  

                            @endif 
                                
                            <div id="error-alert-redeem">
                                <p id="error-alert-text-redeem"></p>
                            </div>

                            <p class="text-purple-pale font-weight-medium mb-2">Use your reward to start trading for real on  <a href="/visit/tradeor" target="_blank">TradeOr</a>.</p>

                            <a href="/visit/tradeor" target="_blank">
                       

                            <svg style="width: 170px;" viewBox="0 0 146 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M48.9029 12.2981H44.8876V24.6577H40.0206V12.2981H36.0055V7.55959H48.9029V12.2981Z" fill="#0C306F"/>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M55.2297 15.2049H57.0792C58.1011 15.2293 58.7583 14.6429 58.7583 13.6415C58.7583 12.6401 58.1011 12.0295 57.0792 12.0295H55.2297V15.2049ZM56.4465 19.2598H55.2296V24.6336H50.3627V7.53503H57.1765C60.8509 7.53503 63.625 9.85556 63.625 13.5441C63.625 15.6201 62.6031 17.2812 60.9969 18.2582L64.3552 24.6336H59.1476L56.4465 19.2598Z" fill="#0C306F"/>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M74.2835 18.5513L72.872 13.2996L71.4607 18.5513H74.2835ZM75.3298 22.4594H70.4142L69.8302 24.6578H64.5983L70.0249 7.55973H75.7191L81.1458 24.6578H75.9138L75.3298 22.4594Z" fill="#0C306F"/>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M92.5831 16.1086C92.5831 13.8369 91.1473 12.2982 89.1763 12.2982H87.2295V19.9192H89.1763C91.1473 19.9192 92.5831 18.3803 92.5831 16.1086M97.4499 16.1086C97.4499 20.9451 93.8728 24.6578 89.1764 24.6578H82.119V7.55968H89.1764C93.8728 7.55968 97.4499 11.2722 97.4499 16.1086" fill="#0C306F"/>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M110.469 20.1634V24.6577H99.2747V7.55959H110.347V12.005H104.142V13.8615H109.739V18.2581H104.142V20.1634H110.469Z" fill="#0C306F"/>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M124.875 16.1086C124.875 13.7395 123.123 11.9563 120.714 11.9563C118.304 11.9563 116.553 13.7395 116.553 16.1086C116.553 18.478 118.304 20.2612 120.714 20.2612C123.123 20.2612 124.875 18.478 124.875 16.1086M111.686 16.1086C111.686 11.0526 115.677 7.16867 120.714 7.16867C125.751 7.16867 129.742 11.0526 129.742 16.1086C129.742 21.1649 125.751 25.0485 120.714 25.0485C115.677 25.0485 111.686 21.1649 111.686 16.1086" fill="#54DFC4"/>
                            <mask id="mask0" mask-type="alpha" maskUnits="userSpaceOnUse" x="131" y="7" width="15" height="18">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M131.567 7.53503H145.559V24.6336H131.567V7.53503Z" fill="white"/>
                            </mask>
                            <g mask="url(#mask0)">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M136.434 15.2049H138.283C139.305 15.2293 139.963 14.6429 139.963 13.6415C139.963 12.6401 139.305 12.0295 138.283 12.0295H136.434V15.2049ZM137.651 19.2598H136.434V24.6336H131.567V7.53503H138.381C142.055 7.53503 144.829 9.85556 144.829 13.5441C144.829 15.6201 143.807 17.2812 142.201 18.2582L145.559 24.6336H140.352L137.651 19.2598Z" fill="#54DFC4"/>
                            </g>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M25.2779 4.34745C22.5775 1.63682 19.087 0.196022 15.5417 0.0195743C14.9059 -0.0137522 14.2651 -0.00416508 13.6267 0.0455964C12.0226 0.174337 10.4328 0.560102 8.9308 1.21043C10.008 1.45832 11.0332 1.99177 11.8828 2.81124C11.9278 2.84685 11.9658 2.88497 12.0037 2.92309C12.1745 3.09474 12.3335 3.27324 12.4806 3.45882C14.5 5.99095 14.341 9.70434 12.0037 12.0504L9.41017 14.6538L7.45947 12.696V16.6118V21.1755L14.2769 14.3322C17.2455 11.3524 17.872 6.90309 16.1516 3.30429C16.6879 3.36615 17.217 3.46384 17.7392 3.60171C19.4879 4.05687 21.1491 4.92861 22.5679 6.21487C22.7176 6.35046 22.8622 6.48628 23.0046 6.62917C23.1731 6.79832 23.3345 6.96974 23.4887 7.14847C27.5181 11.7124 27.3567 18.7196 23.0023 23.0904C21.7138 24.3837 20.1949 25.308 18.5767 25.8654L18.5958 25.8846L18.6265 25.9106L18.6504 25.9343C19.3695 26.6228 20.2686 27.0777 21.2487 27.2516C21.2594 27.2535 21.2701 27.2553 21.2808 27.2571C22.2136 27.4139 23.1794 27.1578 23.9244 26.5728C24.3931 26.2048 24.845 25.8044 25.2757 25.3721C31.0513 19.5747 31.0513 10.1426 25.2779 4.34745" fill="#54DFC4"/>
                            <mask id="mask1" mask-type="alpha" maskUnits="userSpaceOnUse" x="0" y="2" width="23" height="28">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M0 2.41829H22.148V29.7196H0V2.41829Z" fill="white"/>
                            </mask>
                            <g mask="url(#mask1)">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M20.1975 15.0636L22.148 17.0214V8.54208L15.3283 15.3875C12.362 18.3647 11.738 22.8165 13.4561 26.4133C12.9221 26.3537 12.3929 26.256 11.8708 26.1179C10.1221 25.663 8.45857 24.7887 7.03728 23.5048C6.89242 23.3692 6.74756 23.2333 6.60521 23.0905C6.43692 22.9213 6.27319 22.7474 6.11651 22.5712C2.08959 18.0052 2.25104 10.9977 6.60293 6.62923C7.89369 5.33361 9.41254 4.40937 11.0333 3.85446L11.0119 3.833L10.981 3.80675L10.9573 3.78301C10.2383 3.09457 9.33886 2.63964 8.35669 2.46799C8.35078 2.46707 8.3451 2.46616 8.33941 2.46525C7.35474 2.29222 6.35142 2.60814 5.57028 3.23427C5.14116 3.57803 4.72682 3.94896 4.32977 4.34751C-1.44364 10.1424 -1.44364 19.5747 4.33205 25.3722C7.03 28.0803 10.5232 29.5241 14.0682 29.7001C14.7041 29.7336 15.3449 29.724 15.981 29.6715C17.5874 29.5453 19.1747 29.157 20.6769 28.5069C19.5997 28.2593 18.5745 27.7256 17.7227 26.9086C17.6799 26.8705 17.6419 26.8324 17.604 26.7943C17.433 26.6228 17.2742 26.4441 17.1271 26.2583C15.1075 23.7264 15.2665 20.013 17.6015 17.6692L20.1975 15.0636Z" fill="#0C306F"/>
                            </g>
                            </svg>


                            </a>

                            <h3 class="font-weight-bold h4 mt-5">Recently redeemed</h3>


                            <div class="table-responsive">
                            <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>User</th>
                                <th>Amount</th>
                                <th>Date</th>
                      
                            </tr>
                            </thead>
                            <tbody>
                                @if(count($exchanges['exchanges']) > 0)
                                    @php
                                        $iterationFirst = !Request::segment(4) ? 1 : (Request::segment(4) - 1) * 20 + 1;
                                        
                                    @endphp
                                    @foreach($exchanges['exchanges'] as $exchange)          
                                        <tr>
                                            <td><span class="td-holder"><span class="td-inner align-self-center w-100">{{$iterationFirst++}}</span></span></td>
                                            <td><span class="td-holder"><span class="td-inner align-self-center w-100"><a href="/{{$exchange['user']}}">{{$exchange['user']}}</a></span></span></td>
                                            <td><span class="td-holder"><span class="td-inner align-self-center w-100"><span class="font-weight-bold">${{$exchange['amount']}}</span> play dollars to <span class="font-weight-bold">{{$exchange['exchanged_amount']}} sats</span> at <span class="font-weight-bold">{{$exchange['exchange_rate']}} sats</span> per K</span></span></td>
               
                                            
              
                                            <td><span class="td-holder"><span class="td-inner align-self-center w-100">{{$exchange['date']}}</span></span></td>

                                        </tr>
                                    @endforeach
                                @else
                                    <tr><td><span class="td-holder"><span class="td-inner align-self-center w-100">No exchanges yet</span></span></td></tr>
                                @endif
                            </tbody>
                        </table> 
                </div>
                           


                    </div>

                    <div class="col-sm-6 col-md-5 col-xl-5 d-flex">

                        <div class="w-100 px-xl-5">

                            <div class="card mb-3">
                            <div class="card-body">
                                <p class="mb-0">Your are eligible to redeem</p>
                                <h4 class="h1 mb-0 font-weight-bold text-success">${{$usdEstimate}}</h4>
                                <p class="mb-3 line-height-1 small">Your exchange rate is<br/> <span class="font-weight-bold">${{$defaultUSDReward}}</span> per <span class="font-weight-bold">$1,000</span> play dollars</p>
                                <p class="mb-0 line-height-1 small  border-top pt-3 mt-3">You have <span class="font-weight-bold">${{$eligibleAmountLeft}}</span> play dollars, out of which <span class="font-weight-bold">${{$amountLeft}}</span> are available for redeem<br/> <a href="" class="text-purple mt-2 d-inline-block font-weight-bold"><i class="fas fa-info mr-1"></i> Learn more</a></p>



                                <p class="text-purple-pale font-weight-medium mb-3 small border-top pt-3 mt-3">Crypto Parrot encourages users to redeem their profits in order to advance on the leaderboard which is based on your total redeemed amount.</p>

                              
                                <p class="mb-0 text-purple-pale font-weight-medium small @if($eligibleAmountLeftNoFormat < 20001) font-weight-bold @endif">
                                    <i class="fas fa-circle @if($eligibleAmountLeftNoFormat < 20001) text-success @else text-purple-pale @endif mr-1"></i> 0-20K play dollars - $0.05 per 1K
                                </p>
                                <p class="mb-0 text-purple-pale font-weight-medium small @if($eligibleAmountLeftNoFormat > 20000 && $eligibleAmountLeftNoFormat < 50001) font-weight-bold @endif">
                                    <i class="fas fa-circle @if($eligibleAmountLeftNoFormat > 20000 && $eligibleAmountLeftNoFormat < 50001) text-success @else text-purple-pale @endif mr-1"></i> 20-50K play dollars - $0.025 per 1K
                                </p>
                                <p class="mb-0 text-purple-pale font-weight-medium small @if($eligibleAmountLeftNoFormat > 50000 && $eligibleAmountLeftNoFormat < 100001) font-weight-bold @endif">
                                    <i class="fas fa-circle @if($eligibleAmountLeftNoFormat > 50000 && $eligibleAmountLeftNoFormat < 100001) text-success @else text-purple-pale @endif mr-1"></i> 50-100K play dollars -$0.01 per 1K
                                </p>
                                <p class="mb-0 text-purple-pale font-weight-medium small   @if($eligibleAmountLeftNoFormat > 100000) font-weight-bold @endif">
                                    <i class="fas fa-circle  @if($eligibleAmountLeftNoFormat > 100000) text-success @else text-purple-pale @endif mr-1"></i> 100K+ play dollars - $0.001 per 1K
                                </p>

                            </div>
                            </div>

                            <p class="mb-5 text-purple-pale font-weight-medium small">* Crypto Parrot reserves the right to change reward exchange rates without a warning or notice.</p>

                            


                            <img class="w-100" src="{{ asset('assets/images/pirate.svg') }}" alt="">

                        </div>

                    </div>
                    
                    
                  </div>
                  </div>  
                </main>
            </div>

        </div>

          

    @endsection

@endsection