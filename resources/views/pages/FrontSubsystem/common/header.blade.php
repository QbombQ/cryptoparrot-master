<div class="bg-purple-gradient px-4 px-sm-5">
  <div class="bg-header bg-header-right">
  <div class="container-fluid">  
    <nav class="navbar navbar-expand-lg navbar-dark pt-4  px-sm-0 justify-content-between">

        <a class="navbar-brand @if(!empty($header_class)) brand-colour @endif" href="/"> 
        <img src="{{ asset('assets/images/cryptoparrot-white.svg') }}" class="" alt="">
        </a>  
        
        <ul class="navbar-nav d-none  d-sm-md d-lg-flex ml-auto order-lg-2">
          <li class="nav-item d-inline-block">
            <a href="/login" class="btn btn-light btn-lg font-weight-bold">Login</a>
          </li>
          <li class="nav-item d-inline-block pl-3">
            <a href="/signup" class="btn btn-light btn-lg font-weight-bold">Sign Up</a>
          </li>
        </ul> 

        <button class="navbar-toggler ml-3" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fal fa-bars"></i>
        </button>

        <div class="collapse navbar-collapse order-2 order-lg-1" id="navbarNavDropdown">
          
          <ul class="navbar-nav lead font-weight-medium text-center text-lg-left pt-5 pb-5 pb-sm-0 py-lg-0 mx-auto">
            <li class="nav-item active">
              <a id="how-it-works" class="nav-link" href="/">How it works?<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/news">News</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/app/leaderboard">Leaderboard</a>
            </li>
            <li class="nav-item">
              @if(env('APP_NAME') == 'fxparrot')
              <a class="nav-link" href="/app/markets">Markets</a>
              @else
              <a class="nav-link" href="/app/cryptocurrencies">Cryptocurrencies</a>
              @endif
            </li> 
            <li class="nav-item">
              <a class="nav-link" href="/app/rewards">Get Rewards</a>
            </li>
          </ul> 

          <div class="row justify-content-center d-sm-none">
            <div class="col-6 col-sm-5 col-md-3 pr-2">
              <a class="nav-link btn btn-light btn-block nav-btn text-center font-weight-bold" href="/login">Login</a>
            </div>
            <div class="col-6 col-sm-5 col-md-3 pl-2">
              <a class="nav-link btn btn-primary btn-block text-center font-weight-bold" href="/signup">Sign Up</a>
            </div>
          </div>

        </div>  

    </nav> 


    <div class="row justify-content-between py-5">
        <div class="col-xl-7 d-flex pt-5">
           
            <div class="align-self-center w-100">
              <h1 class="welcome-heading mt-5 mt-lg-0 text-white font-weight-bold">Crypto Parrot Terms & Conditions
              </h1>

    
              <div class="row">
              <div class="col-xl-9">
              <p class="text-white lead">These are the general terms and conditions of Niffler for use of the Crypto Parrot website (the “Site”). Please read these terms and conditions carefully as your use of the Site is subject to them. Crypt Parrot reserves the right at its sole discretion to change, modify or add to these terms and conditions without prior notice to you.</p> 

               <p class="text-white lead mb-5">
              By continuing to use the Site you agree to be bound by such amended terms.</p>   
              </div>
              </div>
            </div>

        </div> 
 
   
    </div>

  </div>
  </div>
</div>