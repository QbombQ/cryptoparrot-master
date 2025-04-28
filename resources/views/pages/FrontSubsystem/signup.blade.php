@extends('pages.FrontSubsystem.layout', 
[
    'title' => 'Sign Up - It\'s free | Cryptocurrency Education | Niffler.co',
    'classes' => '',
    'html_class' => '',
    'header' => true,
    'header_outer_class' => 'bg-purple-gradient', 
    'header_class' => 'bg-header bg-header-right', 
    'description' => '',
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
                            Sign Up
                        </h4> 

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

                        @if (session('message'))
                        <div style="position: fixed;bottom: 2rem;right: 2rem;z-index: 10;">
                         
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
                     
                         <form action="/register" method="post">
                            @csrf
                            
                            
                            <input autocomplete="username" type="text" class="form-control  form-control-lg mb-3" name="username" id="form1-username" value="{{ old('username') }}" placeholder="Username">
                            
                            <input autocomplete="email" type="email" class="form-control form-control-lg mb-3" name="email" id="form1-email" value="{{ old('email') }}" placeholder="Email">
                              
                            <input type="password" class="form-control form-control-lg mb-3" name="password" id="form1-password" placeholder="Password">
                                
                        
                            <button type="submit" class="mb-3 btn download btn-primary btn-block btn-lg font-weight-bold">
                                Create Your Account
                            </button> 

                            <p class="mb-0">
                            <span class="pr-2">Or sign up with</span> 
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

            <div class="text-center text-white mt-3 mb-5">
                    Have an account?  <a class="font-weight-bold text-white" href="/login">Login</a>
            </div>
 
     
            
            </div>

        </div> 
 
   
    </div>
    @endsection 

    @section('content')
    @endsection

@endsection