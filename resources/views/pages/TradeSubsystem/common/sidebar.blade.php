<a class="sidebar-brand d-block" href="@if(Auth::check()) /app @else / @endif">
    <img class="" src="{{ asset('assets/images/logo.svg') }}" alt="">
</a>  
 
<ul class="sidebar-nav"> 
    
    <li class="">
        <a class=" @if(!Request::segment(2) && Request::segment(1) == 'app') active @endif" href="/app">
        <span class="iconify" data-icon="ant-design:home-outline" data-inline="false"></span>
        <span>Home</span> 
        </a>
    </li>

    @if(Auth::check())
    <li class="">
        <a class=" @if(Request::segment(2) == 'my-trades') active @endif" href="/app/my-trades">
        <span class="iconify" data-icon="ant-design:sliders-outline" data-inline="false"></span>
        <span>My Trades</span>
        </a>
    </li>
    @endif

    @if(env('APP_FORK') == 'fxparrot')
    <li class="">
        <a class=" @if(Request::segment(2) == 'markets') active @endif" href="/app/markets">
        <span class="iconify" data-icon="ant-design:line-chart-outline" data-inline="false"></span>
        <span class="relative">Markets</span> 
        </a> 
    </li> 
    @else
    <li class="">
        <a class=" @if(Request::segment(2) == 'cryptocurrencies') active @endif" href="/app/cryptocurrencies">
        <span class="iconify" data-icon="ant-design:line-chart-outline" data-inline="false"></span>
        <span class="relative">Cryptocurrencies</span> 
        </a> 
    </li> 
    @endif 
     
    <li class=""> 
        <a class="" href="/articles/news">
        <span class="iconify" data-icon="ant-design:fire-outline" data-inline="false"></span>
        <span>News</span>
        </a>
    </li> 
    <li class=""> 
        <a class="" href="/guide/exchanges">
        <span class="iconify" data-icon="ant-design:thunderbolt-outlined" data-inline="false"></span>
        <span>Reviews</span>
        </a>
    </li>
    <li class="">  
        <a class="" href="/guide">
        <span class="iconify" data-icon="ant-design:experiment-twotone" data-inline="false"></span>
        <span>Guides</span>
        </a>
    </li>  
{{--    <li class="">--}}
{{--        <a class="@if(Request::segment(2) == 'rewards') active @endif" href="/app/rewards">--}}
{{--        <antd-icon type="gift-o"></antd-icon>--}}
{{--        <span class="iconify" data-icon="ant-design:gift-outline" data-inline="false"></span>--}}
{{--        <span>Rewards</span>--}}
{{--        </a>--}}
{{--    </li>  --}}
{{--    <li class="">--}}
{{--        <a class=" @if(Request::segment(2) == 'competitions') active @endif" href="/app/competitions">--}}
{{--        <span class="iconify" data-icon="ant-design:trophy-outline" data-inline="false"></span>--}}
{{--        <span>Competitions <span class="badge badge-pill badge-success ml-2">New</span></span>--}}
{{--        </a>--}}
{{--    </li>--}}
{{--    <li class="">--}}
{{--        <a class=" @if(Request::segment(2) == 'leaderboard') active @endif" href="/app/leaderboard">--}}
{{--        <span class="iconify" data-icon="ant-design:crown-outline" data-inline="false"></span>--}}
{{--        <span>Leaderboard</span>--}}
{{--        </a>--}}
{{--    </li>--}}

    <li class="">
    @if(env('APP_FORK') == 'cryptoparrot')
    <a class="lead position-relative" target="_blank" href="/crypto-moon">
    <svg aria-hidden="true" style="width: 20px;top: 32px;left: 34px;" focusable="false" data-prefix="fad" data-icon="moon-stars" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="svg-inline--fa fa-moon-stars fa-w-16 fa-2x"><g class="fa-group"><path fill="currentColor" d="M320 32L304 0l-16 32-32 16 32 16 16 32 16-32 32-16zm138.7 149.3L432 128l-26.7 53.3L352 208l53.3 26.7L432 288l26.7-53.3L512 208z" class="fa-secondary"></path><path fill="currentColor" d="M332.2 426.4c8.1-1.6 13.9 8 8.6 14.5a191.18 191.18 0 0 1-149 71.1C85.8 512 0 426 0 320c0-120 108.7-210.6 227-188.8 8.2 1.6 10.1 12.6 2.8 16.7a150.3 150.3 0 0 0-76.1 130.8c0 94 85.4 165.4 178.5 147.7z" class="fa-primary"></path></g></svg>
    <span>Crypto Moon 
    </a>
    </li>
    @endif

{{--    @if(Auth::check())--}}
{{--    <li class="">--}}
{{--        <a class="" href=""  data-toggle="modal" data-target="#invite-modal" >--}}
{{--        <span class="iconify" data-icon="ant-design:user-add-outline" data-inline="false"></span>--}}
{{--        <span>Invite & Earn $10</span>--}}
{{--        </a> --}}
{{--    </li>--}}
{{--    @endif --}}
 
 
    <li class="">
        <a class="" href="https://t.me/CryptoParrot" target="_blank">
        <svg style="width: 0.8em;" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="telegram-plane" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="svg-inline--fa fa-telegram-plane fa-w-14 fa-3x"><path fill="currentColor" d="M446.7 98.6l-67.6 318.8c-5.1 22.5-18.4 28.1-37.3 17.5l-103-75.9-49.7 47.8c-5.5 5.5-10.1 10.1-20.7 10.1l7.4-104.9 190.9-172.5c8.3-7.4-1.8-11.5-12.9-4.1L117.8 284 16.2 252.2c-22.1-6.9-22.5-22.1 4.6-32.7L418.2 66.4c18.4-6.9 34.5 4.1 28.5 32.2z" class=""></path></svg>
        <span>Official Telegram</span>
        </a>
    </li>

</ul>
<!-- End Main Sidebar -->

<div class="sidebar-dock-bottom">
<a href="/contact" target="_blank">Need Help? Get Support</a>
<p class="mb-0">&copy;{{ date('Y')}} {{ env('APP_NAME') }}</p> 
</div> 