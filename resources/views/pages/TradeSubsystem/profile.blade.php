@php
    $canonical = null;
    if(isset($canonicalUrl)) {
        $canonical = $canonicalUrl;
    }
    if(
        (Request::segment(2) == 'trades' && !Request::segment(4)) ||
        (Request::segment(2) == 'trades' && Request::segment(4) == 1)
    ) {
        $canonical = url('/') . "/" . $profileData['handle'];
    }
    if(array_key_exists('trade', $profileData)) {
        $metaTitle = $profileData['trade']['meta_title'];
        $metaDescription = $profileData['trade']['meta_description'];
        $follow = $profileData['trade']['follow'];
    }
@endphp

@extends('pages.TradeSubsystem.layout', 
[
    'title' => isset($metaTitle) ? $metaTitle : $profileData['username'].' Crypto Trading Profile',
    'classes' => 'h-100',
    'html_class' => '',
    'description' => isset($metaDescription) ? $metaDescription : $profileData['description'],
    'nofollow'=> isset($follow) ? $follow : true,
    'poster' => isset($profileData['trade']) ? $profileData['trade']['poster'] : '',
    'canonical' => $canonical
]) 
  
@section('main') 

    @parent

    @section('styles')
        @parent
        <link rel="stylesheet" href="{{ asset('assets/css/TradeSubsystem/feed.css') }}?v=1.0"> 
        <link rel="stylesheet" href="{{ asset('assets/css/TradeSubsystem/profile.css') }}">
    @endsection  

    @section('content')

         @if(isset($timestamp))
            <script>
                var profileSlug = '{{$profileData["handle"]}}';
                var profileTimestamp = '{{$timestamp}}';
                @if(isset($profileData['trade']) && $profileData['trade']) 
                var modalTrade = true;
                @else
                var modalTrade = false; 
                @endif
            </script>
        @endif

        @php $modalTrade['id'] = -1; @endphp
        @if(isset($profileData['trade']) && $profileData['trade'])
            @php $socket = false; $trade = $profileData['trade']; $modalTrade = $trade; @endphp

            <div id="tradeModal" class="modal" role="dialog fade">

                <button type="button" class="close" data-dismiss="modal"><i class="fal fa-times"></i></button>
                <div class="modal-dialog modal-lg modal-dialog-centered ">

                    <!-- Modal content-->
                    <div class="modal-content p-0">
                        <div class="modal-body p-0">
                            @include('pages.TradeSubsystem.common.trade')
                        </div>
                    </div>

                </div>
            </div>                            
        @endif     

        @php $modalTrade = null; @endphp




        <div class="wrapper">

            <div class="sidebar">
                @include('pages.TradeSubsystem.common.sidebar') 
            </div>
            <div class="main">

                <div class="shade"></div>
                
                @include('pages.TradeSubsystem.common.header') 

                <main class="main-content main-content-md pt-4 pb-4 pt-sm-3 py-lg-5">
                  <div class="px-3 px-lg-5">

                    @if (session('message'))
                    <div id="success-alert" style="display: block;" class="container-fluid px-0">
                        <div class="alert no-radius alert-success alert-dismissible fade show m-0" role="alert">
                        <span id="success-alert-text">{!! session('message') !!}</span>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                    </div>
                    @endif

                    <div class="row">

                        <div class="col-12 pb-lg-5 pb-3">

                            <div class="profile-header">
                            <div class="">

                            <img src="{{ $profileData['avatar'] }}" class="profile-avatar float-left" alt="User Avatar">
                            @if($profileData['hasTraderBadge'])
                            @endif
 
                            <h1 class="h3 mb-1">{{ $profileData['username'] }} 

                            @if(Auth::check() && $profileData['userId'] == Auth::id())
                                <a href="/app/settings" class="ml-2">Edit</a>
                            @endif  
 
                            </h1>
                            <p class="mb-0 d-flex">
 
                            <span class="text-muted mr-3 align-self-center">{{ $profileData['joined'] }}</span>

                            @if(count($profileData['badges']) > 0)
                                @foreach($profileData['badges'] as $badge) 
                                        
                    
                                    @if(isset($badge['icon']) && $badge['icon'] != '')
                                    <span data-toggle="tooltip" data-placement="top" title="{{$badge['description']}}" class="mr-2">
                                      
                                        <img src="/assets/images/badges/{{$badge['icon']}}.svg" class="badge-profile"/>

                                    </span>
                                    @endif
                                
                                @endforeach   
                            @endif 


                            </p>  

                            </div> 
                            </div> 


                            <!--                          
                            @if($profileData['description'])
                            <p class="m-0 mb-2 py-2 user-description">{{ $profileData['description'] }}</p>
                            @endif 

                            <div class="user-meta d-block">

                            @if($profileData['location'])
                            <span class="text-muted mb-2 pr-2"><i class="fal fa-map-marker-alt mr-1"></i> {{ $profileData['location'] }}</span>
                            @endif
                         
                            @if($profileData['socialMediaAccounts']->contains('social_network', 'facebook') || $profileData['socialMediaAccounts']->contains('social_network', 'twitter')) 

                                @php
                                    $facebook = $profileData['socialMediaAccounts']->where('social_network', 'facebook')->first();
                                    $twitter = $profileData['socialMediaAccounts']->where('social_network', 'twitter')->first();
                                @endphp
                                @if($facebook && $facebook->url)
                             
                                        <a class="px-1" rel="nofollow noopener" target="_blank" href="{{ $facebook->url }}">
                                            <i class="fab fa-facebook-square"></i>
                                        </a>
                               
                                @endif  
                                @if($twitter && $twitter->url)
                                
                                        <a class="px-1" rel="nofollow noopener" target="_blank" href="{{ $twitter->url }}">
                                        <i class="fab fa-twitter-square"></i>
                                        </a>
                                  
                                @endif
                               

                            @endif
                            </div>

                            --> 


                        </div>

                        <div class="col-lg-4">

                            <div class="mb-3 mb-lg-4">
                                <a href="" class="active lead font-weight-medium link pr-3" data-target="#profile-carousel" data-slide-to="0">Stats</a>
                                <a href="" class="lead font-weight-medium link" data-target="#profile-carousel" data-slide-to="1">Portfolio</a>
                            </div> 


                            <div class="card">
                            <div class="card-body p-0">

                                <div id="profile-carousel" class="carousel slide carousel-fade" data-interval="false" data-wrap="false">
                                    <div class="carousel-inner"> 
                                        <div class="carousel-item active">

                                            <div class="p-4">

                                            <p><span class="text-muted">Total Trades</span> 
                                            <span class="lead font-weight-bold ml-3">{{$profileData['tradesCount']}}</span>
                                            <a data-toggle="tooltip" data-placement="right" title="" data-original-title="The number of trades a user has made since joining Niffler.co / 30 Trades are needed to attain trader status."><i class="fas fa-question-circle "></i></a> 
                                            </p> 

                                            <p><span class="text-muted">Total Profit/Loss</span>
                                            <span class="lead font-weight-medium  ml-3"><span class="{{$profileData['totalBalanceClass']}}">{{$profileData['totalBalance']}}</span></span>
                                            <a data-toggle="tooltip" data-placement="right" title="" data-original-title="Current profits and/or losses in play USD since the first trade / $25k profit in play USD is needed to attain trader status."><i class="fas fa-question-circle "></i></a> 
                                            </p> 

                                            <p><span class="text-muted">Avg. Profit</span>
                                            <span class="lead font-weight-medium ml-3"><span class="">{{$profileData['averageProfitLoss']}}%</span></span>
                                            <a data-toggle="tooltip" data-placement="right" title="" data-original-title="Profit or loss average per trade / +1.5% average profit margin is needed to attain trader status."><i class="fas fa-question-circle "></i></a> 
                                            </p>

                                            <p><span class="text-muted">Followers</span>
                                            <span class="lead font-weight-medium ml-3"><span class="">{{$profileData['followers']->count()}}</span></span>
                                            </p>

                                            <p class="mb-0"><span class="text-muted">Following</span>
                                            <span class="lead font-weight-medium ml-3"><span class="">{{$profileData['followings']->count()}}</span></span>
                                            </p>

                                            </div> 

                                        </div>
                                        <div class="carousel-item">
                                            @php
                                            $portfolioValue = $profileData['portfolioValueInUsd'];
                                            $userBalancesPercents = $profileData['userBalancesPercents'];
                                            $userId = $profileData['userId'];
                                            $username = '';
                                            $intro = false;
                                            $balances = $profileData['balances'];
                                            $portfolioValueChangeIn = $profileData['portfolioValueChangeIn'];
                                            $doNotShowPortfolioControls = true;
                                            $inline = true;
                                            @endphp
                                            @include('pages.TradeSubsystem.common.portfolio-card') 
                                        </div>
                                    </div>
                                </div>
 
                            </div>
                            </div>

                            <div class="mt-4">

                                <div class="mb-3 mb-lg-4">
                                    <a href="" class="lead font-weight-medium link pr-3 active" data-target="#sidebar-carousel" data-slide-to="0">Overview</a>
                                    <a href="" data-target="#sidebar-carousel" data-slide-to="1" class="lead font-weight-medium link">Open Positions ({{ count($activeTrades) }})</a>
                                </div>
                            
                            </div>
  

                            <div id="active-orders-card" class="mb-4">
                                <div class="card">
                                <div class="card-body">


                                    <div id="sidebar-carousel" class="carousel slide carousel-fade" data-interval="false" data-wrap="false">
                                      <div class="carousel-inner"> 
                                        <div class="carousel-item active">


                                            <p class="font-weight-medium">Week Analysis</p>

                                                <div class="d-flex justify-content-between px-1 mb-3 font-weight-medium text-purple-pale">
                                                    @foreach($weekAnalysis as $analysis)
                                                    <div class="d-flex">{{$analysis['day']}}</div>
                                                    @endforeach
                                                </div>

                                                <div class="analysis-vertical-chart">
                                                <div class="d-flex justify-content-between px-2">
                                                
                                                    @foreach($weekAnalysis as $analysis)

                                                 
                                                    <div data-toggle="tooltip" title="" data-original-title="{{$analysis['changeFormatted']}} ({{$analysis['percentChange']}}%)" class="progress progress-bar-vertical">
                                                    <div class="progress-bar @if($analysis['direction'] == 'positive') bg-success @else  bg-danger @endif" role="progressbar" style="height: {{$analysis['percentHeight']}}%;bottom: {{$analysis['percentOffset']}}%;" aria-valuenow="{{$analysis['percentHeight']}}" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>  
                                                  

                                                    @endforeach
                                                  

                                                </div>
                                                </div>

                                                <div class="mt-3">
                                                    <span class="pr-4 text-purple-pale"><i class="small text-success fas fa-circle mr-1"></i> Profit</span>
                                                    <span class="text-purple-pale"><i class="small text-danger fas fa-circle mr-1"></i> Loss</span>
                                                </div>

                                    
                                            <p class="font-weight-medium border-top mt-3 pt-3">Weekly Price Change</p>
  
                                            @foreach($balances as $balance)
                                            

                                                @foreach($tradePairs as $pair)

                                               
                                                    @if($balance['acronym'] == $pair['fromCurrency'])

                                                    <div class="stat-analysis mb-3">
                                                    <h6 class="mb-2 p-0 text-purple-pale font-weight-medium">
                                                        <img class="pair-icon" src="/assets/images/crypto-icons/color/{{ strtolower($pair['toCurrencyL']) }}.svg"/>
                                                        <img class="pair-icon pair-icon-last" src="/assets/images/crypto-icons/color/{{ strtolower($pair['fromCurrencyL']) }}.svg"/>
                                                        <span class="text-medium">{{$pair['symbolWithSlash']}}</span>
                                                        <span class="text-{{$pair['weeklyChanceStatus']}} float-right">{{$pair['weeklyPctChange']}}%</span>
                                                    </h6>  
                                                    <div class="progress">
                                                      <div class="progress-bar bg-{{$pair['weeklyChanceStatus']}}" role="progressbar" style="width: {{$pair['weeklyPctChangeAbsolute']}}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                    </div>

                                                    @endif


                                                @endforeach 

                
                                            @endforeach


                                            @if(count($balances) == 1)
                                            <div class="text-center px-4 pt-3 pb-5">
                                                <span class="iconify display-4" data-icon="ant-design:ellipsis-outline" data-inline="false"></span>
                                            
                                            <p class="lead mb-0">No enough data</p>
                                            </div>
                                            @endif

                                        </div>
                                        <div class="carousel-item">
                                            
                                              @if(count($activeTrades) > 0)
                                                <ul class="list-group list-group-small list-group-flush">
                                                @foreach($activeTrades as $trade)
                                                    @include('pages.TradeSubsystem.common.active-trade')
                                                @endforeach
                                                </ul>
                                                @else
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



                        </div>
 
                        <div class="col-lg-8">

                             <div class="mb-3 mb-sm-4">
                                <a href="/{{ $profileData['handle'] }}" class="@if($tab == 'trades') active @endif lead font-weight-medium link pr-3">
                                Trades ({{$profileData['tradesCount']}})</a>
                                <a href="/{{ $profileData['handle'] }}/followers" class="@if($tab == 'followers') active @endif lead font-weight-medium link pr-3">
                                <span class="d-none d-md-inline-block">Followers</span> <i class="fal fa-user-plus d-md-none mr-2"></i> ({{$profileData['followers']->count()}})</a>
                                <a href="/{{ $profileData['handle'] }}/followings" class="@if($tab == 'followings')  active @endif lead font-weight-medium link">
                                <span class="d-none d-md-inline-block">Following</span>
                                <i class="fal fa-user-check d-md-none mr-2"></i>({{$profileData['followings']->count()}})</a>
                            </div> 

                            @if($tab == 'trades')

                           
                            @if(count($profileData['trades']['data']) > 0)  

                                    <div id="replacable-main-content" class="feed-wrapper">
                                    @php $socket = false; @endphp
                                    @foreach($profileData['trades']['data'] as $trade)
                              
                                            @include('pages.TradeSubsystem.common.trade')
                                     
                                    @endforeach
                                    </div>
                               

                            @else 

                                @if(Auth::check() && $profileData['userId'] == Auth::id())
                                <div class="card card-small">
                                    <div class="card-body text-center">
                                        <div class="p-5">
                                        <h3 class="text-grey-light font-weight-bold mb-0">Post your first trade</h3>
                                        <p class="lead text-grey-light">Believe us it's fun</p> 
                                        <a href="/app/trade" class="btn btn-lg btn-primary">Post a trade</a>
                                        </div>
                                    </div>
                                </div>
                                @else
                                <div class="card card-small">
                                    <div class="card-body text-center">
                                        <div class="p-5">
                                        <h3 class="text-grey-light font-weight-bold">This user has no trades yet.</h3>
                                        </div>
                                    </div>
                                </div>
                                @endif


                            @endif
                           

                            @endif  


                            @if($tab == 'trade')

                            <div id="`" class="feed-wrapper">
                                @include('pages.TradeSubsystem.common.trade-shimmer')
                                @include('pages.TradeSubsystem.common.trade-shimmer')
                                @include('pages.TradeSubsystem.common.trade-shimmer')
                                @include('pages.TradeSubsystem.common.trade-shimmer')
                            </div>

                            @endif


                            @if($tab == 'followers')
                             
                                @if(isset($profileFollowers['data']) && count($profileFollowers['data']) > 0)

                                    <div class="pb-2 pb-lg-0">
                                    <div class="row px-1 pb-4 pb-lg-0">
                                    

                                    @foreach($profileFollowers['data'] as $follower) 
                                    <div class="col-sm-6 col-lg-4 col-xl-3"> 
                                    <div class="card card-small mb-3 card-top">
                        
                                        <div class="card-body pb-4 text-center"> 

                                            <a href="/{{$follower['handle']}}">
                                                <div class="px-4">
                                                <img style="width: 70px;" class="card-top-avatar rounded-circle" src="{{ $follower['avatar'] }}" alt="User Avatar">
                                                </div>
                                            </a> 
                                        
                                            <p class="mb-0 mt-3 font-weight-bold"><a href="/{{$follower['handle']}}">{{ $follower['username'] }}</a></p> 
                    
                                            <p class="mb-0">{{ $follower['totalBalance'] }}</p>

                                            @if(Auth::check() && $follower['userId'] !== Auth::id()) 
                                                @if(Auth::user()->followings->contains('following_id', $follower['userId']))
                                                    <a href="/app/unfollow/{{$follower['userId']}}" class="btn btn-secondary ml-auto mt-2 follow-unfollow-button unfollow-button">Unfollow</a>
                                                @else
                                                    <a href="/app/follow/{{$follower['userId']}}" class="btn btn-primary ml-auto mt-2 follow-unfollow-button follow-button">Follow</a>
                                                @endif
                                            @else
                                            <a href="/{{$follower['handle']}}" class="btn btn-primary ml-auto mt-2 follow-unfollow-button follow-button">My Profile</a>
                                            @endif 
                                            
                                            
                                        </div>

                                    </div>
                                    </div>
                                    @endforeach

                                    </div>
                                    </div>

                                @else 

                                    
                                    <div class="card card-small">
                                        <div class="card-body text-center">
                                            <div class="p-5">
                                            <h3 class="text-grey-light font-weight-bold">There are no followers yet.</h3>
                                            </div>
                                        </div>
                                    </div>

                                @endif         

                                @if(isset($profileFollowers['pagination']))
                                    <div class="mb-5">
                                    {!! $profileFollowers['pagination'] !!}
                                    </div>
                                @endif  

                            @endif  

                            

                            @if($tab == 'followings')

                                @if(isset($profileFollowings['data']) && count($profileFollowings['data']) > 0)

                                    <div class="pb-2 pb-lg-0">
                                    <div class="row px-1 pb-4 pb-lg-0">

                                    @foreach($profileFollowings['data'] as $following) 
                                        <div class="col-sm-6 col-lg-4 col-xl-3">
                                        <div class="card card-small mb-3 card-top">
                            
                                            <div class="card-body pb-4 text-center"> 

                                                <a href="/{{$following['handle']}}">
                                                    <div class="px-4">
                                                    <img  style="width: 70px;" class="card-top-avatar rounded-circle" src="{{ $following['avatar'] }}" alt="User Avatar">
                                                    </div>
                                                </a> 
                                            
                                                <p class="mb-0 mt-3 font-weight-bold"><a href="/{{$following['handle']}}">{{ $following['username'] }}</a></p> 
                        
                                                <p class="mb-0">{{ $following['totalBalance'] }}</p>

                                               

                                                 @if(Auth::check() && $following['userId'] !== Auth::id()) 
                                                    @if(Auth::user()->followings->contains('following_id', $following['userId']))
                                                        <a href="/app/unfollow/{{$following['userId']}}" class="btn btn-secondary ml-auto mt-2 follow-unfollow-button unfollow-button">Unfollow</a>
                                                    @else
                                                        <a href="/app/follow/{{$following['userId']}}" class="btn btn-primary ml-auto mt-2 follow-unfollow-button follow-button">Follow</a>
                                                    @endif
                                                @else


                                                <a href="/{{$following['handle']}}" class="btn btn-primary ml-auto mt-2 follow-unfollow-button follow-button">My Profile</a>
                                                @endif 
                                                
                                                
                                            </div>

                                        </div>
                                        </div>
                                    @endforeach
                                    </div>
                                    </div>

                                @else 

                                    
                                    <div class="card card-small">
                                        <div class="card-body text-center">
                                            <div class="p-5">
                                            <h3 class="text-grey-light font-weight-bold">This user does not follow anyone.</h3>
                                            </div>
                                        </div>
                                    </div>

                                @endif         

                                @if(isset($profileFollowings['pagination']))
                                     <div class="mb-5">
                                    {!! $profileFollowings['pagination'] !!}
                                    </div>
                                @endif 

                            @endif  
 

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
        <script src="{{ asset('assets/js/TradeSubsystem/profile.js') }}"></script>
    @endsection    
 

@endsection