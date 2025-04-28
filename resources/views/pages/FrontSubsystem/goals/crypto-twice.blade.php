@extends('pages.FrontSubsystem.layout',[
    'title' => 'Crypto-Twice Benefit Simulated Trading Competition - Free to participate',
    'classes' => 'shards-landing-page--1 goal-landing',
    'landing' => true, 
    'description' => 'Join other cryptocurrency traders to help support one of our own and the opportunity to win amazing prize packages.',
    'nofollow'=>false, 
    'poster' => 'assets/images/competition-poster.jpg',
    'html_class'=>''   
])  

@section('main') 

    @parent

    @section('content')

        @php
    
          $goal = 5000;
          $total = $totalRegisteredWithCode; 
          $percentage = $total * 100 / $goal;
          $addressinfo = file_get_contents('https://blockchain.info/rawaddr/3QjTQMUW2BEUwTYcJ98yBbf7hdYFBpSDAo');
          $addressinfo = json_decode($addressinfo); 

          $totalreceived = number_format($addressinfo->total_received / 100000000,4);
         
          @endphp

          <style type="text/css">
            
            .modal button.close {
    color: #fff;
    right: 20px;
    position: fixed;
    top: 20px;
    opacity: 1;
    font-size: 3rem;
    z-index: 1;
    background: #63396a;
    padding: 0 8px;
    border-radius: 3px;
}

          </style>

          <div id="prizes" class="modal fade" role="dialog">
                        <button type="button" class="close" data-dismiss="modal"><i class="fal fa-times"></i></button>
                        <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-body p-5">
                                   <h5 class="mb-4 font-weight-bold">Prizes</h5>
                                    
                                    <h6 class="font-weight-bold">1st Place - Bitcoin Maximalist Pack</h6>

                                    <p>Ledger Nano S / <a href="https://www.ledger.fr/" rel="nofollow" target="_blank">Ledger</a><br/>
                                    Bitcoin Candle / <a href="https://cryptobrekkie.com/" rel="nofollow" target="_blank">CryptoBrekkie.com</a><br/>
                                    Bitcoin Netflix Style Hoodie / <a href="http://cryptomvmt.com/" rel="nofollow" target="_blank">CryptoMVMT.com</a><br/>
                                    Bitcoin Lion Logo Shirt / <a href="https://cryptowhaleclothing.com/" rel="nofollow" target="_blank">CryptoWhaleClothing.com</a><br/>
                                    Niffler.co Summer Shirts / <a href="https://niffler.co" rel="nofollow" target="_blank">Niffler.co</a><br/>
                                    2 x Bitcoin Circle Logo Gummie Packs / <a href="https://cryptocandy.me/" rel="nofollow" target="_blank">CryptoCandy.me</a>
                                    <br/>

                                    H4SHR8 Hoodie / <a href="https://twitter.com/h4shr8" rel="nofollow" target="_blank">h4shr8</a>

                                    <br/>
                                   One unique crypto/non-crypto related logo design session / <a href="https://twitter.com/JohnyCrypto" rel="nofollow" target="_blank">@JohnyCrypto</a></p>

                                    <h6 class="font-weight-bold">2nd Place - Ethereum Maximalist Pack</h6>

                                    <p>Ethereum Hoodie / <a href="https://www.tcmerch.io/" rel="nofollow" target="_blank">TCMerch.io</a><br/>
                                    Hodl Ethereum Hoodie / <a href="https://cryptowhaleclothing.com/" rel="nofollow" target="_blank">CryptoWhaleClothing.com</a><br/>
                                    Crypto MVMT Hat / <a href="https://crypto-mvmt.com/" rel="nofollow" target="_blank">Crypto-MVMT.com</a><br/>
                                    Niffler.co Summer Shirts / <a href="https://niffler.co" rel="nofollow" target="_blank">Niffler.co</a><br/>
                                    2 x Ethereum Logo Circle Gummies / <a href="https://cryptocandy.me/" rel="nofollow" target="_blank">CryptoCandy.me</a>
                                    <br/>

                                    H4SHR8 T-shirt / <a href="https://twitter.com/h4shr8" rel="nofollow" target="_blank">h4shr8</a>
                                    </p>

                                    <h6 class="font-weight-bold">3rd Place - Litecoin Maximalist Pack</h6>

                                    <p>Pay w/ Litecoin Hat / <a href="https://cryptowhaleclothing.com/" rel="nofollow" target="_blank">CryptoWhaleClothing.com</a><br/>
                                    2 x Litecoin Logo Circle Gummies / <a href="https://cryptocandy.me/" rel="nofollow" target="_blank">CryptoCandy.me</a><br/>
                                    Satoshi Dropper Art Print / <a href="https://cryptobrekkie.com/" rel="nofollow" target="_blank">CryptoBrekkie.com</a><br/>
                                    Crypto MVMT Branded Shirt / <a href="http://crypto-mvmt.com" rel="nofollow" target="_blank">CryptoMVMT.com</a><br/>
                                    Niffler.co Summer Shirts / <a href="https://niffler.co" rel="nofollow" target="_blank">Niffler.co</a>
                                    <br/>

                                    H4SHR8 T-shirt / <a href="https://twitter.com/h4shr8" rel="nofollow" target="_blank">h4shr8</a>
                                    </p>

                                    <h6 class="font-weight-bold">4th Place - Monero Maximalist Pack</h6>

                                    <p>Hodl Hoodie / <a href="https://cryptowhaleclothing.com/" rel="nofollow" target="_blank">CryptoWhaleClothing.com</a><br/>
                                    Be Your Own Bank Shirt / <a href="http://allgoodlab.com/" rel="nofollow" target="_blank">Allgoodlab.com</a><br/>
                                    Crypto Love Shirt / <a href="https://www.tcmerch.io/" rel="nofollow" target="_blank">TCMerch.io</a><br/>
                                    2 x Bitcoin Logo Gummie Packs / <a href="https://cryptocandy.me/" rel="nofollow" target="_blank">CryptoCandy.me</a><br/>
                                    Niffler.co Summer Shirts / <a href="https://niffler.co" rel="nofollow" target="_blank">Niffler.co</a>
                                    <br/>
                                    H4SHR8 T-shirt / <a href="https://twitter.com/h4shr8" rel="nofollow" target="_blank">h4shr8</a>
                                    </p>

                                    <h6 class="font-weight-bold">5th Place - Day Trader Pack</h6>

                                    <p>HodlFuel Coffee / <a href="https://hodlfuel.com/" rel="nofollow" target="_blank">HodlFuel</a><br/>
                                    Short The Banks Coffee Mug / <a href="https://shorthebanks.com/" rel="nofollow" target="_blank">Short The Banks</a><br/>
                                    Bitconnect Hoodie / <a href="https://www.tcmerch.io/" rel="nofollow" target="_blank">TCMerch.io</a><br/>
                                    2 x Bitcoin Logo Gummie Packs / <a href="" rel="nofollow" target="_blank">CryptoCandy.me</a><br/>
                                    ***DYOR Shirt   / <a href="" rel="nofollow" target="_blank">Allgoodlab.com</a><br/>
                                    Niffler.co Summer Shirts / <a href="https://niffler.co" rel="nofollow" target="_blank">Niffler.co</a></p>

                                    <div>
                                    <button type="button" class="btn  btn-lg btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                          
                                    
                             
                            </div>

                        </div> 
                    </div>  


        <!-- Welcome Section -->
        <div class="welcome goal-landing-top">
            <div class="crypto-twice-screen">
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


            
            <!-- Inner Wrapper --> 
            <div class="inner-wrapper mt-auto mb-auto container">
            <div class="row px-3 px-sm-0 pt-lg-5 pb-5">
                <div class="col-lg-6 col-xl-5 align-self-center">
                    
                    <div class="pr-lg-3">

                    <h1 class="font-weight-bold welcome-heading mb-4 mt-5 mt-lg-0 text-white ">
                    	Crypto Twice Benefit Trading Competition
                    </h1>    
                     
                     <p class="text-white  mb-3">This FREE simulated crypto trading competition & donation drive is for Crypto Twice & his family. Twice is not only a long-time crypto enthusiast and trader, but also an ill US veteran with no health insurance who is going through some difficult times. Together with an amazing group of sponsors, and with the incredible help of @ShitcoinSherpa we've put together a trading comp like those Twice loved to compete in, with the hopes of raising some money to help with some of the medical expenses. Thanks for supporting this great cause by participating in the competition and potentially donating as every bit helps!

                      <a data-toggle="modal" data-target="#prizes" href="" class="text-warning">View Prizes <i class="fal fa-arrow-right"></i></a> 

                     </p>  

                    <div class="row mb-5 mb-lg-0">
 
                    <div class="col-sm-5 col-lg-4 col-xl-4">
                    <a href="/signup" class="btn btn-lg btn-primary btn-block">Sign Up</a>
                	</div>
                	<div class="col-sm-7 col-lg-7 col-xl-8 d-flex">
                		<div class="align-self-center w-100">
                    		<small class="landing-term pt-3 pt-sm-0">* Once you have successfully created an account on Niffler.co, you will automatically be registered for the competition and notified prior to the April 24th start date.</small>
                    	</div>
                	</div>

                 	</div>
                  
                    </div> 
       
                </div> 
                 
                <div class="col-sm-8 col-lg-4 col-xl-4">
 
                   

                    <div class="card card-register">
                        <div class="card-body py-5 px-4 px-lg-3 p-xl-5 text-center">

                        	<h4 class="h4 card-title mb-2 text-center font-weight-bold">
                            	Raised so far
                            </h4>  

                            <h2 class="font-weight-bold text-center text-success">{{$totalreceived}}<span class="text-dark">BTC</span></h2>

                            <h5 class="text-center mt-5">Pledge some Bitcoin:</h5>  
 
                           <img src="https://blockchain.info/qr?data=3QjTQMUW2BEUwTYcJ98yBbf7hdYFBpSDAo&size=200" class="w-100">
                          
                           <p class="mb-0">3QjTQMUW2BEUwTYcJ98yBbf7hdYFBpSDAo</p>
                        </div>
                    </div>

                </div> 

                <div class="col-sm-4  col-lg-2 col-xl-3 d-flex">
                	<div class="align-self-center text-center w-100 pt-5 pt-sm-0">
                		<a href="https://twitter.com/twice_crypto" class="goal-twitter-link">
                		<img class="w-100 goal-avatar" src="https://pbs.twimg.com/profile_images/1062434629221634048/udxYkXdw_400x400.jpg">
                		
                		<h4 class="text-white mb-0">Crypto Twice</h4>
                		<p><i class="fab fa-twitter"></i> @twice_crypto</p>
                		</a>

                		<p class="text-white mb-2">Help to spread awarness</p>
 
                	 
                		<a href="" data-title="I just registered for the FREE Crypto-Twice Benefit Trading Competition!🔥 " data-url="https://niffler.co/goal/crypto-twice" data-text="Join me and other cryptocurrency traders to help support one of our own and the opportunity to win amazing prize packages! @ShitcoinSherpa #cryptotrading 🚀" class="ssk ssk-twitter goal-tweet">Tweet</a>
                		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/social-share-kit/1.0.15/js/social-share-kit.min.js"></script> 

                		<script type="text/javascript">
						    SocialShareKit.init();
						</script>

 

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
        </div>
        <!-- / Welcome Section -->  

        <div class="border-bottom">
        <div class="container text-center pt-5 pb-5">

           <h6 class="text-muted mb-4 ">Competition Sponsors</h6> 
           <section class="customer-logos slider">
              
              <div class="slide">
              <a href="https://cryptowhaleclothing.com/" title="" target="_blank" rel="nofollow noopener">
              <img src="{{ asset('assets/images/logos/cryptowhaleclothing.png') }}" alt="">
              </a>
              </div>

              <div class="slide">
              <a href="https://cryptobrekkie.com/" title="" target="_blank" rel="nofollow noopener">
              <img src="{{ asset('assets/images/logos/cryptobrekkie.png') }}" alt="">
              </a>
              </div>

              <div class="slide">
              <a href="https://crypto-mvmt.com/" title="" target="_blank" rel="nofollow noopener">
              <img src="{{ asset('assets/images/logos/cryptomvmt.png') }}" alt="">
              </a>
              </div>

              <div class="slide">
              <a href="https://twitter.com/h4shr8" title="" target="_blank" rel="nofollow noopener">
              <img src="{{ asset('assets/images/logos/h4shr8.png') }}" alt="">
              </a> 
              </div>

              <div class="slide">
              <a href="https://twitter.com/JohnyCrypto" title="" target="_blank" rel="nofollow noopener">
              <img src="{{ asset('assets/images/logos/JohnyCrypto.png') }}" alt="">
              </a>
              </div>
 

              <div class="slide">
              <a href="https://www.tcmerch.io/" title="" target="_blank" rel="nofollow noopener">
              <img src="{{ asset('assets/images/logos/tcmerch.png') }}" alt="">
              </a>
              </div>

              <div class="slide">
              <a href="https://hodlfuel.com/" title="" target="_blank" rel="nofollow noopener">
              <img src="{{ asset('assets/images/logos/hodlfuel.png') }}" alt="">
              </a>
              </div>

              <div class="slide">
              <a href="https://cryptocandy.me/" title="" target="_blank" rel="nofollow noopener">
              <img src="{{ asset('assets/images/logos/cryptocandyme.png') }}" alt="">
              </a>
              </div>


              <div class="slide">
              <a href="https://shorthebanks.com/" title="" target="_blank" rel="nofollow noopener">
              <img src="{{ asset('assets/images/logos/shortthebanks.png') }}" alt="">
              </a>
              </div>


              


           </section>   
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


        <div class="section-features">
        <div class="container text-center pt-4 pb-5">

           <div class="row pt-5 justify-content-center">

                <div class="col-12 mb-0">
                <h3 class="font-weight-bold mt-lg-5">Designed to help you understand
                blockchain, crypto and cryptocurrency trading better.</h3>
                </div>  

                <div class="col-lg-4 p-lg-5">
                  
                  <div class="landing-icon simulated-exchange"></div>

                  <h5 class="font-weight-bold">Simulated Exchange</h5>
                  <p class="">Theoretical paper trading is so 2017! Niffler.co users go hands on with our real life and real time simulated crypto exchange. There is simply no safer and easier way to learn!</p>

                </div>
                <div class="col-lg-4 p-lg-5">

                  <div class="landing-icon community"></div>

                  <h5 class="font-weight-bold">FREE Learning Community</h5>
                  <p class="">Our sole aim from day one was to build a FREE community that shares in each others knowledge, experience and most importantly each others cumulative successes.</p>
                </div>
                <div class="col-lg-4 p-lg-5"> 

                  <div class="landing-icon earn-money"></div>

                  <h5 class="font-weight-bold">Earn Money </h5>
                  <p class="">Start earning money through our proprietary "Proof of Experience™" model simply by growing your portfolio wisely & consistently while earning various badges along the way.</p>
                </div>

            </div>

        </div> 
        </div>

        <div class="">
        <div class="container  pt-4 pb-5">

           <div class="row pt-5 justify-content-center pb-5">

                <div class="col-12 mb-0">
                <h3 class="font-weight-bold mt-lg-5  mb-2 text-center">Proof of experience<small class="trademark font-weight-normal">&trade;</small></h3>
                <p class="lead mb-5 text-center">Earn money from your
knowledgeable trading actions</p>
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

                      <div class="landing-step-goal"><span class="font-weight-bold">+3%</span> Avg. Profit Margin</div>

                      <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>

                      <svg class="" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52"><circle class="" cx="26" cy="26" r="25" fill="none"/><path class="" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/></svg>

                    </div> 


                    <div class="landing-step step-3">

                      <div class="landing-step-goal">Min. <span class="font-weight-bold">50K</span> profit in Play USD</div>

                      <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>

                      <svg class="" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52"><circle class="" cx="26" cy="26" r="25" fill="none"/><path class="" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/></svg>

                    </div>  

                </div>

                <div class="col-lg-5 px-5 px-lg-0">
                  <p class="lead mb-0 pl-lg-5 pt-4 mb-lg-5">
                      Highly sought after traders now have the option to publicly or privately share their knowledge on all things, blockchain, crypto and cryptocurrency trading for a monthly monetary pledge from those wishing to follow and benefit from their wisdom.
                      Our proprietary "Proof of experience" model is used to award “trader” status to aspiring traders with a track record of high or excellent performance! 
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
