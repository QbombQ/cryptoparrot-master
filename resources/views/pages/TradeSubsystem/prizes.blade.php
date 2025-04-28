@extends('pages.TradeSubsystem.layout', 
[
    'title' => 'Win amazing prizes by Trading cryptocurrencies | CryptoParrot',
    'classes' => 'h-100',
	'html_class' => '',
    'description' => 'Trade on our simulated cryptocurrency exchange and trade-in your play dollar profits for real rewards, like free bitcoin or swag.',
	'poster' => 'assets/images/poster.jpg'
])

@section('main')

    @parent

    @section('styles')
        @parent
        <link rel="stylesheet" href="{{ asset('assets/css/TradeSubsystem/rewards.css') }}">
    @endsection   

    @section('content')

        <div class="wrapper">

            <div class="sidebar">
                @include('pages.TradeSubsystem.common.sidebar') 
            </div>
            <div class="main">

                <div class="shade"></div>
                
                @include('pages.TradeSubsystem.common.header') 

                <main class="main-content py-5">
                  <div class="px-5">
                  </div>  
                </main>
            </div>

        </div> 

        <div class="container-fluid">
        <div class="row">

            @include('pages.TradeSubsystem.common.sidebar') 
            <main class="main-content col-xl-10 col-lg-9 col-md-9 col-sm-12 p-0 offset-xl-2 offset-lg-3 offset-md-3">

            @include('pages.TradeSubsystem.common.header') 
            <div class="main-content-container container-fluid px-4 pt-4 ">

             <div class="row">

             	<div class="col-12">
             		@if (session('message_success'))
                        <div class="alert mb-3 alert-success mb-3">
                            {{ session('message_success') }}
                        </div>
                	@endif 
                    @if (session('message_failed'))
                        <div class="alert mb-3 alert-danger mb-3">
                            {{ session('message_failed') }}
                        </div>
                	@endif 
             	</div>   



                <div class="col-xl-8 pb-4">

                    <div class="card-patron card bg-purple card-small">
                    <div class="card-trader-status"> 
                    <div class="card-body p-4 p-md-5"> 


                        <h4 class="h2 font-weight-bold text-white">Claim Rewards</h4>
                        <p class="mb-2 text-white lead">You can spend anything that you make in play dollars on awesome rewards sponsored by our partners.</p> 

                        <a href="/app/earn-money" class="btn btn-lg btn-primary mt-2">Learn more</a>
                           

                    </div>
                    </div>
                    </div>

                </div>

                <div class="col-xl-4">

                    <div class="row"> 

                        <div class="col-sm-6 col-xl-12">
                            <div class="card card-small p-4 mb-3 mb-sm-4 mb-xl-3">
                                <p class="lead mb-2">Available to redeem
                                    <a class="float-right"  data-toggle="tooltip" data-placement="right" title="" data-original-title="Earnings that will be paid out in the next payment cycle. Payment cycle is 30 days."><i class="fas fa-question-circle "></i></a> 
                                </p>
                                <h3 class="h2 text-grey mb-0 font-weight-bold">${{$amountLeft}}</h3>
                            </div>
 
                        <div class="">
                        <p class="mb-0 text-muted lead font-weight-bold">Information</p>
                        <p class="mb-0"><a href="">My Rewards History</a></p>
                        <p class="mb-0"><a href="">How to earn more play dollars?</a></p>
                        <p class="mb-0"><a href="">About Rewards</a></p>
                        <p><a href="">Terms and Conditions</a></p>
                        </div>
 
                        </div> 

                                  
                    </div>  

                </div>
                
                <div class="col-12">
                <div class="row">
			 	@if(count($rewards['rewards']) > 0)
					@foreach($rewards['rewards'] as $reward)
 

                        <div class="col-lg-4 mb-4">
                        <div class="card card-small  h-100">

                            <div class="position-relative">
                                <span style="bottom: 10px;right: 10px;position: absolute;z-index: 2;" class="badge badge-secondary">{{$reward['quantity']}} remaining</span>
                                <img style="border-top-right-radius: 3px;border-top-left-radius: 3px;" src="{{$reward['image']}}"/ alt="" class="mw-100">
                            </div>
                    
                          <div class="card-body">
                            <p class="lead font-weight-bold mb-0 p-2 text-center text-success">
                                    ${{$reward['price']}} 
                            </p>
                            <h5 class="card-title text-center mb-0">{{$reward['title']}}</h5>
                            <p class="card-text text-center mb-0 text-muted">{{$reward['description']}}</p>
                          </div>
                          <div class="card-footer pt-0">
                    
                                <a href="/app/rewards/buy/{{$reward['id']}}" class="btn btn-white btn-lg btn-block">Claim Reward</a>

                                @if(array_key_exists('sponsor', $reward))
                                    <small class="d-block text-center text-muted d-block mt-2">Sponsored by {{$reward['sponsor']['title']}}</small>
                                @endif 
                       
                          </div> 
                        </div>
                        </div> 

					@endforeach

                    @foreach($rewards['rewards'] as $reward)
 

                        <div class="col-lg-4 mb-4">
                        <div class="card card-small  h-100">

                            <div class="position-relative">
                                <span style="bottom: 10px;right: 10px;position: absolute;z-index: 2;" class="badge badge-secondary">{{$reward['quantity']}} remaining</span>
                                <img style="border-top-right-radius: 3px;border-top-left-radius: 3px;" src="{{$reward['image']}}"/ alt="" class="mw-100">
                            </div>
                    
                          <div class="card-body">
                            <p class="lead font-weight-bold mb-0 p-2 text-center text-success">
                                    ${{$reward['price']}} 
                            </p>
                            <h5 class="card-title text-center mb-0">{{$reward['title']}}</h5>
                            <p class="card-text text-center mb-0 text-muted">{{$reward['description']}}</p>
                          </div>
                          <div class="card-footer pt-0">
                    
                                <a href="/app/rewards/buy/{{$reward['id']}}" class="btn btn-white btn-lg btn-block">Claim Reward</a>

                                @if(array_key_exists('sponsor', $reward))
                                    <small class="d-block text-center text-muted d-block mt-2">Sponsored by {{$reward['sponsor']['title']}}</small>
                                @endif 
                       
                          </div> 
                        </div>
                        </div> 

                    @endforeach

                    <div class="col-lg-4 mb-4">
                    <div class="card card-small h-100">
                        <div class="d-flex h-100">
                        <div class="align-self-center w-100 text-center">
                            <p class="lead mb-0 text-muted">Become a sponsor</p>
                        </div>
                        </div>
                    </div>
                    </div>

                    <div class="col-lg-4 mb-4">
                    <div class="card card-small h-100">
                        <div class="d-flex h-100">
                        <div class="align-self-center w-100 text-center">
                            <p class="lead mb-0 text-muted">Become a sponsor</p>
                        </div>
                        </div>
                    </div>
                    </div>

				@endif	
                </div>
                </div>

                @if($rewards['pagination'])
				<div class="col-12 mb-3">{!! $rewards['pagination'] !!}</div>
                @endif 
                

                
        	  </div>

            </div>
            @include('pages.TradeSubsystem.common.footer')
            </main>
        </div>
        </div>

    @endsection

@endsection