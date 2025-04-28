@extends('pages.TradeSubsystem.layout', 
[
    'title' => 'Notifications',
    'classes' => 'h-100',
    'html_class' => '',
    'description' => '',
	'poster' => ''
])

@section('main')

    @parent

    @section('content')
 
        <div class="wrapper">

            <div class="sidebar">
                @include('pages.TradeSubsystem.common.sidebar') 
            </div>
            <div class="main">

                <div class="shade"></div>
                
                @include('pages.TradeSubsystem.common.header') 

                <main class="main-content pt-3 py-lg-5">
                  <div class="px-3 px-lg-5">

                    @if(isset($notifications['data']) && count($notifications['data']) > 0)
                    <div class="row">
                    <div class="col-xl-7">
                        @foreach($notifications['data'] as $notification) 

                            <div class="card mb-3">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="icon-holder pr-3"><div class="notification-icon"><i class="far {{$notification['icon']}}"></i></div></div>
                                    <div class="notification-holder">
                                        <span class="notification__category font-weight-bold">@if($notification['status'] == 'unread')<i class="far fa-circle text-success mr-1"></i>@endif {{ $notification['title'] }}</span>
                                        <p class="mb-0 small">{{ $notification['text'] }}</p>
                                        <small class="text-muted d-block"> {{$notification['date']}}</small>
                                    </div>
                                    <div class="more-holder small align-self-center ml-auto">
                                        <a href="{{$notification['url']}}" class="view-notification">
                                            <span class="view-notification no-wrap ml-3 font-weight-bold">View</span></a></div>
                                </div>
                            </div>
                            </div>
                           
                            
                            @endforeach
                        

                        @if(isset($notifications['pagination']))
                            {!! $notifications['pagination'] !!}
                        @endif
                    </div>
                    <div class="col-xl-5 pb-5 pb-lg-0">
                          
                        <div class="pb-4 pb-lg-0">
                        <div class="card bg-purple-gradient">
                        <div class="">
                        <div class="card-body p-5">  


                            <h4 class="lead mb-3 font-weight-bold text-white">About Notifications</h4>
                            <p class="mb-3 text-white">Notifications are updates and information sent to you, alerting you to what’s happening on the Crypto Parrot platform. </p>
                            <p class="mb-3 text-white">You can choose which notifications you want to receive by clicking button below.</p>

                            <a href="/app/settings#notification-preferances" class="btn btn-lg btn-primary mt-2">Settings</a> 
                               

                        </div>
                        </div>
                        </div>
                        </div>

                    </div>
                    </div>
                    @else

                    <div class="row">
                    <div class="col-8 d-flex">

                        <div class="align-self-center w-100">
                                <h2><i class="fal fa-bell text-grey"></i></h2>
                              <h3 class="font-weight-bold text-grey">There are no notifications</h3>
                              <p class="text-grey">Notifications are for active traders. Maybe try posting a trade?</p> 
                              <button type="button" class="btn btn-primary btn-lg"><i class="far fa-exchange-alt mr-2 "></i> Post a trade</button>
                        </div>

                    </div>
                    </div>

                    @endif

                  </div>  
                </main>
            </div>

        </div>

  

    @endsection

@endsection