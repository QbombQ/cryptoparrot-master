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
    @if(isset($competitions) && array_key_exists('relLinks', $competitions))
        {!!$competitions['relLinks']!!}
    @endif   
    @if(isset($profileData['trades']) && array_key_exists('relLinks', $profileData['trades']))
       <meta name="robots" content="noindex,follow"/>
    @endif   
    @if(isset($articles) && array_key_exists('relLinks', $articles))
        {!!$articles['relLinks']!!}
    @endif
@endsection

@section('styles')

    <link rel="stylesheet" href="{{ asset('assets/js/plugins/mentions/jquery.mentionsInput.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/emoji/wdt-emoji-bundle.css') }}">
    
    @parent

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>var currentFilter = null; var normalFavicon = '{{ asset("assets/images/favicon.png") }}'; var activeFavicon = '{{ asset("assets/images/favicon_active.png") }}';</script>

@endsection 

@section('content')

@endsection 

@section('body-scripts')
    @parent
    @include('pages.TradeSubsystem.common.emoji-bundle')  

    <div id="etoroDisclaimer" class="modal fade" role="dialog">

            <button type="button" class="close" data-dismiss="modal"><i class="fal fa-times"></i></button>

            <div class="modal-dialog modal-dialog-centered">

                <!-- Modal content-->
                <div class="modal-content">

                    <div class="modal-body">



                        <h5 class="mb-4 font-weight-bold">Disclaimer</h5>

                        @if($location->iso_code == 'US')
                        <p>Virtual currencies are highly volatile. Your capital is at risk</p>
                        @else
                        <p>66% of retail investor accounts lose money when trading CFDs with this provider. You should consider whether you can afford to take the high risk of losing your money.</p>
                        @endif

                        <a href="/etoro" class="btn btn-lg btn-primary btn-block" target="_blank" rel="nofollow">Visit eToro</a>
                        

                    </div>
                </div>

            </div>
        </div>    

 
    @include('pages.TradeSubsystem.modals.redeem')  
    @include('pages.TradeSubsystem.modals.avatar')  
    @include('pages.TradeSubsystem.modals.invite')  
    @include('pages.TradeSubsystem.modals.gif')  


    <script>
        var loadTrades = false;
        var listenForFollowings = false;
        var ownId = null;
        var unreadNotifications = 0;
        var unreadConversationsCount = 0;
        var loggedIn = false;
        var baseUrl = "{{ config('app.url') }}";
        var conversationsToListen = [];
        var myFeedOn = @if(isset($myFeedOn) && $myFeedOn) true @else false @endif;
    </script>       
    @if(Auth::check()) 
        <script>
            var loggedIn = true;
            var unreadConversations = JSON.parse("{{json_encode($commonUserData['unreadConversations'])}}");
            var conversationsToListen = JSON.parse("{{json_encode($commonUserData['conversations'])}}");
            var unreadConversationsCount = {{count($commonUserData["unreadConversations"])}};
            var myAvatar = "{{ $commonUserData['avatar'] }}";
            var myUsername = "{{ $commonUserData['username'] }}";
            var myHandle = "{{ $commonUserData['handle'] }}";
            var ownId = <?=Auth::id();?>;
        </script>
    @endif

    

    @if(Auth::check() && (Request::segment(1) == 'app') && !Request::segment(2))
        <script>
            var loadTrades = true;
            var listenForFollowings = true;
            var unreadNotifications = {{$commonUserData["unreadCount"]}};
        </script> 
    @endif 
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.2.0/socket.io.js"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script> 
    <script src="{{ asset('assets/js/plugins/dropzone/dropzone.js') }}"></script> 
    <script src="{{ asset('/assets/js/plugins/tinymce/tinymce.min.js') }}"></script>
   
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <script src="https://kit.fontawesome.com/77c1444f72.js" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/js/plugins/axios.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.12/js/select2.full.min.js"></script>
    <script src="https://unpkg.com/infinite-scroll@3.0.4/dist/infinite-scroll.pkgd.min.js"></script>
    <script type="text/javascript" src="https://s3.tradingview.com/tv.js"></script> 
    <script src="{{ asset('assets/js/echo.js') }}"></script> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/3.8.0/lodash.min.js"></script>
    <script src="{{ asset('assets/js/plugins/mentions/jquery.mentionsInput.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/emoji/emoji.min.js') }}"></script> 
    <script src="{{ asset('assets/js/plugins/emoji/wdt-emoji-bundle.min.js') }}"></script> 
    <script src="https://cdn.jsdelivr.net/npm/cleave.js@1.5.10/dist/cleave.min.js" integrity="sha256-lqWAcasN+EP6bxH3+SBODfrydkyHQ7FDwcI44sZeff4=" crossorigin="anonymous"></script>
 
    <script src="{{ asset('assets/js/TradeSubsystem/initTradingView.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/autocomplete/autocomplete.js') }}"></script>

    <script src="{{ mix('assets/js/TradeSubsystem/portfolio.js') }}"></script>
    <script src="{{ mix('assets/js/TradeSubsystem/rewards.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
    <!-- Optional: include a polyfill for ES6 Promises for IE11 and Android browser -->
    <script src="https://cdn.jsdelivr.net/npm/promise-polyfill@7/dist/polyfill.min.js"></script>
    
    <script src="{{ mix('assets/js/TradeSubsystem/common.js') }}?v=3"></script>
    
    
@endsection 