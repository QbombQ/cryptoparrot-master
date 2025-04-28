@extends('pages.TradeSubsystem.layout', 
[
    'title' => $competitionData['data']['title'],
    'classes' => 'h-100',
	'html_class' => '',
    'description' => $competitionData['data']['description'],
	'poster' => $competitionData['data']['cover']
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


                


                <main class="main-content pt-3 pt-md-5 pb-5">

                    <div class="px-3 px-md-5">

                            <div class="row">



                                <div class="col-lg-5">

                                         @if (session('message'))
                                    @php 
                                        $response = json_decode(session('message'), true);
                                    @endphp
                                    <div class="alert comp-alert @if($response['success']) alert-success @else alert-danger @endif mb-3">
                                        {{ $response['message'] }}
                                    </div>

                                    @else

                                    @if($competitionData['data']['already_participates'])
                                        @if($competitionData['data']['status'] == 0)
                                        <span class="alert comp-alert alert-success d-block mb-3">Hooray! <strong>We will notify you once the competition starts.</strong></span> 
                                        @elseif($competitionData['data']['status'] == 1)
                                        <span class="alert comp-alert alert-success d-block mb-3"><strong>Competition is in progress, make sure you make smart trades</strong> Your position: {{$competitionData['myData']['myPosition']}}</span> 
                                        @else 
                                            <span class="alert comp-alert alert-warning d-block mb-3"><strong>Competition has been concluded. Your position: {{$competitionData['myData']['myPosition']}}</strong></span> 
                                        @endif 
                                    @endif  
                                    
                                    @endif 

                                    <div class="card overflow-hidden">
                                    <div class="card-body p-0">

                                        <div class="news-feed d-block">  

                                            <div class="thumbnail-lg position-relative" style="background-image: url({{$competitionData['data']['cover']}});"> 

                                                <div class="comp-logo">  <span class="text-purple-pale">Sponsored by:</span><div class="comp-logo-holder" style="background-image: url({{$competitionData['data']['logo']}});"></div></div>
                                            </div>  

                                        </div> 

                                        <div class="p-4">
                                        <h6 class="mb-3 font-weight-bold">{{$competitionData['data']['title']}}</h6>

                                        <p class="card-text mb-3">{!! $competitionData['data']['description'] !!}

                                        

                                        </p>

                                        <div class="mb-3">

                                             @if(!$competitionData['data']['already_participates'] && Auth::check() && $competitionData['data']['status'] < 2 && $competitionData['data']['is_private'] == 0)


                                            @if($competitionData['data']['password'])

                                            
                                             <form action="/app/competitions/{{$competitionData['data']['id']}}/participate" method="post" class="mb-2">
                                                @csrf
                                                <input autocomplete="off" required type="text" name="password" class="form-control mb-0 mt-3" placeholder="Enter password">
                                                <button type="submit" class="btn mt-2 btn-primary btn-lg">Join</button>
                                            </form>
                                             @else
                                             <a href="/app/competitions/{{$competitionData['data']['id']}}/participate" class="btn btn-primary btn-lg">Join</a>
                                             @endif 


                                    
                                            @endif 

                                            @if(Auth::guest())
                                            <a href="/signup" class="btn btn-secondary btn-lg mr-2">Sign Up</a>
                                            <a href="/login" class="btn btn-primary btn-lg mr-2">Login</a>
                                            @endif 

                                               <a href="" data-toggle="modal" data-target="#prizes-modal" class="btn btn-primary btn-lg d-block d-md-inline-block"><i class="far fa-trophy mr-2"></i> View Prizes</a>
                     

                                        </div>
                                            
                                            <span class="text-purple d-inline-block mr-3">
                                            <span class="iconify" data-icon="ant-design:clock-circle-outline" data-inline="false"></span>  {{$competitionData['data']['duration']}}

                                            





                                            </span>

                                            <span class="text-purple d-inline-block mr-3">
                                            <span class="iconify" data-icon="ant-design:calendar-outlined" data-inline="false"></span>

                                            @if($competitionData['data']['status'] == 0 && $competitionData['data']['end_date'])
                                            <span class="">Starts in</span>
                                            <span class="font-weight-bold">{{$competitionData['data']['starts_in']}}</span>
                                            @elseif($competitionData['data']['status'] == 1 && $competitionData['data']['end_date'])<
                                            <span class="">Ends on</span>
                                            <span class="font-weight-bold">{{$competitionData['data']['ends_in']}}</span>
                                            @elseif($competitionData['data']['status'] == 2)
                                            <span class="">Ended on</span>
                                            <span class="font-weight-bold">{{$competitionData['data']['end_date_formatted']}}</span>
                                            @endif 

                                            </span>
 
                                            <span class="text-purple d-inline-block mr-3">
                                            <span class="iconify" data-icon="ant-design:user-outlined" data-inline="false"></span> {{$competitionData['data']['participantsCount']}} participants
                                            </span> 

                                       
                                        </div>

                                    </div>
                                    </div> 


                                    <div class="mb-3 py-3 text-left small text-purple-pale">
                                        By participating in this competition you agree with <a data-toggle="modal" data-target="#rules-modal" href="" class="text-warning">the Rules of the Competition</a>
                                    </div>


                                  <script>

                                        var apple_rules = document.getElementById('apple_rules');

                                        if (window.webkit) {

                                            apple_rules.style.display = 'block';
                                            
                                        }else{

                                            apple_rules.style.display = 'none';
                                        } 
                 
                                  </script>



                                    <div id="apple_rules" style="display: none;" class="alert-warning alert mb-0">Please note Apple is not involved in any way with the trading competitions conducted on Niffler mobile app.</div>


                               
 
                                     @if(isset($competitionData['myData']))


                                       

                                        <div class="card card-small card-post mb-4">

                                                    <div class="p-4">
                                                        <h5 class="mb-4 mb-sm-3 font-weight-bold text-center text-sm-left">
                                                            Your stats
                                                            <small class="leaderbord-subheading mt-1 d-block text-muted font-weight-normal">
                                                                In order to win the competition you need to have highest percentage value increase in your portfolio. 
                                                            </small>
                                                        </h5>

                                                        <div class="row">
                                                            <div class="col-xl-6">   
                                                                <div class="card card bg-purple-gradient card-small card-post text-center p-4 mb-4">
                                                                <!-- +10.9% --><h2 class="font-weight-bold  text-white {{$competitionData['myData']['changeClass']}}  mb-0">@if($competitionData['data']['status'] > 0 && $competitionData['myData']['change']) {{ $competitionData['myData']['change'] }} @else n/a @endif</h2>  
                                                                <p class="mb-0 text-white">Value added since start</p>
                                                                </div>
                                                            </div>
                                                            <div class="col-xl-6">  
                                                                <div class="card bg-purple-gradient card-small card-post text-center p-4 mb-4">
                                                                    <!-- 1st --><h2 class="font-weight-bold text-white mb-0">@if($competitionData['data']['status'] > 0 && $competitionData['myData']['myPosition']) {{ $competitionData['myData']['myPosition'] }} @else n/a @endif</h2> 
                                                                    <p class="mb-0 text-white">Your position</p>
                                                                </div>
                                                            </div> 
                                                            <div class="col-xl-6">  
                                                                <div class="card bg-purple-gradient card-small card-post text-center p-4 mb-4 mb-xl-0">
                                                                    <!-- $210,000 --><h2 class="font-weight-bold text-success  mb-0">@if($competitionData['data']['status'] > 0 && $competitionData['myData']['current_portfolio_value']) {{ $competitionData['myData']['current_portfolio_value'] }} @else n/a @endif</h2>  
                                                                    <p class="mb-0 text-white">Portfolio value now</p>
                                                                </div>
                                                            </div>
                                                            <div class="col-xl-6">  
                                                                <div class="card bg-purple-gradient card-small card-post text-center p-4 mb-4 mb-xl-0">
                                                                    <h2 class="font-weight-bold text-white mb-0">@if($competitionData['data']['status'] > 0) {{ $competitionData['myData']['tradesCount'] }} @else n/a @endif</h2> 
                                                                    <p class="mb-0 text-white">Trades made since the start</p>
                                                                </div>
                                                            </div> 
                                                            <div class="col-12">
                                                                <small class="mt-3 mb-0 text-muted d-block">Portfolio value here includes profit/loss of any open short/long positions.</small>
                                                            </div>

                                                        </div>

                                                    </div>

                                        </div>

                                        
                                    @else

                                    <div class="card card-small card-post mb-4">
                                        <div class="p-4">
                                            
                                            <div class="text-center px-4 py-5">

                                                    <span class="iconify display-4" data-icon="ant-design:ellipsis-outline" data-inline="false"></span>
                                                
                                                    <p class="lead mb-0">No statistics available</p>
                                                    <a href="/app/comptetion" class="btn btn-primary btn-lg mt-4">All competitions</a> 

                                                </div>
                                        </div>
                                    </div>


                                    @endif

                                    @if(!$competitionData['data']['already_participates'] && Auth::check() && $competitionData['data']['status'] < 1 && $competitionData['data']['is_private'] == 0)
                                     <small class="leaderbord-subheading mb-3 mt-3 d-block text-purple-pale font-weight-normal">
                                            For each competition a brand new portfolio is created, so every participant starts with $100k in play dollars.

                                            <span class="font-weight-bold text-danger">Don't forget to switch to the appropaite portfolio when participating in a competition</span>
                                        </small> 
                                    @endif


                                </div>
                                <div class="col-lg-7">
                                    
                                    @if($competitionData['data']['status'] == 0)
                                    <h4 class="mb-4 mb-sm-3 font-weight-bold text-center text-sm-left">
                                        Participants 
                                        
                                    </h4>
                                @elseif($competitionData['data']['status'] == 1)
                                    <h4 class="mb-4 mb-sm-3 font-weight-bold text-center text-sm-left">
                                        Leaderboard 
                                       
                                    </h4>
                                @else
                                    <h4 class="mb-4 mb-sm-3 font-weight-bold text-center text-sm-left">
                                        Leaderboard 
                                       
                                    </h4>
                                @endif


                                @if($competitionData['data']['status'] == 1 || $competitionData['data']['status'] == 2)

                                <div class="card card-small card-post p-4 mb-3">
                                <h4 class="mb-0 h5">{{$competitionData['withoutTradesCount']}} users not yet started to trade</h4>
                                <p class="mb-0 text-purple-pale">Competition participants must make at least one trade to appear on the leaderboard</p>
                                </div>

                                  @endif

                                @if(count($competitionData['leaders']) > 0) 

                            
                                    @foreach($competitionData['leaders'] as $leader)
                                        <div class="card card-small card-post p-4 mb-3">
                                            
                                            <div class="row">

                                            <div class="col-xl-4 text-center text-xl-left">
                                                
                                                <h5 class="font-weight-bold mb-3 mb-xl-0">

                                                @if($leader['position'] != 'n/a') #{{$leader['position']}} @endif
                                        
                                                <a class="font-weight-normal" href="/{{$leader['handle']}}">

                                                <img src="{{$leader['avatar']}}" class="competition-avatar" />
                                                {{$leader['username']}}
                                                </a>         

                                                </h5>

                                            </div>
                                            <div class="col-6 text-right text-xl-left col-xl-3">
                                                
                                                <h5 class="font-weight-bold mb-0">
                                                    {{$leader['change']}}
                                                </h5>
                                            
                                            </div>
                                            <div class="col-6 col-xl-3">
                                                
                                                <h5 class="mb-0 ">
                                                    <i class="fal fa-exchange"></i> {{$leader['tradesCount']}}
                                                </h5> 
                                            
                                            </div>
                                            <div class="col-xl-2 text-center text-xl-left mt-3 mt-xl-0">
                                                
                                                <a href="/{{$leader['handle']}}" class="">View Profile <i class="ml-2 far fa-chevron-circle-right"></i></a>
                                            
                                            </div>

                                            </div>

                                        </div> 
                                    @endforeach
                                @else

                                  <div class="card card-small card-post mb-4">
                                        <div class="p-4">
                                            
                                            <div class="text-center px-4 py-5">

                                                    <span class="iconify display-4" data-icon="ant-design:ellipsis-outline" data-inline="false"></span>
                                                
                                                    <p class="lead mb-0">There are no participants yet.</p>
                                                  
                                                </div>
                                        </div>
                                    </div>

                                @endif

                            

                                @if(isset($competitionData['pagination']))
                                    {!! $competitionData['pagination'] !!}
                                @endif


                                </div>

                            </div> 

                           

                   

                    </div>

                </main>
            </div>
        </div> 

        <div id="prizes-modal" class="modal fade" role="dialog">
            <button type="button" class="close" data-dismiss="modal"><i class="fal fa-times"></i></button>
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content modal-content-center">
                    <div class="modal-body p-5">
                       <h5 class="mb-4 font-weight-bold">Competition prizes</h5>
                       {!! $competitionData['data']['prizes'] !!}
                    </div>
                </div>

            </div> 
        </div>  

        <div id="rules-modal" class="modal fade" role="dialog">
            <button type="button" class="close" data-dismiss="modal"><i class="fal fa-times"></i></button>
            <div class="modal-dialog modal-dialog-centered modal-lg">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-body p-5">
                       <h5 class="mb-4 font-weight-bold">Rules of the Competition</h5>
                        @include('pages.TradeSubsystem.common.competition-rules') 
                    </div>
                </div>

            </div> 
        </div>  


    @endsection

    @section('body-scripts')
        @parent
        <script src="https://unpkg.com/scroll-hint@latest/js/scroll-hint.min.js"></script>
        <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
        <script src="{{ asset('assets/js/TradeSubsystem/competition.js') }}"></script> 
    @endsection    


@endsection