@extends('pages.FrontSubsystem.layout', 
[
    'title' => 'Contact CryptoParrot | Crypto community For New Traders',
    'classes' => '',
    'html_class' => '', 
    'header' => true,
    'header_class' => 'header-white ',
    'header_outer_class' => 'bg-contact',
    'header_colour' => true,
    'description' => 'Contact our team at Crypto Parrot the FREE crypto community that helps educate people interested in trading cryptocurrencies without risking real capital.',
	'poster' => 'assets/images/poster.jpg'
]) 

@section('main') 
 
    @parent

    @section('header-landing')
    <div class="py-5">
    <div class="row justify-content-between py-5">


        <div class="col-xl-6 d-flex ">
           
            <div class="align-self-center w-100 mb-5">
              <h1 class="welcome-heading text-purple font-weight-bold mb-5">Get in Touch
              </h1>
 
              @if (session('message'))
                  <div class="alert alert-success">
                      {{ session('message') }}
                  </div>
              @endif 

                <p class="text-purple lead mb-5">If you can't find what you are looking for in our <a href="/faq">FAQ</a> section we are always on hand to answer your queries. Not only that but we love to hear your feedback. Contact us through email or drop a message in the <a href="https://t.me/CryptoParrot" targe="_blank">telegram group</a>.</p>

        

            </div>

        </div>  
        
 
   
    </div>
    </div>
    @endsection 

    @section('content')

    <div class="container-fluid text-center pt-5 pb-5">
 
            <div class="px-3 px-md-5">
            <div class="row pt-4 justify-content-center">
                <div class="col-lg-12 text-left">

    <div class="">
    <div class="row justify-content-between py-5">


        <div class="col-xl-6 d-flex ">
           
            <div class="">

              <div class="row">
              <div class="col-xl-9">

                <p class="lead mb-4">Crypto Parrot Is More Than Just A Platform, We're A Global Cryptocurrency Community!</p>

                <p class="lead mb-4">Need to get a hold of us?</p>

                

              </div>
              </div>

               <p class="lead">Simply fill out the form provided and unlike your cousin Rick who borrowed money to buy Bitcoin Cash and has yet to pay it back, we’ll get back to you in 24 hours or less.</p>

            </div>

        </div>  
        <div class="col-xl-5"> 

                  <form method="post" action="/contact" class="">
                    <div class="row">
                      <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                          <input type="text" class="form-control" id="contactFormFullName" name="fullName" value="{{ old('fullName') }}" placeholder="Full Name">
                        </div>
                      </div> 
                      <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                          <input type="email" class="form-control" id="contactFormEmail" name="email" value="@if(old('email')) {{ old('email') }} @else @auth {{ Auth::user()->email }} @endauth  @endif" placeholder="Email*">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col">
                        <div class="form-group">
                            <textarea id="exampleInputMessage1" class="form-control mb-4" rows="5" value="{{ old('message') }}" placeholder="Message*" name="message">{{ old('message') }}</textarea>
                        </div>
                      </div>
                    </div>  
                    {!! app('captcha')->display() !!}  
                    {{ csrf_field() }}
                    <input class="btn btn-secondary btn-lg d-flex mt-3" type="submit" value="Send Your Message">
                  </form>

                  @if ($errors->any())
                         <div style="position: fixed;bottom: 2rem;right: 2rem;z-index: 10;">
                         
                          <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                          
                            <div class="toast-body"> 
                            
                            @foreach ($errors->all() as $error)
                            <div class=""><i class="fa fa-exclamation-circle text-danger pr-1"></i>  <span class="font-weight-bold text-danger">{{ $error }}</span>
                            </div>
                            @endforeach


                            <button type="button" class="ml-2 mb-1 close " data-dismiss="toast" aria-label="Close">
                                <span class="iconify" data-icon="ant-design:close-circle-outlined" data-inline="false"></span>
                              </button>

                            </div>
                          </div>
                          
                        </div>
                        @endif 

            
        </div>
 
   
    </div>
    </div>

    </div> 
            </div>
            </div> 
        
        </div>
    @endsection


@endsection