<?php
    $array = [
        'title' => 'Exchange your play dollars profits for awesome rewards. It\'s free.',
        'classes' => 'h-100',
        'html_class' => '',
        'description' => 'Trade on our simulated cryptocurrency exchange and trade-in your play dollar profits for real rewards, like free bitcoin or swag.',
        'poster' => 'assets/images/rewards-poster.jpg?v2'
    ];
    if(isset($canonical))
    {
        $array['canonical'] = $canonical;
    }
?>


@extends('pages.TradeSubsystem.layout', $array)

@section('main')

    @parent

    @section('styles')
        @parent
        <link rel="stylesheet" href="{{ asset('assets/css/TradeSubsystem/rewards.css') }}">
    @endsection   

    @section('content')

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
                    <div class="card-body p-5"> 

                        <h4 class="h2 font-weight-bold text-white mt-xl-3">Claim your Rewards</h4>
                        <p class="mb-2 text-white lead">Use the play dollar “profits” you made from your trades to claim awesome rewards from our sponsors.</p> 

                        <a href="#" data-toggle="modal" data-target="#aboutModal" class="btn btn-lg btn-primary mt-2 mb-xl-3">Learn more</a>

                    </div>
                    </div>
                    </div>

                </div>

                <div class="col-xl-4">

                    <div class="row"> 

                        <div class="col-sm-6 col-xl-12">
                            <div class="card card-small p-4 mb-3 mb-sm-4 mb-xl-3">
                                <p class="lead mb-2">Eligible profits
                                    
                                </p>
                                <h3 class="h2 text-grey mb-2 font-weight-bold">${{$eligibleAmountLeft}}</h3>
                                <p style="font-size: 12px;" class="text-success mb-0"><a class="" data-toggle="tooltip" data-placement="right" title="" data-original-title="This is the amount of “play dollar profit” above the original $100k in play USD that you are able to redeem for a reward. E.g. If you have 20BTC that are worth 200k and 150k in play dollars (total portfolio value 350k) your redeemable profits will be 50k. To convert BTC into redeemable dollars you need to sell it for play USD and make sure that you have 100k or more play dollars already available.">Of which <span class="font-weight-bold">${{$amountLeft}}</span> is available to redeem. <i class="fas fa-question-circle "></i></a></p>
                            </div>  
 
                        <div class="">
                        <p class="mb-0 text-muted lead font-weight-bold">Information</p>
                        @auth
                            <p class="mb-0"><a href="/app/reward-history">My Rewards History</a></p>
                        @endif
                       <!-- <p class="mb-0"><a href="/app/earn-play-dollars">How to earn more play dollars?</a></p> -->
                        <p class="mb-0"><a data-target="#aboutModal"  data-toggle="modal" href="#">About Rewards</a></p>
                        <p><a target="_blank" href="/tos#rewards">Terms and Conditions</a></p> 
                        </div>
 
                        </div> 

                                  
                    </div>  

                </div>
                
                <div class="col-12">
                    <div class="row">
                
                            @foreach($possibleExchanges as $symbol => $rate)
        

                                <div class="col-md-6 col-lg-6 col-xl-4 mb-4">
                                    <div class="card card-small  h-100">
                                
                                        <div class="card-body">
                                            <p class="lead font-weight-bold mb-0 p-2 text-center text-success">
                                                    $10K = {{sprintf('%f', $rate)}} 
                                            </p>
                                            <h5 class="card-title text-center mb-0">{{$symbol}}</h5>
                                        </div>
                                        <div class="card-footer pt-0">

                                                @auth
                                    
                                                    <a data-toggle="modal" data-target="#exchangeModal{{$symbol}}" class="btn btn-white btn-lg btn-block exchange-modal-button">Exchange</a>

                                                @else

                                                    <a href='/signup' class="btn btn-white btn-lg btn-block claim-reward">Sign up</a>

                                                @endif
                                    
                                        </div> 
                                    </div>
                                </div> 

                                <div id="exchangeModal{{$symbol}}" class="modal fade" role="dialog">

                                    <button type="button" class="close" data-dismiss="modal"><i class="fal fa-times"></i></button>

                                    <div class="modal-dialog">

                                        <!-- Modal content-->
                                        <div class="modal-content">

                                            <div class="modal-body">

                                                <h5 class="mb-4 font-weight-bold">Exchange {{$symbol}}</h5>
                                                

                                                <div class="row">

                                                    <div class="col-12">

                                                        <form class="exchange-form" method="post" action="">

                                                            <input type="number" name="amount" class="form-control" placeholder="AMOUNT YOU WANT TO SPEND">
                                                            <input type="text" name="invoice_address" class="form-control" placeholder="INVOICE ADDRESS">
                                                            <input type="hidden" name="exchange_to" value="{{$symbol}}">
                                                            <button type="submit" class="btn btn-primary">Exchange</button>

                                                        </form>

                                                        <p class="exchange-order-errors mt-4 mb-0"></p>

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>       


                            @endforeach

                    </div>
                </div>
                
        	  </div>

            </div>
            @include('pages.TradeSubsystem.common.footer')
            </main>
        </div>
    </div>


    <div id="aboutModal" class="modal fade" role="dialog">

        <button type="button" class="close" data-dismiss="modal"><i class="fal fa-times"></i></button>

        <div class="modal-dialog modal-lg">

            <!-- Modal content-->
            <div class="modal-content">

                <div class="modal-body">

                    <h5 class="mb-4 font-weight-bold">About Rewards</h5>

                    <h4>What is the Niffler.co Rewards program?</h4>

                    <p>The Niffler Rewards program is an exciting NEW and FREE feature we introduced in early 2019 and is designed to reward traders for showing they're continued interest to learn or hone their trading skills, and rewards them for doing so with unique crypto related products, services and even real crypto. 
                    </p> 

                    <h4>How does the Niffler.co Rewards program work?</h4>

                    <p>By default every new registered user/trader on Niffler.co is given $100k USD in play dollars to start with in their portfolio.</p>

                    

                    <p>Once the eligibility threshold of 10 trades while also maintaining a 0.05% average profit margin per trade is met by any given trader, they are now eligible to exchange the profit they have accrued over and above the original $100k in play USD for their choice of reward within the *rewards tiered structure.</p>

                    <p>Example: Trader 1 starts with the default $100k USD in play dollars. Over the next several days Trader 1 has made 10 trades while also maintaining a 0.05% average profit margin per trade on any given token(s) and has grown their portfolio to $175K USD in play dollars. Because Trader 1 has met the mandatory eligibility of “10 trades” and maintaining a 0.05% average profit margin per trade they are now able to use their profit of $75k USD play dollars to purchase a reward.</p>

                    <p>* Rewards are tiered based on their value and ONLY purchasable with accrued profit made above the original $100k USD in play dollars. </p> 

                    <h4>How does the Niffler.co Rewards program work?</h4>

                    <p>Congratulations, you've shown you got the chops to trade with the best of them can make a profit in play dollars...now its time to claim your reward(s)! </p>

                    <p>Simply head on over to the rewards page here, select the desired tiered reward you would like based on the amount of profit you have accrued over while successfully trading and follow the instructions. Everything else is automated. </p> 

                    <h4>How does cashing out my profit of play dollars effect my portfolio?</h4>

                    <p>Once you exchange your profit play dollars, for a reward your portfolio will returned to the original $100k USD play dollars and/or plus anything that may be left over.</p>

                    <p>Example: Trader 1 starts with the default $100k USD in play dollars. Over the next several days Trader 1 has made 10 trades on any given token and has grown their portfolio to $175K USD in play dollars.</p>

                    <p>Because Trader 1 has met the mandatory eligibility of “10 trades” they are now able to use their profit of $75k USD play dollars to purchase a reward.</p>

                    <p>Example 1.1: If Trader 1 exchanges all of his profit for a reward valued at $75k USD his portfolio will be reset to $100k USD in play dollars.</p>

                    <p>Example 1.1: If Trader 1 exchanges only $25k USD of his profit for a reward valued at $25k USD his portfolio will be reset to $150k USD in play dollars.</p>

                    <p>Example 1.3: If Trader 1 exchanges only $50k USD of his profit for a reward valued at $50k USD his portfolio will be reset to $125k USD in play dollars.</p>

                    <p>And so on....</p>

                    <h4>What are the rules for the rewards program?</h4>

                    <p>You can find the full Niffler.co Rewards Program Rules here.</p>
 
                    <p class="font-weight-bold mb-0">I want to sponsor a reward, how can I do that?</p>
 
                    <p>Great! You can reach us through out contact us page found here. Don't forget to let us know who you are and what you have in mind.</p>

                    <p class="font-weight-bold mb-0">I have a question, suggestion or feedback about the Rewards program, how do I contact you?</p>

                    <p>We love suggestions and feedback and welcome all questions! You can contact us through our contact us page and form found here.</p> 


                    <button data-dismiss="modal" class="btn btn-primary btn-lg">Close</button>

                </div>

            </div>

        </div>

    </div> 

    @endsection

@endsection