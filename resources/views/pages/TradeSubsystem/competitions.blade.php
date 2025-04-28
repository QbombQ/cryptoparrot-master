@extends('pages.TradeSubsystem.layout', 
[
    'title' => 'Crypto currency trading competitions | Crypto Parrot',
    'classes' => 'h-100',
	'html_class' => '',
    'description' => 'Win amazing prizes by Trading your Favorite cryptocurrencies using demo money. Trade without the risk of using real money and win amazing prizes.',
	'poster' => 'assets/images/poster.jpg'
])

@section('main')

    @parent

    @section('styles')
        @parent
        <link rel="stylesheet" href="https://unpkg.com/scroll-hint@latest/css/scroll-hint.css">
        <link rel="stylesheet" href="{{ asset('assets/css/TradeSubsystem/competition.css') }}">
    @endsection  

    @section('content')

        <div class="wrapper">

            <div class="sidebar">
                @include('pages.TradeSubsystem.common.sidebar') 
            </div>
            <div class="main">

                <div class="shade"></div>
                 
                @include('pages.TradeSubsystem.common.header') 

                <main class="main-content main-content-md pt-3 pt-lg-5 pb-5">
                  <div class="px-3 px-lg-5">

                    <div id="apple_rules" style="display: none;" class="alert-warning alert mb-0">Please note Apple is not involved in any way with the trading competitions conducted on Crypto Parrot mobile app.</div>
                    <script>

                        var apple_rules = document.querySelector('#apple_rules');

                        if (window.webkit) {

                            apple_rules.style.display = 'block';
                            
                        }else{

                            apple_rules.style.display = 'none';
                        } 

                  </script>

                  <div class="row">

                <div class="col-12">
                    @if (session('message'))
                        @php 
                            $response = json_decode(session('message'), true);
                        @endphp
                        <div class="alert  @if($response['success']) mb-3 alert-success @else alert-danger @endif mb-3">
                            {{ $response['message'] }}
                        </div>
                    @endif 
                </div>    


                {{-- <div class="col-xl-12 pb-4"> 
                    <div class="card overflow-hidden h-100">
                    <div class="card-body p-0">

                        <div class="row">
                        <div class="col-lg-6">
                        <a href="https://tradeor.com/25k-to-the-top-trading-competition/?refid=033a52e5&cmp=001" class="news-feed h-100 d-flex w-100">  

                            <div class="thumbnail-lg position-relative d-flex h-100 w-100" style="min-height:300px;background-image: url(/assets/images/tradeor.svg);background-size: contain;background-repeat: no-repeat;background-color: #201F42"> 
                            </div>  

                        </a>
                        </div> 
                        <div class="col-lg-6">

                        <div class="p-4 py-5">

                        <a href="https://tradeor.com/25k-to-the-top-trading-competition/?refid=033a52e5&cmp=001">
                        <img src="/assets/images/tradeorlogo.svg" class="mb-4" style="width: 250px;">
                        </a>

                        <h5 class="mb-3 font-weight-bold">Are you Ready for the Next Step?</h5>

                        <p class="card-text mb-0">
                                Put your strategy to work, trade with 0% commission, and feel the rush of real markets. PLUS win 1 of 3 great prizes while doing it! Prize pool of $25K!
                        </p>
                            
                        <a href="https://tradeor.com/25k-to-the-top-trading-competition/?refid=033a52e5&cmp=001" class="btn mt-4 btn-primary btn-lg">Join competition</a>
                     
                       
                        </div>

                        </div>
                        </div>

                    </div>
                    </div>
                </div> --}}


                @if(count($competitions['competitions']) > 0)
                @foreach($competitions['competitions'] as $competition)

                <div class="col-xl-6 pb-4 @if($competition['status'] == 2) comp-ended @endif"> 
                    <div class="card overflow-hidden h-100">
                    <div class="card-body p-0">

                        <a href="/app/competitions/{{$competition['id']}}" class="news-feed d-block">  

                            <div class="thumbnail-lg position-relative" style="background-image: url({{$competition['cover']}});"> 

                                <div class="comp-logo">  <span class="text-purple-pale">Sponsored by:</span><div class="comp-logo-holder" style="background-image: url({{$competition['logo']}});"></div></div>
                            </div>  

                        </a> 

                        <div class="p-4">
                        <h6 class="mb-3 font-weight-bold">{{$competition['title']}}</h6>

                        <p class="card-text mb-3">{!! $competition['description'] !!}

                            {{-- 
                            <span class="stats-label">Status:</span>
            
                            @if($competition['status'] == 0)
                            Open for registration
                            @elseif($competition['status'] == 1)
                            In Progress
                            @elseif($competition['status'] == 2)
                            Competition has ended
                            @endif

                            --}}

                        </p>
                            
                            <span class="text-purple d-inline-block mr-3">
                            <span class="iconify" data-icon="ant-design:clock-circle-outline" data-inline="false"></span>  {{$competition['duration']}}

                            


                          

                            </span>

                            <span class="text-purple d-inline-block mr-3">
                            <span class="iconify" data-icon="ant-design:calendar-outlined" data-inline="false"></span>

                            @if($competition['status'] == 0 && $competition['end_date'])
                            <span class="">Starts in</span>
                            <span class="font-weight-bold">{{$competition['starts_in']}}</span>
                            @elseif($competition['status'] == 1 && $competition['end_date'])<
                            <span class="">Ends on</span>
                            <span class="font-weight-bold">{{$competition['ends_in']}}</span>
                            @elseif($competition['status'] == 2)
                            <span class="">Ended on</span>
                            <span class="font-weight-bold">{{$competition['end_date_formatted']}}</span>
                            @endif 

                            </span>

                            <span class="text-purple d-inline-block mr-3">
                            <span class="iconify" data-icon="ant-design:user-outlined" data-inline="false"></span> {{$competition['participantsCount']}} participants
                            </span> 


                            <div class="d-block">
                            @if(!$competition['already_participates'] && Auth::check() && $competition['status'] < 2 && $competition['is_private'] == 0)

                                 @if($competition['password'])
                                 <form action="/app/competitions/{{$competition['id']}}/participate" method="post">
                                    @csrf
                                    <input autocomplete="off" required="" type="text" name="password" class="form-control mb-2 mt-3" placeholder="Enter password">
                                    <button type="submit" class="btn mt-3 btn-primary  btn-lg">Join</button>

                                    @if($competition['status'] == 1)
                                    <a href="/app/competitions/{{$competition['id']}}" class="btn mt-3 ml-3 btn-secondary btn-lg">View</a>
                                    @endif 


                                </form>
                                 @else
                                 <a href="/app/competitions/{{$competition['id']}}/participate" class="btn mt-3 btn-primary d-block btn-lg">Join</a>
                                 @endif 

                               
                            @else

                            @if($competition['status'] == 1)
                                <a href="/app/competitions/{{$competition['id']}}" class="btn mt-4 btn-primary btn-lg">View</a>
                            @endif 

                            @endif

                            </div> 
                       
                        </div>

                    </div>
                    </div>
                </div> 

                @endforeach
                @else


                <div class="col-xl-12 pb-4"> 

                    <h5 class="mb-3">Trading competitions</h5>

                <div class="card">
                <div class="card-body">
                    <div class="p-5 text-center lead">Coming soon!</div>
                </div> 
                </div>
                </div>

                @endif  
      
                <div class="px-0 px-lg col-12 mb-3">{!! $competitions['pagination'] !!}</div>

              </div>

                  </div>  
                </main>
            </div>

        </div>


    @endsection

@endsection