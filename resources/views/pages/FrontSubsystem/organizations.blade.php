@extends('pages.FrontSubsystem.layout', 
[
    'title' => 'Crypto Trading Competitions For Organizations & Groups',
    'classes' => '',
    'html_class' => '',
    'header' => true,
    'header_class' => 'header-white ',
    'header_outer_class' => 'bg-organizations',
    'header_colour' => true,
    'description' => 'A fun, unique and highly effective way for employees, clients, members and followers to be introduced to learning more about blockchain and cryptocurrencies.',
	'poster' => 'assets/images/poster.jpg'
])

@section('main')

    @parent

    @section('header-landing')
    <div class="row justify-content-between py-5">


        <div class="col-xl-7 d-flex pt-5">
           
            <div class="align-self-center w-100">
              <h1 class="welcome-heading mt-5 mt-lg-0 text-purple font-weight-bold mb-4">Trading Competitions  
              </h1>
 
    
              <div class="row mb-lg-5">
              <div class="col-xl-9">
              <p class="text-purple lead mb-5">Top Trader Competitions for Organizations, Clubs and Groups are designed as a fun, unique and highly effective way for employees, clients, members and followers to be introduced to learning more about blockchain, crypto and cryptocurrencies thats far more hands on via our simulated and real world, real time exchange.</p> 
   
              </div>
              </div>
            </div>

        </div> 
 
   
    </div>
    @endsection 

    @section('content')

        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div> 
        @endif

        <div class="container-fluid text-center pt-5 pb-5">
 
            <div class="px-3 px-md-5">
            <div class="row pt-4 justify-content-center">
                <div class="col-lg-8 text-left"> 

                    <h2 class="font-weight-normal h1 mb-4">How Does it Work?</h2>

                    <p>Top Trader Competitions for Organizations, Clubs and Groups are a personalized experience specifically tailored to each organization and meant to bring organizations closer together through education on blockchain, crypto and cryptocurrencies. 
                    </p>  

                    <p class="mb-5">We give organizations special badges ie "Team IBM" etc within their profile denoting they are exclusively part of that org. Only that org is invited to compete in a closed to your organization "Top Trader Competition" via your own custom page and unique URL that once the competition starts has them competing amongst each other to see who is a top trader while also learning all about cryptocurrencies and their associated blockchain projects with each other along the way.
                    </p> 

                    <h2 class="font-weight-normal h1 mb-4">What Does it Cost? </h2>

                    <p class="font-weight-bold mb-0">Our Top Trader Competitions for Organizations, Clubs and Groups are 100% FREE and we give out a prize(s) to the winner(s) from each organizations competition. Prizes can include Nano Ledgers, crypto, fiat, tickets to various blockchain & crypto conferences etc.
                    </p>

                    <p class="d-block mb-5">*organizations will need to have at minimum 150 people ready to learn and compete together.  Special considerations can be made for unique groups who may not meet the needed number of competitors...these groups could include: military vet groups, high school/college educators etc </p>

        
                    <h2 class="font-weight-normal h1 mb-4">What else is included?</h2>


                    <p>For the right organizations, clubs and groups there is a lot more we do with our organizational partners than just taking part in the "Top Trader Competitions For Organizations, Clubs and Groups" included but not limited to:</p>

                    <ul class="mb-5">
                        <li>Additional exposure for your organizations/club or groups services</li>
                        <li>Additional exposure for your blockchain clients and their blockchain projects</li> 
                        <li>Q & A's with your organization, club or group in our community section</li> 
                        <li>Guest blog posts in our community section</li> 
                        <li>Your logo on our partner pages w/ links back to your site</li> 
                        <li>Social media and/or PR releases of the relationship</li> 
                        <li>And so much more....</li> 
                    </ul> 

                    <h2 class="font-weight-normal h1 mb-4">How does my Organization, Club or Group get Involved? </h2>

                    <p>Ready to get started educating your organization, club or group on blockchain, crypto and cryptocurrencies in a fun, inclusive and rewarding way?</p>

                    <p>Email us at <a href="mailto:organizations&commat;{{ env('APP_FORK') }}.com">organizations&commat;{{ env('APP_FORK') }}.com</a> and someone from our team will get back in the next 24hrs or less.</p>


                </div>
            </div>
            </div>

        </div>



    @endsection

@endsection