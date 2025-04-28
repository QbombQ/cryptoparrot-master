@extends('pages.TradeSubsystem.layout', 
[
    'title' => 'Step 2 out of 2 - Follow someone',
    'classes' => 'h-100',
    'html_class' => 'login-screen',
    'description' => '',
	'poster' => ''
])

@section('main')

    @parent

    @section('styles')
        @parent
        <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
        <link rel="stylesheet" href="{{ asset('assets/css/TradeSubsystem/follow-someone.css') }}">
    @endsection  


    @section('content')


        <!-- Event snippet for Sign Up conversion page -->
        <script>
        gtag('event', 'conversion', {'send_to': 'AW-774074798/Dei_CN3m55EBEK7jjfEC'});
        qp('track', 'CompleteRegistration');
        </script>


        <div class="container-fluid h-100">
        <div class="row h-100">
            <main class="main-content col">
            <div class="main-content-container container px-4 my-auto h-100">
                <div class="row no-gutters h-100">
                <div class="col-lg-8 col-md-11 col-12 mx-auto my-auto">

 
                    <a class="navbar-brand mt-5 d-block text-center pb-4" href="/"> 
                    <img src="{{ asset('assets/images/niffler-vector-logo-v2.svg') }}" class="" alt="">
                    </a>

                    <div class="card card-register">
                        <div class="card-body p-5">
                            @php
                                $toFollow = 3;
                                $leftToFollow = $toFollow - Auth::user()->followings->count();
                            @endphp
                            <script>
                                var toFollow = {{$toFollow}};
                                var totalFollowings = {{Auth::user()->followings->count()}};
                                var leftToFollow = {{$leftToFollow}};
                            </script>
                            <h4 id="follow-someone-heading" class="h3 card-title mb-4 text-center font-weight-bold">
                              Follow <span id="left-to-follow">3</span> traders
                            </h4>

                            @if ($errors->any())
                                <div class="alert alert-danger-outline alert-dismissible fade show mb-0 mt-2" role="alert">
                                @foreach ($errors->all() as $error)
                               
                                    <div><i class="fa fa-exclamation-circle"></i> 
                                    {{ $error }}</div>
                               
                                @endforeach
                                </div>
                            @endif


                            <div class="row">
                                <div class="col-md-6">

                                    <p class="lead mb-2">Top traders</p>

                                    @foreach($topTraders as $trader)
                                        <a data-id="{{$trader['userId']}}" href="/app/follow/{{$trader['userId']}}" class="btn-to-follow d-block follow-unfollow-button @if(!$trader['alreadyFollow']) follow-button @else disabled unfollow-button @endif follow-someone-page-button ">
                                            <img class="follow-avatar rounded-circle" alt="User Avatar" src="{{$trader['avatar']}}"> 
                                            <h6 class="font-weight-bold mb-0">{{ $trader['username'] }}</h6>
                                            <p class="mb-0">{{$trader['tradesCount']}} trades</p>
                                            <span class="early-follow">Follow</span>
                                            <i class="far fa-check"></i>
                                        </a>
                                    @endforeach

                                </div>
                                <div class="col-md-6">

                                    <p class="lead mb-2">Latest users</p>

                                    @foreach($latestTraders as $trader)
                                        <a data-id="{{$trader['userId']}}" href="/app/follow/{{$trader['userId']}}" class="btn-to-follow d-block follow-unfollow-button @if(!$trader['alreadyFollow']) follow-button @else disabled unfollow-button @endif follow-someone-page-button">
                                            <img class="follow-avatar rounded-circle" alt="User Avatar" src="{{$trader['avatar']}}">
                                            <h6 class="font-weight-bold mb-0">{{ $trader['username'] }}</h6>
                                            <p class="mb-0">{{$trader['tradesCount']}} trades</p>
                                            <span class="early-follow">Follow</span>
                                            <i class="far fa-check"></i>
                                        </a>
                                    @endforeach

                                </div>
                            </div>

                            <a id="proceed-to-platform" href="/app" class="btn @if(Auth::user()->followings->count() < 1) disabled @endif download btn-primary btn-lg btn-block mt-4"> Proceed to platform <i class="fal fa-arrow-right ml-1"></i></a>


                            </form>


                        </div>

                    </div>

                    <div class="text-center text-white mt-3 mb-5">
                        Step 2 out of 2.
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

        <script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
        <script src="{{ asset('assets/js/TradeSubsystem/follow-someone.js') }}"></script>  
    @endsection    


@endsection