@auth
    @php
        $portfolioValue = $commonUserData['portfolioValueInUsd'];
        $userId = Auth::id();
        $username = 'My';
        $intro = true;
        $balances = $userBalances;
        $portfolioValueChangeIn = $commonUserData['portfolioValueChangeIn'];
    @endphp
@endauth

@guest
    @php
        $portfolioValue = 0;
        $userId = null;
        $username = 'My';
        $intro = true;
        $balances = [];
        $portfolioValueChangeIn = 0;
    @endphp
@endguest

@if(Auth::check())
<div class="app-navbar d-flex d-lg-none justify-content-around">
 
    <div class="text-center px-1 align-self-center">
       

         <div class="dropdown nav-more align-self-center">

                <a class="navbar-icon d-block navbar-icon-dots" data-toggle="dropdown" href="#" role="button" data-display="static" aria-haspopup="true" aria-expanded="false">
                 <span class="iconify" data-icon="ant-design:ellipsis-outlined" data-inline="false"></span></a>

                <div class="dropdown">
                
                <div class="dropdown-menu dropdown-more dropdown-menu-up">



                    
                    @if(env('APP_FORK') == 'fxparrot')
                    <a class=" @if(Request::segment(2) == 'markets') active @endif dropdown-item lead" href="/app/markets">
                    <span class="iconify mr-2" data-icon="ant-design:line-chart-outline" data-inline="false"></span>
                    <span class="relative">Markets</span> 
                    </a> 
                    @else
                    <a class=" @if(Request::segment(2) == 'cryptocurrencies') active @endif dropdown-item lead" href="/app/cryptocurrencies">
                    <span class="iconify mr-2" data-icon="ant-design:line-chart-outline" data-inline="false"></span>
                    <span class="relative">Cryptocurrencies</span> 
                    </a> 
                    @endif
             
                    <a class="dropdown-item lead" href="/news">
                    <span class="iconify mr-2" data-icon="ant-design:fire-outline" data-inline="false"></span>
                    <span>Daily News</span>
                    </a>

                    <a class="@if(Request::segment(2) == 'rewards') active @endif dropdown-item lead" href="/app/rewards">
                  
                    <span class="iconify mr-2" data-icon="ant-design:gift-outline" data-inline="false"></span>
                    <span>Rewards</span>
                    </a>

                    <a class="dropdown-item lead @if(Request::segment(2) == 'competitions') active @endif" href="/app/competitions">
                    <span class="iconify mr-2" data-icon="ant-design:trophy-outline" data-inline="false"></span>
                    <span>Competitions</span>
                    </a>
            
                    <a class="dropdown-item lead @if(Request::segment(2) == 'leaderboard') active @endif" href="/app/leaderboard">
                    <span class="iconify mr-2" data-icon="ant-design:crown-outline" data-inline="false"></span>
                    <span>Leaderboard.</span>
                    </a>

                    @if(env('APP_FORK') == 'cryptoparrot')
                    <a class="dropdown-item lead" target="_blank" href="/crypto-moon">
                    <i class="fad fa-moon-stars"></i>
                    <span>Crypto Moon</span>
                    </a>
                    @endif
                
                    @if(Auth::check())
                    
                        <a class="dropdown-item lead" href=""  data-toggle="modal" data-target="#invite-modal" >
                        <span class="iconify mr-2" data-icon="ant-design:user-add-outline" data-inline="false"></span>
                        <span>Invite & Get Swag</span>
                        </a> 
                    
                    @endif


                </div>  

                </div>

            </div>


    </div>
 
    <div class="text-center px-1 align-self-center">
        <a href="/app" class="navbar-icon d-block">
           <span class="iconify" data-icon="ant-design:layout-outlined" data-inline="false"></span>
           <small class="d-block navbar-label">FEED</small>
        </a>

       

    </div> 

    <div class="text-center px-1 align-self-center">
        <a href="" id="toggle-balance" class="navbar-icon d-block">
           <span class="iconify" data-icon="ant-design:dollar-circle-outlined" data-inline="false"></span>
           <small class="d-block navbar-label">BALANCE</small>
        </a> 
    </div>

    <div class="text-center px-1 align-self-center">
        <a href="/app/my-trades" class="navbar-icon d-block">
           <span class="iconify" data-icon="ant-design:sliders-outlined" data-inline="false"></span>
           <small class="d-block navbar-label">MY TRADES</small>
        </a>
    </div>

    <div class="text-center px-1 align-self-center">
        <button class="btn btn-primary btn-lg" id="new-trade-nav">
            <span class="iconify" data-icon="ant-design:plus-outlined" data-inline="false"></span>
        </button>
    </div>

</div>
@else

