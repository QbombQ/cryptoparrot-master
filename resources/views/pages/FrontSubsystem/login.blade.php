@extends('pages.FrontSubsystem.layout', 
[
    'title' => 'Learn About Crypto Trading | Cryptocurrency Education | Crypto Parrot',
    'classes' => '',
    'html_class' => '',
    'description' => '',
    'header' => true,
    'header_class' => 'header-white ',
    'header_outer_class' => 'bg-login',
    'header_colour' => true,
	'poster' => 'assets/images/niffler-og.jpg'
])

@section('main')

    @parent 
    
    @section('header-landing')
    <div class="row justify-content-center py-5">


        <div class="col-xl-4 d-flex pt-xl-5">
           
            <div class="align-self-center w-100">

                
              <div class="card card-register">
                    <div class="card-body p-sm-5">
                        <h4 class="card-title mb-4 text-center font-weight-bold">
                            Login
                        </h4> 

                        @if ($errors->any())
                         <div style="position: fixed;bottom: 2rem;right: 2rem;z-index: 10;">
                          <!-- Then put toasts within -->
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

                        @if (session('message'))
                      
                        <div style="position: fixed;bottom: 2rem;right: 2rem;z-index: 10;">
                          <!-- Then put toasts within -->
                          <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                            <div class="toast-body"> 
                        
                        
                            <div class=""><i class="fa fa-exclamation-circle text-danger pr-1"></i>  <span class="font-weight-bold text-danger">{!! session('message') !!}</span>
                            </div>
                            

                            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                                <span class="iconify" data-icon="ant-design:close-circle-outlined" data-inline="false"></span>
                              </button>

                            </div>
                          </div>
                          
                        </div>

                        @endif 
                     
                         <form action="/login" method="post">
                            @csrf
                            
                            <input type="email" class="form-control form-control-lg mb-3" name="email" placeholder="Email">
                           
                            <input type="password" class="form-control form-control-lg mb-3" name="password" placeholder="Password">

                             <a href="/forgot-password" class="d-block mt-3 mb-3">Forgot your password?</a>
                          
                            <button type="submit" class="mb-3 btn download btn-primary btn-block btn-lg font-weight-bold">
                                Login <i class="far fa-sign-in-alt ml-1"></i>
                            </button> 

                            <p class="mb-0">
                            <span class="pr-2">Or login with</span> 
                            <a href="/social/google" class="lead  pr-1">
                                <span class="iconify" data-icon="ant-design:google-outline" data-inline="false"></span>
                            </a>
                            <a href="/social/twitter" class="lead  pr-1">
                                <span class="iconify" data-icon="ant-design:twitter-outline" data-inline="false"></span>
                            </a>
                            <a href="/social/reddit" class="lead  pr-1">
                                <span class="iconify" data-icon="ant-design:reddit-outline" data-inline="false"></span>
                            </a> 
                            <a href="/social/discord" class="lead pr-1">
                                  <i class="fab fa-discord"></i>
                            </a>
                            
                            </p> 

                        </form>


                    </div>
            </div>

            <div class="text-center  mt-3 mb-5">
                    Don't have an account?  <a class="font-weight-bold" href="/signup">Sign Up</a>
            </div>
 
     
            
            </div>

        </div> 
 
   
    </div>
    @endsection 

    @section('content')   

    @endsection

@endsection