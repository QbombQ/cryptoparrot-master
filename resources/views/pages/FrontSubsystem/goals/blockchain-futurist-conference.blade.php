@extends('pages.FrontSubsystem.layout',[
    'title' => 'Blockchain Futurist Conference - Trading Competition',
    'classes' => 'shards-landing-page--1 goal-landing',
    'landing' => true, 
    'description' => 'You\'ve been personally invited by the Blockchain Futurist Conference to participate in their 48hr Top Trader Competition on Niffler.co',
    'nofollow'=>true,
    'poster' => 'assets/images/bfc_on_niffler.jpg',
    'html_class'=>''   
])  

@section('main') 

    @parent

    @section('content')

        @php
    
          $goal = 1000;
          $total = $totalRegisteredWithCode; 
          $percentage = $total * 100 / $goal;
          $totalRegisteredWithCode = $totalRegisteredWithCode + 6;

        @endphp 

        <!-- Welcome Section -->
        <div class="welcome goal-landing-top">
            <div class="container"> 
            <!-- Navigation -->
            <nav class="navbar navbar-expand-lg navbar-dark pt-4 px-3 px-sm-0">
                <a class="navbar-brand" href="/"> 
                <img src="{{ asset('assets/images/niffler-vector-logo-v2-white.svg') }}" class="mr-2" alt="">
                </a>
                
                <ul class="navbar-nav d-none  d-sm-block d-lg-flex ml-auto order-lg-2">
                  <li class="nav-item d-inline-block">
                    <a class="nav-link" href="/login">Login</a>
                  </li>
                  <li class="nav-item d-inline-block">
                    <a class="nav-link nav-btn ml-3" href="/signup">Sign Up</a>
                  </li>
                </ul> 

                <button class="navbar-toggler ml-3" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fal fa-bars"></i>
                </button>

                <div class="collapse navbar-collapse order-2 order-lg-1" id="navbarNavDropdown">
                  
                  <ul class="navbar-nav text-center text-lg-left pt-5 pb-5 pb-sm-0 py-lg-0">
                    <li class="nav-item active">
                      <a class="nav-link" href="/">How it works?<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="/news">News</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="/app/leaderboard">Leaderboard</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="/app/earn-money">Earn Money</a>
                    </li>
                  </ul> 

                  <div class="row justify-content-center d-sm-none">
                    <div class="col-6 col-sm-5 col-md-3 pr-2">
                      <a class="nav-link btn-block nav-btn text-center font-weight-bold" href="/login">Login</a>
                    </div>
                    <div class="col-6 col-sm-5 col-md-3 pl-2">
                      <a class="nav-link btn btn-primary btn-block text-center font-weight-bold" href="/signup">Sign Up</a>
                    </div>
                  </div>

                </div> 
                  

            </nav> 
            <!-- / Navigation -->
            </div> <!-- .container -->



                     <div style="background: #000;" class="dgb-row text-center pb-4 mt-3 pt-4 pb-5"> 
                        
                          <img style="max-width: 600px" src="{{ asset('assets/images/bfc.png') }}">

                        
                      </div>  

            <!-- Inner Wrapper --> 
            <div class="inner-wrapper mt-auto mb-auto container">
            <div class="row px-3 px-sm-0 pt-lg-5 pb-5">
                <div class="col-lg-7">
                    
                    <div class="pr-lg-3">


                    <h1 class="h1 welcome-heading mb-4 mt-5 mt-lg-0 text-white ">Congratulations!
                    </h1> 

                    

                    <p class="text-white  lead mb-3"> You've been personally invited by the Blockchain Futurist Conference to participate in their 48hr Top Trader Competition on Niffler.co</p>   

                    <p class="text-white  mb-3">Compete with fellow cryptocurrency traders personally invited by the Blockchain Futurist Conference within a completely safe & FREE simulated crypto trading environment! As a top performing trader topping the leaderboard at the end of 48hr conference competition, you have an opportunity to win amazing prizes like xxxxx xxxxxx xxxxxx and xxxxx xxxxx.</p>

                    <p class="text-white   mb-3">The Blockchain Futurist Conference Top Trader Competition is a fun and unique way for conference attendees to network and learn more about blockchain and crypto through their own educational, risk free simulated crypto trading competition.</p>

                    <p class="text-white  mb-3">In order to take part in the amazing Blockchain Futurist Conference Top Trader Competition register via the form on the right and before 12pm EST August 11th.</p>
      
      				<p style="color: #2894e6;" class="font-weight-bold">{{ $totalRegisteredWithCode }}  participants already joined.</p> 

                    
                  
 
                  
                    </div>
       
                </div> 
                
                <div class="col-lg-5">
 
                  

                    <div class="card card-register mb-5">
                        <div class="card-body py-5 px-4 p-sm-5">
                            

                            @if (session('message'))

                            <h4 class="card-title mb-0">You are almost there!</h4>
                            <p class="lead mb-3"></p>

                            {{ session('message') }}

                            @else

                            <h4 class="h4 card-title mb-4 text-center font-weight-bold">
                              Sign up to <br /> 
                              enter the competition.
                            </h4>
                     
                            <form method="post" id="register" class="" action="/register">
                                @csrf
                                <div class="input-group input-group-seamless mb-2">
                                    <span class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="far fa-at"></i>
                                        </span>
                                    </span>
                                    <input autocomplete="email" type="email" class="form-control" name="email" id="form1-email" value="{{ old('email') }}" placeholder="Email">
                                </div>
    
                                <div class="input-group input-group-seamless mb-2">
                                    <span class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="far fa-lock-alt"></i>
                                        </span>
                                    </span>
                                    <input type="password" class="form-control" name="password" id="form1-password" placeholder="Password">
                                </div>
                    
                                    
                                <button type="submit" class="btn download btn-primary btn-block btn-lg font-weight-bold">
                                  Create Account <i class="far fa-sign-in-alt ml-1"></i>
                                </button>
                                <a class="btn btn-outline-secondary btn-block btn-lg font-weight-bold btn-login" href="/social/google" rel="nofollow noopener">
                                  <img src="{{ asset('assets/images/gplus.svg') }}" alt="" /> Sign up with Google</a> 

                                <a href="/signup" class="text-muted d-block text-muted text-center mt-3">More sign up options <i class="fal fa-angle-down ml-2"></i></a> 

                            </form> 

                            <small class="terms--small d-block text-center mt-4">By signing up you agree to the <a href="/tos" target="_blank">Terms of Service</a>.</small>

                            @endif

                        </div>

                        @if ($errors->any())
                        @foreach ($errors->all() as $error)
                        <div class="alert alert-danger alert-dismissible fade show mb-0 border-top" role="alert">
                            <i class="fa fa-exclamation-circle"></i> 
                            {{ $error }}
                        </div>
                        @endforeach
                        @endif

                    </div>
                </div>

            </div>
            </div>

            <div class="container scroll-downs-holder">
            <div class="row justify-content-center mt-5 mt-lg-0">
                <div class="col-12 col-lg-8 col-xl-6 text-center">

                    <div class="scroll-downs">
                      <div class="mousey">
                        <div class="scroller"></div>
                      </div>
                    </div>
 
                </div>
            </div>
            </div>
            <!-- / Inner Wrapper -->
        </div>
        <!-- / Welcome Section -->  

        <div class="border-bottom">
        <div class="container text-center pt-5 pb-5">

           <h6 class="text-muted mb-4 ">Niffler.co Is Proudly Supported By</h6> 
           <section class="customer-logos slider">
              
              @include('pages.FrontSubsystem.common.logos') 

           </section>  
        </div> 
        </div>

        <div id="how-it-works-section" class="section-features">
        <div class="container text-center pt-4 pb-5">

           <div class="row pt-5 justify-content-center">

                <div class="col-12 mb-0">
                <h3 class="font-weight-bold mt-lg-5">Designed to help you learn how to trade<br/> cryptocurrencies in a fun, effective and safe way.</h3>
                </div>   

                <div class="col-lg-4 p-lg-5">
                  
                  <div class="landing-icon simulated-exchange"></div>

                  <h5 class="font-weight-bold">Simulated Exchange</h5>
                  <p class="">Theoretical paper trading is so 2017! Niffler.co users go hands on with our real life and real time simulated cryptocurrency exchange. There is simply no safer and easier way to learn.</p>

                </div>
                <div class="col-lg-4 p-lg-5">

                  <div class="landing-icon community"></div>

                  <h5 class="font-weight-bold">FREE Learning Community</h5>
                  <p class="">Our sole aim from day one was to build a FREE community that shares in each others knowledge, experience and most importantly each others cumulative successes.</p>
                </div>
                <div class="col-lg-4 p-lg-5"> 

                  <div class="landing-icon earn-money"></div>

                  <h5 class="font-weight-bold">Earn to Learn </h5>
                  <p class="">Have fun on your crypto trading learning journey with "Niffler Rewards Program" Get rewarded simply by growing your portfolio and play dollars wisely & consistently while earning success badges along the way.</p>
                </div>

            </div>

        </div> 
        </div>

        <div class="intro-bg py-5">

          <div class="container py-5">

              <div class="row">
                <div class="col-lg-6 col-xl-7 d-flex mb-4 mb-lg-0">
                  <div class="align-self-center">
                  <div class="browser-mockup with-tab">
                    <video muted loop width="100%" autoplay="autoplay">
                      <source src="{{ asset('assets/images/niffler_intro.webm') }}" type="video/webm" />
                      <source src="{{ asset('assets/images/niffler_intro.mp4') }}" type="video/mp4" />
                    </video> 
                  </div>
                  </div>
                </div>
                <div class="col-lg-6 col-xl-5 text-white d-flex">
                  <div class="align-self-center pl-lg-5 text-center text-md-left">
                  <h2 class="text-white font-weight-bold h3">Easy To Understand For Newbies, Yet Advanced Enough For Experienced Traders</h2>
                  <p class="mb-0">Whether a newbie to cryptocurrencies & crypto trading or an experienced trader, the Niffler.co simulated crypto exchange is easy to use, understand and learn on, yet has a host of advanced features that even the most experienced traders will find useful to hone their trading chops.</p>
                  </div>
                </div>
              </div>



          </div>

        </div>

        <div class="">
        <div class="container  pt-4 pb-5">

           <div class="row pt-5 justify-content-center pb-5">

                <div class="col-12 mb-0">
                <h3 class="font-weight-bold mt-lg-5  mb-2 text-center">Proof of experience<small class="trademark font-weight-normal">&trade;</small></h3>
                <p class="lead mb-5 text-center">Prove to the world you can trade and recieve a verification badge.</p>
                </div>

                

                <div class="col-lg-5 px-5 px-lg-0 text-center text-sm-left">

                    <div class="landing-step step-1"> 

                      <div class="landing-step-goal">Minimum <span class="font-weight-bold">30</span> Trades</div>

                      <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>


                      <svg class="" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52"><circle class="" cx="26" cy="26" r="25" fill="none"/><path class="" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/></svg>

                    </div>

                    <div class="landing-step step-2">

                      <div class="landing-step-goal"><span class="font-weight-bold">+1.5%</span> Avg. Profit Margin</div>

                      <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>

                      <svg class="" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52"><circle class="" cx="26" cy="26" r="25" fill="none"/><path class="" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/></svg>

                    </div> 


                    <div class="landing-step step-3">

                      <div class="landing-step-goal">Min. <span class="font-weight-bold">25K</span> profit in Play USD</div>

                      <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>

                      <svg class="" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52"><circle class="" cx="26" cy="26" r="25" fill="none"/><path class="" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/></svg>

                    </div>  

                </div> 

                <div class="col-lg-4 px-5 px-lg-0">
                  <p class="lead mb-0 pl-lg-5 pt-4 mb-lg-5">
                      Our proprietary "Proof of experience" model is used to award “verified” status to aspiring or existing traders with a track record of high or excellent performance. Use Niffler and “proof of experience” in the real world to back up your crypto trading competence.
                  </p>
                </div> 

                 

            </div>

        </div>
        </div> 
       
        <div class="landing-cta">  

                <div class="container">
                  <div class="row justify-content-center">
                 <div class="col-xl-10 mb-0 p-5"">


                   
                      <h3 class="font-weight-bold text-white text-center text-md-left">

                        <span class="d-block d-md-inline-block">Ready to get started?</span> 

                        <a href="/signup" class="btn btn-lg btn-primary font-weight-bold mt-3 mt-md-0 float-md-right">Sign Up</a>

                      </h3>
                       

                      
                  </div>
                  </div>
                  </div>
        </div> 

    @endsection

@endsection 

@section('footer-scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/cleave.js/1.3.3/cleave.min.js"></script> 
<script src="{{ asset('assets/js/ccc-streamer-utilities.js') }}"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.1.0/socket.io.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.1/moment.min.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.js"></script>

<script src="{{ asset('assets/js/plugins/formvalidation/formValidation.popular.min.js') }}"></script>  
<script src="{{ asset('assets/js/plugins/formvalidation/framework/bootstrap4.min.js') }}"></script>  

<script src="{{ asset('assets/js/landing.js') }}"></script>   
@endsection