<div class="app-navbar d-flex d-lg-none justify-content-around">
 
    <div class="text-center px-1 align-self-center">
       

         <div class="dropdown nav-more align-self-center">

                <a class="navbar-icon d-block navbar-icon-dots" data-toggle="dropdown" href="#" role="button" data-display="static" aria-haspopup="true" aria-expanded="false">
                 <span class="iconify" data-icon="ant-design:ellipsis-outlined" data-inline="false"></span></a>

                <div class="dropdown">
                
                <div class="dropdown-menu dropdown-more dropdown-menu-up">


                    @if(env('APP_FORK') == 'fxparrot')
                    <a class=" @if(Request::segment(2) == 'markets') active @endif dropdown-item lead" href="/app/markets">
                    <span class="iconify mr-2" data-icon="ant-design:line-chart-outline" data-inline="false"></span>
                    <span class="relative">Markets</span> 
                    </a> 
                    @else
                    <a class=" @if(Request::segment(2) == 'cryptocurrencies') active @endif dropdown-item lead" href="/app/cryptocurrencies">
                    <span class="iconify mr-2" data-icon="ant-design:line-chart-outline" data-inline="false"></span>
                    <span class="relative">Cryptocurrencies</span> 
                    </a> 
                    @endif
            

                    <a class="@if(Request::segment(2) == 'rewards') active @endif dropdown-item lead" href="/app/rewards">
                  
                    <span class="iconify mr-2" data-icon="ant-design:gift-outline" data-inline="false"></span>
                    <span>Rewards</span>
                    </a>

   
                    <a class="dropdown-item lead @if(Request::segment(2) == 'competitions') active @endif" href="/app/competitions">
                    <span class="iconify mr-2" data-icon="ant-design:trophy-outline" data-inline="false"></span>
                    <span>Competitions</span>
                    </a>
            
                    <a class="dropdown-item lead @if(Request::segment(2) == 'leaderboard') active @endif" href="/app/leaderboard">
                    <span class="iconify mr-2" data-icon="ant-design:crown-outline" data-inline="false"></span>
                    <span>Leaderboard</span>
                    </a>
                
             


                </div>  

                </div>

            </div>


    </div>
 
    <div class="text-center px-1 align-self-center">
        <a href="/news" class="navbar-icon d-block">
           <span class="iconify" data-icon="ant-design:fire-outline" data-inline="false"></span>
           <small class="d-block navbar-label">NEWS</small>
        </a>
    </div> 

    <div class="text-center px-1 align-self-center">
        <a href="/app/cryptocurrencies" class="navbar-icon d-block">
           <span class="iconify" data-icon="ant-design:line-chart-outline" data-inline="false"></span>
           <small class="d-block navbar-label">CRYPTOS</small>
        </a> 
    </div>

    <div class="text-center px-1 align-self-center">
        <a href="/app/rewards" class="navbar-icon d-block">
           <span class="iconify" data-icon="ant-design:gift-outline" data-inline="false"></span>
           <small class="d-block navbar-label">REWARDS</small>
        </a> 
    </div>

    <div class="text-center px-1 align-self-center">
        <button class="btn btn-primary btn-lg" id="new-trade-nav">
            <span class="iconify" data-icon="ant-design:login-outlined" data-inline="false"></span>
        </button>
    </div>

</div>

@endif  

<div class="main-navbar d-flex">

    <div class="main-navbar-shade"></div>

    @if(Auth::check())


     
    @if(!empty($profileData) && $profileData['userId'] != Auth::id())

        <div class="nav-buttons">

        <a href="/app/conversations/{{$profileData['userId']}}" class="btn btn-lg btn-outline-dark mr-2">Message</a> 

        @if(!$profileData['alreadyFollow'] )
            <a href="/app/follow/{{$profileData['userId']}}" class="btn btn-lg btn-primary mr-2 follow-unfollow-button follow-button">Follow</a> 
        @else
            <a href="/app/unfollow/{{$profileData['userId']}}" class="btn btn-lg btn-dark mr-2 follow-unfollow-button unfollow-button">Unfollow</a>
        @endif
      
        </div>
 
    @else   
 
        @if(Request::segment(2) == '' || Request::segment(2) == 'my-trades' || Request::segment(2) == 'welcome')
        <button class="btn btn-primary btn-lg d-none d-lg-block" id="new-trade">New Trade</button> 
        @endif   

    @endif    
 
  
    @endif 

    <div class="align-self-center w-100 flex-row">

        <div class="flex-row d-flex px-4 px-lg-5">

           

            <div class="nav-logo d-lg-none">
                <a class="d-block" href="@if(Auth::check()) /app @else / @endif">
                    <img class="" src="{{ asset('assets/images/logo.svg') }}" alt="">
                </a> 
            </div>

            @if(Auth::check())

            <div class="nav-balance align-self-center dropdown">

                <a href="#" id="balance-dropdown-item" data-toggle="dropdown" data-display="static" aria-haspopup="true" aria-expanded="false">
                <span class="lead d-none d-lg-inline">

                    Portfolio 

                    <img src="/assets/images/usd.svg"/>

                    <span class="font-weight-bold">${{$portfolioValue}}</span>
                    <small class="font-weight-bold vertical-align-text-bottom">
                        {!!$portfolioValueChangeIn['value']!!}

                         <span class="iconify" data-icon="ant-design:arrow-down-outline" data-inline="false"></span>
                    </small>


 
                </span>
                </a>

                <div class="dropdown-menu dropdown-balance">
                    
                    @include('pages.TradeSubsystem.common.portfolio-card') 

                </div>

            </div>
            @endif

            <div class="nav-redeem ml-auto align-self-center d-none d-lg-block">

