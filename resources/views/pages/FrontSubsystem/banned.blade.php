@extends('pages.FrontSubsystem.layout', 
[
    'title' => 'You have been banned from accessing Crypto Parrot.',
    'classes' => '',
    'html_class' => '',
    'header' => true,
    'header_outer_class' => 'bg-purple-gradient', 
    'header_class' => 'bg-header bg-header-right', 
    'description' => 'You are one step from joining CryptoParrot community! Choose your username before it gets taken by others.',
    'poster' => 'assets/images/poster.jpg'
])

@section('main') 

    @parent
 
    @section('header-landing')


                @if ($errors->any())
                 <div style="position: fixed;bottom: 2rem;right: 2rem;z-index: 10;">
                 
                  <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                  
                    <div class="toast-body"> 
                    
                    @foreach ($errors->all() as $error)
                    <div class=""><i class="fa fa-exclamation-circle text-danger pr-1"></i>  <span class="font-weight-bold text-danger">{{ $error }}</span>
                    </div>
                    @endforeach

                    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                        <span class="iconify" data-icon="ant-design:close-circle-outlined" data-inline="false"></span>
                      </button>

                    </div>
                  </div>
                  
                </div>
                @endif

                <div class="row justify-content-center py-5">
                <div class="col-xl-4 d-flex pt-xl-5">
           
                <div class="align-self-center w-100 pb-5">


                    <div class="card card-register ">
                    <div class="card-body p-sm-5">
                        <h4 class="card-title mb-0 text-center font-weight-bold">
                            Access restricted!
                        </h4>  
                        
                        <img src="{{ asset('assets/images/parrot-caged.svg') }}" class="" alt="">

                        <p class="lead text-center mb-0">You account has been flagged and is temporarily banned due to unusual or suspicious behavior. If you think this is a mistake please send an email to <a href="mailto:bans@cryptoparrot.com">bans@cryptoparrot.com</a>.</p>

                    </div> 
                    </div>

                </div>

                </div>
                </div>

                              
                   

            


    @endsection 

    @section('content')
    @endsection

@endsection