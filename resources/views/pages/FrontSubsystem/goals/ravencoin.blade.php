@extends('pages.FrontSubsystem.layout',[
    'title' => 'Help get Ravencoin listed on Niffler.co',
    'classes' => 'shards-landing-page--1 goal-landing',
    'landing' => true, 
    'description' => 'Want to see Ravencoin listed on the Niffler.co exchange? Show your support by registering and if enough Ravencoin supporters do, we’ll add RVN to the Niffler.co exchange.',
    'nofollow'=>true,
    'poster' => 'assets/images/ravencoin_on_niffler.jpg',
    'html_class'=>''   
])  

@section('main') 

    @parent

    @section('content')

        @php
    
          $goal = 1000;
          $total = $totalRegisteredWithCode; 
          $percentage = $total * 100 / $goal;

        @endphp 

        <!-- Welcome Section -->
        <div class="welcome goal-landing-top">
            <div class="container"> 
            <!-- Navigation -->
            <nav class="navbar navbar-expand-lg navbar-dark pt-4 px-3 px-sm-0">
                <a class="navbar-brand" href="/"> 
                <img src="{{ asset('assets/images/niffler-logo-white.png') }}" class="mr-2" alt="">
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



                     <div class="dgb-row text-center pb-4 mt-3"> 
                        
                          <svg style="max-width: 250px;" version="1.0" xmlns="http://www.w3.org/2000/svg"
							 width="366.000000pt" height="138.000000pt" viewBox="0 0 366.000000 138.000000"
							 preserveAspectRatio="xMidYMid meet">

							<g transform="translate(0.000000,138.000000) scale(0.100000,-0.100000)"
							fill="#fff" stroke="none">
							<path d="M505 1370 c11 -4 45 -18 75 -30 l55 -22 -29 31 c-25 26 -37 31 -75
							30 -34 0 -41 -2 -26 -9z"/>
							<path d="M430 1354 c-19 -8 -50 -29 -68 -47 l-33 -32 68 -6 68 -5 -72 -2 -72
							-2 -15 -51 c-9 -28 -25 -66 -36 -84 l-21 -34 22 -11 c19 -11 419 -71 427 -65
							1 1 -7 44 -19 94 -23 101 -33 113 -117 140 -37 12 -37 12 -159 -70 -68 -45
							-121 -84 -119 -87 3 -2 84 22 181 53 98 31 179 54 182 52 2 -3 -6 -8 -19 -12
							-13 -4 -94 -30 -181 -57 -202 -64 -219 -56 -78 38 55 36 98 71 95 75 -3 5 3 6
							12 2 12 -4 15 -3 10 5 -4 7 -2 12 3 12 19 0 12 18 -10 25 -11 4 -19 9 -16 11
							2 2 30 -7 62 -22 49 -21 56 -22 45 -7 -23 29 -94 103 -100 103 -3 -1 -21 -8
							-40 -16z m0 -39 c14 -8 21 -14 15 -14 -5 0 -21 6 -35 14 -14 8 -20 14 -15 14
							6 0 21 -6 35 -14z"/>
							<path d="M510 1356 c0 -3 20 -28 44 -55 l44 -50 11 30 c10 29 9 31 -27 46 -20
							8 -45 19 -54 24 -10 6 -18 7 -18 5z"/>
							<path d="M645 1293 c3 -10 9 -30 12 -45 3 -16 11 -28 17 -28 20 0 146 34 146
							40 0 5 -157 51 -174 50 -4 0 -5 -8 -1 -17z"/>
							<path d="M616 1278 c-9 -34 -8 -36 15 -49 20 -10 21 -9 14 23 -9 44 -21 55
							-29 26z"/>
							<path d="M243 1052 c-10 -6 -247 -1041 -240 -1048 1 -1 81 55 177 124 121 88
							176 135 181 152 7 24 7 24 8 3 1 -22 4 -23 111 -23 109 0 110 0 116 25 3 14
							10 25 14 25 4 0 6 10 3 23 -2 12 3 58 11 102 15 78 15 55 0 -70 -2 -22 -2 -35
							1 -30 6 13 155 564 155 573 0 4 -17 26 -38 50 l-37 42 -220 30 c-251 34 -226
							32 -242 22z m87 -176 c39 -88 69 -161 67 -163 -2 -2 -34 65 -72 149 -74 168
							-81 186 -72 178 3 -3 38 -77 77 -164z m364 -20 c-9 -70 -19 -124 -22 -122 -2
							3 4 61 14 130 9 70 19 124 22 122 2 -3 -4 -61 -14 -130z m-27 -183 c-3 -10 -5
							-2 -5 17 0 19 2 27 5 18 2 -10 2 -26 0 -35z m-228 -48 c0 -5 -8 6 -19 25 -11
							19 -19 40 -19 45 0 6 8 -6 19 -25 11 -19 19 -39 19 -45z m218 -22 c-3 -10 -5
							-2 -5 17 0 19 2 27 5 18 2 -10 2 -26 0 -35z m-178 -68 c0 -5 -8 6 -19 25 -11
							19 -19 40 -19 45 0 6 8 -6 19 -25 11 -19 19 -39 19 -45z m168 -2 c-3 -10 -5
							-2 -5 17 0 19 2 27 5 18 2 -10 2 -26 0 -35z m-128 -88 c0 -5 -8 6 -19 25 -11
							19 -19 40 -19 45 0 6 8 -6 19 -25 11 -19 19 -39 19 -45z m40 -90 c0 -5 -8 6
							-19 25 -11 19 -19 40 -19 45 0 6 8 -6 19 -25 11 -19 19 -39 19 -45z m-212 33
							c-3 -8 -6 -5 -6 6 -1 11 2 17 5 13 3 -3 4 -12 1 -19z m10 -60 c-3 -8 -6 -5 -6
							6 -1 11 2 17 5 13 3 -3 4 -12 1 -19z m232 -43 c0 -5 -6 1 -14 15 -8 14 -14 30
							-14 35 0 6 6 -1 14 -15 8 -14 14 -29 14 -35z"/>
							<path d="M970 790 c0 -118 2 -140 15 -140 12 0 15 13 15 60 l0 60 59 0 c33 0
							63 -4 66 -10 3 -5 9 -32 12 -60 4 -38 10 -50 23 -50 15 0 16 6 9 48 -13 67
							-19 82 -32 82 -6 0 -1 9 11 20 22 21 30 73 14 96 -15 23 -53 34 -121 34 l-71
							0 0 -140z m158 98 c7 -7 12 -24 12 -38 0 -39 -18 -50 -82 -50 l-58 0 0 50 0
							50 58 0 c32 0 63 -5 70 -12z"/>
							<path d="M1373 913 c-4 -10 -28 -72 -54 -138 -26 -66 -45 -122 -43 -124 10
							-11 32 12 44 48 l13 41 59 0 59 0 19 -45 c11 -26 26 -45 35 -45 9 0 14 3 12 8
							-3 4 -28 67 -57 140 -50 129 -71 156 -87 115z m46 -83 c12 -30 21 -58 21 -62
							0 -5 -22 -8 -49 -8 l-49 0 19 53 c11 28 22 58 25 66 6 19 9 15 33 -49z"/>
							<path d="M1596 833 c20 -54 43 -117 51 -140 26 -74 43 -58 93 85 56 158 54
							152 37 152 -11 0 -27 -36 -53 -112 -20 -62 -39 -117 -42 -122 -3 -5 -24 45
							-47 110 -28 81 -47 120 -58 122 -14 3 -10 -13 19 -95z"/>
							<path d="M1890 790 l0 -140 95 0 c57 0 95 4 95 10 0 6 -33 10 -80 10 l-80 0 0
							55 0 55 70 0 c40 0 70 4 70 10 0 6 -30 10 -70 10 l-70 0 0 50 0 50 75 0 c60 0
							75 3 75 15 0 12 -17 15 -90 15 l-90 0 0 -140z"/>
							<path d="M2180 790 c0 -118 2 -140 15 -140 12 0 15 20 15 118 l0 117 78 -117
							c105 -160 112 -159 112 22 0 116 -2 140 -15 140 -12 0 -15 -22 -17 -116 l-3
							-117 -78 117 c-42 64 -84 116 -92 116 -13 0 -15 -22 -15 -140z"/>
							<path d="M2558 910 c-37 -29 -51 -71 -46 -140 4 -51 9 -66 34 -91 58 -57 155
							-44 188 26 20 40 20 45 2 45 -7 0 -19 -14 -26 -30 -15 -37 -37 -50 -83 -50
							-27 0 -41 7 -62 32 -25 29 -27 38 -23 96 4 55 8 68 32 88 15 13 38 24 51 24
							35 0 74 -20 80 -42 7 -21 35 -25 35 -4 0 8 -14 26 -31 40 -39 33 -113 36 -151
							6z"/>
							<path d="M2895 908 c-79 -62 -70 -204 16 -250 43 -23 75 -23 118 0 86 46 95
							188 16 250 -38 30 -112 30 -150 0z m136 -26 c25 -23 33 -38 36 -78 8 -83 -29
							-134 -97 -134 -68 0 -105 51 -97 134 3 40 11 55 36 78 19 17 43 28 61 28 18 0
							42 -11 61 -28z"/>
							<path d="M3210 790 c0 -118 2 -140 15 -140 13 0 15 22 15 140 0 118 -2 140
							-15 140 -13 0 -15 -22 -15 -140z"/>
							<path d="M3360 791 c0 -87 4 -141 10 -141 6 0 10 48 10 123 l0 122 81 -122
							c44 -68 87 -123 95 -123 11 0 14 26 14 140 0 87 -4 140 -10 140 -6 0 -10 -48
							-10 -122 l0 -123 -80 120 c-44 66 -87 121 -95 123 -13 3 -15 -17 -15 -137z"/>
							</g>
							</svg>

                        
                      </div>  

            <!-- Inner Wrapper --> 
            <div class="inner-wrapper mt-auto mb-auto container">
            <div class="row px-3 px-sm-0 pt-lg-5 pb-5">
                <div class="col-lg-7">
                    
                    <div class="pr-lg-3">


                    <h1 class="h1 welcome-heading mb-4 mt-5 mt-lg-0 text-white ">Help get <span class="font-weight-bold" style="color: #f79333;">Ravencoin</span> <br class="d-none d-lg-block"/>listed on Niffler.co
                    </h1> 

                    

                    <p class="text-white  lead mb-3">Niffler.co is a FREE simulated cryptocurrency exchange that gives newbies the ability to learn crypto trading without the risk while also allowing them to earn amazing crypto rewards, simply by growing their “play dollar” portfolio!</p>   

                    <p class="text-white   lead mb-3">Want to see Ravencoin listed on the Niffler.co exchange? Show your support by registering and if enough Ravencoin supporters do, we’ll add RVN to the Niffler.co exchange.</p>
      
                    <div class="progress mb-4" style="height: 30px;">
                      <span class="progress-label">{{ $totalRegisteredWithCode }} out of 1000</span>
                      <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="{{ $percentage }}" aria-valuemin="0"  aria-valuemax="100" style="width: {{ $percentage }}%"></div>
                    </div> 

                    <a href="" data-title="I just showed my support to help get @Ravencoin listed on Niffler 🔥" data-url="https://niffler.co/goal/ravencoin" data-text="Show your support by registering at" class="ssk ssk-twitter goal-tweet ml-0">Tweet</a>
                		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/social-share-kit/1.0.15/js/social-share-kit.min.js"></script> 
 
                		<script type="text/javascript">
						    SocialShareKit.init();
						</script>
 
                  
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
                              Sign up to show<br /> 
                              your support.
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