{{--                @if(Auth::check() && Auth::user()->current_portfolio_id == Auth::user()->main_portfolio_id)--}}
{{--                <a href="/app/rewards" class="d-block redeem-sats">--}}
{{--                   <span class="iconify text-purple icon-2x pr-1" data-icon="ant-design:question-circle-outline" data-inline="false"></span>  Redeem BTC--}}
{{--                </a>--}}
{{--                @endif --}}

            </div>

            @if(Auth::check())
            <div class="dropdown nav-notifications align-self-center ml-auto ml-lg-0">

                    <a class="px-3 px-lg-4 d-block" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static" aria-haspopup="true" aria-expanded="false">
                    <div id="notifications-list" class="">
                        <span class="iconify h2 mb-0 text-purple" data-icon="ant-design:bell-outline" data-inline="false"></span> 
                        <span id="unread-count" style="@if($commonUserData['unreadCount'] == 0) display: none; @endif" data-count="{{$commonUserData['unreadCount']}}" class="badge badge-pill badge-success ">{{ $commonUserData['unreadCount'] }}
                        </span>
                    </div>
                    </a>  
                    
                    <div class="bg-transparent dropdown-menu dropdown-notifications dropdown-menu-right">
                        <div id="notifications">
                            @if(count($commonUserData['notifications']) > 0)
                                <div id="notifications-list-items">
                                    @foreach($commonUserData['notifications'] as $notification)
                                        @include('pages/TradeSubsystem/common/single-notification')
                                    @endforeach
                                </div>
                                <div class="pt-3 text-center">
                                <a class="notification__all btn btn-primary text-center font-weight-bold " href="/app/notifications">
                                <span class="iconify lead mr-2" data-icon="ant-design:bell-outline" data-inline="false"></span>  View all Notifications 
                                </a>
                                </div>

                            @else

                            <div id="notifications-list-items">
                            </div>

                            
                            <div id="no-notifications" class="">
                                    
                                    <div class="card mb-2 ">
                                    <div class="card-body p-5 text-center">
                                    <span class="iconify h2 mb-0 text-purple" data-icon="ant-design:bell-outline" data-inline="false"></span> 
                                    <h6 class=" text-grey mb-0">There are no notifications</h6>
                                    </div>
                                    </div>
                                
                            </div>
        
                            @endif
                            
                        </div>

                    </div>

            </div>
            @endif

            @if(Auth::check())

            <div class="dropdown nav-profile align-self-center">

                <a class="" data-toggle="dropdown" href="#" role="button" data-display="static" aria-haspopup="true" aria-expanded="false">
                <img id="nav-avatar" class="user-avatar rounded-circle mr-2" src="{{ $commonUserData['avatar'] }}" alt="User Avatar"></a>

                <div class="dropdown">
                
                <div class="dropdown-menu dropdown-user dropdown-menu-right">
                    <a class="dropdown-item lead" href="/{{ $commonUserData['handle'] }}">
                        <i class="far fa-user mr-2"></i>
                        <span>My Profile</span>
                    </a>
                    <a class="dropdown-item lead" href="/app/messages">
                        <i class="far fa-envelope-open-text mr-2"></i>
                        <span>Messages</span>
                    </a>
                    <a class="dropdown-item lead" href="/app/settings">
                        <i class="far fa-cog mr-2"></i>
                        <span>Settings</span>
                    </a>
                    <a class="dropdown-item lead d-lg-none" href="" data-toggle="modal" data-target="#redeem-sats-modal">
                        <i class="far fa-wallet mr-2"></i>
                        <span>Redeem BTC</span>
                    </a>
                    <a class="dropdown-item lead" href="/app/reward-history">
                       <i class="far fa-gift mr-2"></i>
                        <span>My Rewards</span>
                    </a>
                    <a class="dropdown-item lead" href="/logout?hash=<?=rand(0, 1000000);?>">
                        <i class="far fa-sign-out-alt mr-2"></i>
                        <span>Log out</span>
                    </a>
                </div>  

                </div>

            </div>

            @else

            <div class="dropdown nav-profile align-self-center ml-auto">

                <a class="" data-toggle="dropdown" href="#" role="button" data-display="static" aria-haspopup="true" aria-expanded="false">
                <span class="iconify h2 mb-0" data-icon="ant-design:login-outlined" data-inline="false"></span>
                </a>
 
                <div class="dropdown">
                 
                <div class="dropdown-menu dropdown-user dropdown-menu-right">
                  
                    <a class="dropdown-item lead" href="/login">
                        
                        <span>Login</span>
                    </a>
                    <a class="dropdown-item lead" href="/signup">
                        
                        <span>Sign Up</span>
                    </a>
               
                </div>  

                </div>

            </div>

            @endif
           
            
        </div> 

    </div>
</div>
 


