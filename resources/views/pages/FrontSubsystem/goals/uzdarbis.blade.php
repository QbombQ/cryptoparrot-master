@extends('pages.FrontSubsystem.layout',[
    'title' => 'You\'ve been invited to participate in a Top Trader Competition on Niffler.co',
    'classes' => 'shards-landing-page--1',
    'landing' => true, 
    'description' => 'Compete with fellow Uzdarbis.lt members within a completely safe & free simulated crypto exchange environment',
    'nofollow'=>false,
    'poster' => 'assets/images/niffler-og.jpg',
    'html_class'=>''   
]) 
  
@section('main') 

    @parent

    @section('content')

        @php
    
          $goal = 150;
          $total = $totalRegisteredWithCode + 5; 
          $percentage = $total * 100 / $goal;

        @endphp 

        <!-- Welcome Section -->
        <div class="goal">   
             

            <!-- Inner Wrapper -->
            <div class="inner-wrapper mt-auto mb-auto container py-md-5">
            <div class="row px-3 px-sm-0">
                <div class="col-lg-7">

                <a class="navbar-brand py-5 py-lg-0" href="/"> 
                <img src="/assets/images/niffler-logo.png" class="mr-2" alt="">
                </a> 

                <a class="navbar-brand" target="_blank" rel="nofollow noopener" href="https://steemit.com/"> 
                <img src="/assets/images/logos/uzdarbis.png" class="mr-2" alt="">
              </a>   
  

                <h1 class="h2 mt-3 mt-lg-5">Join An Exclusive Competition</h1> 
                <h2 class="h4"> for <strong>Uzdarbis.lt</strong> members</h2> 
  
          <p class="lead mb-3">Compete with fellow <strong>Uzdarbis.lt</strong> members within a completely safe & free simulated crypto exchange environment and for a chance to win <br /><strong>Nano Ledger Wallet</strong></p>

          <p class="lead mb-3">In order to take part, pre-register today, spread the word with those you know in Uzdarbis.lt community. In order for competition to start, a minimum of 150 participants are required to register.</p> 


                <div class="progress mt-5" style="height: 30px;">
            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="{{ $percentage }}" aria-valuemin="0"  aria-valuemax="100" style="width: {{ $percentage }}%"></div>
          </div> 

          <h6 class="font-weight-bold text-center mt-3 text-muted">{{ $total }} out of {{ $goal }}</h6>
 

               
       
                </div> 

                <div class="col-lg-5 col-xl-5">
 
                    <div class="">
                        <div class="pt-lg-5 mt-lg-3">
                            

                            @if (session('message'))

                            <h4 class="card-title mb-0">You are almost there!</h4>
                            <p class="lead mb-3"></p>

                            {{ session('message') }}

                            @else 

                            <h4 class="card-title mb-0 mt-5">Register Today</h4>
                            <p class="lead mb-3 lead--register">Get Notified The Moment Your Organization's Top Trader Competition Starts!</p>

                            <form method="post" id="register" class="" action="/register">
                                @csrf
                                <div class="input-group input-group-seamless mb-3">
                                    <span class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="far fa-at"></i>
                                        </span>
                                    </span>
                                    <input autocomplete="email" type="email" class="form-control" name="email" id="form1-email" value="{{ old('email') }}" placeholder="Email">
                                </div>
                                <div class="input-group input-group-seamless mb-3">
                                    <span class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="far fa-user"></i>
                                        </span>
                                    </span>
                                    <input type="text" class="form-control" name="username" id="form1-username" value="{{ old('username') }}" placeholder="Username">
                                </div>
                                 
                                <div class="input-group input-group-seamless mb-3">
                                    <span class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="far fa-lock-alt"></i>
                                        </span>
                                    </span>
                                    <input type="password" class="form-control" name="password" id="form1-password" placeholder="Password">
                                </div>
                                <div class="custom-control custom-checkbox d-block my-2 mb-4"><input type="checkbox" name="agree" class="custom-control-input" id="customCheck1"><label class="custom-control-label" for="customCheck1"><small class="terms--small">Agree to <a href="/tos" target="_blank">Terms of Service</a> and <a href="/privacy-policy" target="_blank">Privacy Policy</a></small></label></div>
                            
                             
                                <button type="submit" class="btn download btn-primary btn-pill"><i class="far fa-sign-in-alt mr-1"></i> Sign Up</button>

                            </form>

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

                        @if (!session('message'))
                        <div class="card-footer border-top mt-4 auth-form__card-footer">
                                <ul class="pb-1 auth-form__social-icons d-table">
                                  <li class="mr-3 d-block mb-3 mb-sm-0 d-sm-inline-block">
                                   Or register with: 
                                  </li>
                                  <li>
                                    <a href="/social/facebook">
                                      <i class="fab fa-facebook-f"></i>
                                    </a>
                                  </li>
                                  <li>
                                    <a href="/social/twitter">
                                      <i class="fab fa-twitter"></i>
                                    </a>
                                  </li>
                                  <li>
                                    <a href="/social/google">
                                      <i class="fab fa-google-plus-g"></i>
                                    </a>
                                  </li>
                                  <li>
                                    <a href="/social/reddit">
                                      <i class="fab fa-reddit"></i>
                                    </a>
                                  </li>
                                </ul>      
                        </div>
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

        <div class="bg-light border-bottom">
        <div class="container text-center pt-5 pb-5">

            <h6 class="text-muted mb-4 ">Niffler.co Is Proudly Supported By</h6> 
           <section class="customer-logos slider">
              
              <div class="slide">
                <a href="https://theblockchainbrew.com/" title="THE #1 DAILY CRYPTO NEWSLETTER" taget="_blank" rel="nofollow">
                <img src="/assets/images/logos/blockchain-brew-logo.png" alt="block chain brew logo">
                </a>
              </div>

              <div class="slide">
                <a href="https://www.tokendaily.co/" title="Stay up to date on all things crypto and blockchain" taget="_blank" rel="nofollow">
                    <img src="/assets/images/logos/token-daily-logo.png" alt="token daily logo">
                </a>  
              </div>

               <div class="slide">
                <a href="https://inthemesh.com/" title="IN THE MESH IS AN EDITORIALLY INDEPENDENT PROJECT SUPPORTED BY GOTENNA" taget="_blank" rel="nofollow"> 
                    <img src="/assets/images/logos/in-the-mesh-logo.png" alt="in the mesh logo black">
                </a> 
              </div>

              <div class="slide">
                <a href="https://cryptoaquarium.com/" title="Crypto Aquarium - A place to talk about cryptocurrency." taget="_blank" rel="nofollow">
                <img src="/assets/images/logos/crypto-aquarium-logo.png" alt="crypto aquarium logo">
                </a>
              </div>

              <div class="slide">
                <a href="https://www.cryptostache.com/" title="Fun & Helpful Tips for Beginners in Bitcoin and Cryptocurrency" taget="_blank" rel="nofollow">
                <img src="/assets/images/logos/cryptostache-logo.png" alt="crypto stache logo">
                </a>
              </div>

              <div class="slide">
                <a href="https://cryptotraffic.net/" title="crypto traffic" taget="_blank" rel="nofollow">
                <img src="/assets/images/logos/crypto-traffic.png" alt="crypto traffic logo">
                </a>
              </div>

              <div class="slide">
                <a href="http://www.tokentalk.co/" title="Token Talk - The Crypto Assets Network" taget="_blank" rel="nofollow">
                    <img src="/assets/images/logos/token-talk.svg" alt="token talk logo">
                </a> 
              </div>

              <div class="slide">
                <a href="https://whalereports.com/" title="crypto news" taget="_blank" rel="nofollow">
                <img src="/assets/images/logos/whale-reports.png" alt="whale reports logo">
                </a>
              </div>

              <div class="slide">
                <a href="https://www.cryptoanalyst.co/" title="crypto analyst" taget="_blank" rel="nofollow">
                    <img src="/assets/images/logos/crypto_analyst.png" alt="crypto analyst logo">
                </a>    
              </div> 
              
               <div class="slide">
                <a href="https://www.coinstaker.com/" title="Coin Staker" taget="_blank" rel="nofollow"> 
                    <img src="/assets/images/logos/coinstaker.png" alt="coin staker logo png">
                </a>  
              </div>
              
              
              <div class="slide">
                <a href="https://hodl.st/" title="A truely unique city building game" taget="_blank" rel="nofollow">
                    <img src="/assets/images/logos/hodlst-logo.svg" alt="hodl st logo">
                </a>   
              </div>

              <div class="slide">
                <a href="https://www.thedailybit.news/" title="The Daily Bit News" taget="_blank" rel="nofollow"> 
                    <img src="/assets/images/logos/the-daily-bit.png" alt="the daily bit logo">
                </a>  
              </div>

             
              <div class="slide">
                <a href="https://hodlcrypto.co/" title="cryptocurrency art & propaganda for long-term thinkers" taget="_blank" rel="nofollow">
                    <img src="/assets/images/logos/hodl-crypto.png" alt="hodl st logo">
                </a>    
              </div>
              
              <div class="slide">
                <a href="https://www.youtube.com/channel/UCjemQfjaXAzA-95RKoy9n_g" title="BitBoy Crypto is the place where you can get news, coin & token reviews, wallet reviews, parodies, & much more!" taget="_blank" rel="nofollow"> 
                    <img src="/assets/images/logos/bitboy-crypto.png" alt="bitboy logo black">
                </a>  
              </div>

           </section>  
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
