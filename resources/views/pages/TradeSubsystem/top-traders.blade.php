@extends('pages.TradeSubsystem.layout', 
[
    'title' => 'Crypto Parrot Leaderboard | Cryptocurrency Competition',
    'classes' => 'h-100',
    'html_class' => '',
    'description' => 'Trade your favorite cryptocurrencies on Crypto Parrot and win amazing prizes if you have the highest profit.',
	'poster' => 'assets/images/poster.jpg'
])  

@section('main')

    @parent

    @section('styles')
        @parent
        <link rel="stylesheet" href="{{ asset('assets/css/TradeSubsystem/leaderboard.css?v=2') }}">
    @endsection 

    @section('content')

        <div class="wrapper">

            <div class="sidebar">
                @include('pages.TradeSubsystem.common.sidebar') 
            </div>
            <div class="main">

                <div class="shade"></div>
                
                @include('pages.TradeSubsystem.common.header') 

                <main class="main-content pt-3 pb-5 py-lg-5">
                  <div class="px-3 px-lg-5">

                    <h5 class="mb-3 mb-lg-4 d-flex">
                        <span class="pr-lg-4 pr-2">Leaderboard</span>
                        <span class="ml-auto ml-lg-0">                       
                        <select id="leaderboard-select" class="select-2">
                            <option value="leaderboard_lifetime">All time best</option>
                            <option value="leaderboard_days30">Last 30 days</option>
                            <option value="leaderboard_days7">Last 7 days </option>
                        </select>
                        </span>                    
                    </h5>

                    @php
                        $data = [
                            [
                                'route' => 'days7',
                                'traders' => $top7DaysTraders
                            ],
                            [
                                'route' => 'days30',
                                'traders' => $top30DaysTraders
                            ], 
                            [
                                'route' => 'lifetime',
                                'traders' => $topLifeTimeTraders
                            ]                                                         
                        ];
                    @endphp 

                    @foreach($data as $array)
 
                         
                        <div id="leaderboard_{{$array['route']}}" data-route="{{$array['route']}}" data-page="2" class="leaderboard-panel @if($array['route'] == 'lifetime') d-block @else d-none @endif"> 
                            
                            @if(count($array['traders']) > 0)
                                <div class="row"> 
                                    @foreach($array['traders'] as $trader) 
                                        @php
                                            $trader['iteration'] = $loop->iteration;
                                        @endphp

                                        <div class="col-6 col-sm-12 col-md-4 col-lg-3 col-xl-2 mb-4">

                                            <div class="card h-100 card-hover card-leader">
                                            <div class="card-body text-center">
                                            
                                            <a class="leader-avatar" href="/{{$trader['handle']}}">
                                                <div class="position-relative">
                                                <span class="leader-rank font-weight-medium">{{$trader['iteration']}}</span>
                                                <img class="rounded-circle mw-100" src="{{ $trader['avatar'] }}" alt="User Avatar">
                                                </div>
                                            </a>

                                            <p class="mb-0 font-weight-bold leader-info mt-3">
                                                <a href="/{{$trader['handle']}}" class="smaller ellipsis">
                                                    {{ $trader['username'] }}
                                                </a>
                                            </p>  

                                            <div class="leader-stats">
                                                <p class="mb-0 text-purple-pale">{{$trader['tradesCount']}} Trades</p>
                                                <p class="mb-0 {{$trader['increaseClass']}}"> 
                                                    ${{$trader['claimed']}}
                                                </p>
                                                <small class="font-weight-medium">Play dollars exchanged</small>

                                                @if(Auth::check() && Auth::id() !== $trader['userId'])
                                                @if($trader['alreadyFollow'])
                                                    <a href="/app/unfollow/{{$trader['userId']}}" class="btn btn-dark mx-auto follow-unfollow-button unfollow-button">
                                                        Unfollow
                                                    </a>
                                                @else  
                                                    <a href="/app/follow/{{$trader['userId']}}" class="btn btn-secondary mx-auto follow-unfollow-button follow-button">
                                                        Follow
                                                    </a>
                                                @endif
                                                @else
                                                    @if(Auth::check() && Auth::id() == $trader['userId'])
                                                    <a href="/{{ $commonUserData['handle'] }}" class="btn btn-secondary mx-auto">
                                                        My profile
                                                    </a>
                                                    @endif
                                                @endif  

                                            </div>
                                            </div>
                                            </div>
                                                    
                                        </div>           

   

                
                                    @endforeach  
                                </div>
                            @else
                            <div class="card mb-4">
                            <div class="card-body">
                            <p class="lead text-center mb-0">Not enough data</p>
                            </div>
                            </div>
                            @endif 
                            
                        </div>   
                       

                    @endforeach
                      
            
                  </div>  
                </main>
            </div>

        </div>

    @endsection

    @section('body-scripts')
        @parent
        <script src="{{ asset('assets/js/TradeSubsystem/leaderboard.js') }}"></script>
    @endsection  

@endsection