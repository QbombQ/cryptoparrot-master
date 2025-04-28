<?php
    $array = [
        $title, $classes, $poster
    ];
    if(isset($canonical))
    {
        $array[] = $canonical;
    }
?>
@extends('pages.page-layout', $array)

@section('head-scripts')
    @parent
    @if(isset($articles))
        {!!$articles['relLinks']!!}
    @endif
  
@endsection

@section('styles')
    @parent
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/emoji/wdt-emoji-bundle.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/mentions/jquery.mentionsInput.css') }}">
@endsection


@section('before-content')

@if(!empty($header)) 
<div class="@if(!empty($header_outer_class)) {{$header_outer_class}} @endif px-0 px-sm-5">
  <div class="@if(!empty($header_class)) {{$header_class}} @endif px-3 px-sm-0">
  <div class="container-fluid">
    <nav class="navbar navbar-expand-xl @if(empty($header_colour)) navbar-dark @endif pt-4  px-0 justify-content-between">

        <a class="navbar-brand @if(!empty($header_class)) brand-colour @endif" href="/"> 
            @if(!empty($header_colour))
            <img src="{{ asset('assets/images/logo.svg') }}" class="" alt="">
            @else
            <img src="{{ asset('assets/images/logo-white.svg') }}" class="" alt="">
            @endif
        </a>  
        
        <ul class="navbar-nav d-none d-md-block d-xl-flex ml-auto order-xl-2">
          <li class="nav-item d-inline-block">
            <a href="/login" class="btn @if(empty($header_colour)) btn-light @else btn-secondary @endif btn-lg font-weight-bold">Login</a>
          </li>
          <li class="nav-item d-inline-block pl-3">
            <a href="/signup" class="btn @if(empty($header_colour)) btn-light @else btn-primary @endif btn-lg font-weight-bold">Sign Up</a> 
          </li>
        </ul> 

        <button class="navbar-toggler ml-3" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fal fa-bars"></i>
        </button>

        <div class="collapse navbar-collapse order-2 order-xl-1" id="navbarNavDropdown">
          
          <ul class="navbar-nav lead font-weight-medium text-center text-xl-left pt-5 pb-5 pb-sm-0 py-lg-0 mx-auto">
            <li class="nav-item active">
              <a id="how-it-works" class="nav-link" href="/">How it works?<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/news">News</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/app/leaderboard">Leaderboard</a>
            </li> 
            @if(env('APP_NAME') == 'fxparrot')
              <a class="nav-link" href="/app/markets">Markets</a>
              @else
              <a class="nav-link" href="/app/cryptocurrencies">Cryptocurrencies</a>
              @endif
            <li class="nav-item">
              <a class="nav-link" href="/app/rewards">Get Rewards</a>
            </li>
          </ul> 

          <div class="row justify-content-center d-md-none mt-4 mt-md-0">
            <div class="col-6 col-sm-5 col-md-3 pr-2">
              <a class="nav-link btn btn-block btn-light nav-btn text-center font-weight-bold" href="/login">Login</a>
            </div>
            <div class="col-6 col-sm-5 col-md-3 pl-2">
              <a class="nav-link btn btn-primary btn-block text-center font-weight-bold" href="/signup">Sign Up</a>
            </div>
          </div>

        </div>  

    </nav> 


    
    @yield('header-landing') 
   

  </div>
  </div>
</div>
@endif 
@endsection

@section('content')



@endsection

@section('body-scripts')
    @parent
    @include('pages.TradeSubsystem.common.emoji-bundle') 
    @if(Auth::check() && isset($commonUserData))
        <script>
            var myAvatar = "{{ $commonUserData['avatar'] }}";
            var myUsername = "{{ $commonUserData['username'] }}"; 
            var myHandle = "{{ $commonUserData['handle'] }}";
        </script>
    @else
        <script>
            var myAvatar = null;
            var myUsername = null; 
            var myHandle = null;
        </script>       
    @endif


    <div class="container-fluid pt-5">
        <div class="px-sm-5">
            <div class="row">
                <div class="col-xl-6 text-center text-xl-left mb-4 mb-xl-0">
                    <p class="font-weight-bold mb-4 px-4 pl-xl-0">Message us on Telegram:</p>

                    <a target="_blank" class="text-muted d-inline-block pr-3 pl-3 py-2" href="https://t.me/CryptoParrot">
                        <i class="fab fa-telegram-plane fa-2x"></i>
                    </a>

                </div> 
                <div class="col-xl-6 text-center text-xl-right">
                    <p class="font-weight-bold">Share with your friends and get rewards</p>

                    <a href="/signup" class="btn btn-secondary btn-lg font-weight-bold">Share the parrot</a>

                </div>

                <div class="col-xl-12 text-center text-lg-left d-lg-flex pt-5 pb-5">
                    <p class="text-muted d-inline d-lg-block mb-0">
                        <span class="pr-2">© {{ date('Y') }} {{ env('APP_NAME') }}</span>
                        <a href="/about" class="text-muted px-2">About</a> 
                        <a href="/faq" class="text-muted px-2">FAQ</a> 
                        <a href="/partnerships" class="text-muted px-2">Partnerships</a> 
                        <a href="/guide/sitemap/" class="text-muted px-2">Sitemap</a> 
                        <a href="/news" class="text-muted px-2">News</a> 
                        <a href="/contact" class="text-muted px-2">Contact</a> 
                    </p>
                    <p class="text-muted text-right d-inline d-lg-block ml-auto mb-0">
                         <a href="/login" class="text-muted px-2">Login</a> 
                         <a href="/signup" class="text-muted px-2">Sign Up</a> 
                         <a href="/tos" class="text-muted px-2">T&C’s</a> 
                         <a href="/privacy-policy" class="text-muted px-2">Privacy Policy</a> 
                         <a href="/disclaimer" class="text-muted pl-2">Disclaimer</a> 
                    </p>
                </div>  
 
    

            </div>
        </div>
    </div>
  

    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/77c1444f72.js" crossorigin="anonymous"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/3.8.0/lodash.min.js"></script>
    <script src="{{ asset('assets/js/plugins/mentions/jquery.mentionsInput.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/emoji/emoji.min.js') }}"></script> 
    <script src="{{ asset('assets/js/plugins/emoji/wdt-emoji-bundle.min.js') }}"></script>      
    <script src="{{ asset('assets/js/FrontSubsystem/article.js') }}"></script>    
    <script src="{{ asset('assets/js/FrontSubsystem/global.js') }}"></script>     
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/social-share-kit/1.0.15/js/social-share-kit.min.js"></script>
    <script type="text/javascript">
    SocialShareKit.init({ forceInit: true });
    </script>
@endsection