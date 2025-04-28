@extends('pages.FrontSubsystem.layout', 
[
    'title' => 'Set New Password | CryptoParrot',
    'classes' => '',
    'html_class' => '',
    'header' => true,
    'header_outer_class' => 'bg-purple-gradient', 
    'header_class' => 'bg-header bg-header-right', 
    'description' => '',
    'poster' => 'assets/images/poster.jpg'
])

@section('main')

    @parent

    @section('header-landing')
    <div class="row justify-content-center py-5">


        <div class="col-xl-4 d-flex pt-xl-5">
           
            <div class="align-self-center w-100">

                
              <div class="card card-register">
                    <div class="card-body p-sm-5">
                       
 
                        @if ($errors->any())
                         <div style="position: fixed;bottom: 2rem;right: 2rem;z-index: 10;">
                         
                          <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                          
                            <div class="toast-body"> 
                            
                            @foreach ($errors->all() as $error)
                            <div class=""><i class="fa fa-exclamation-circle text-danger pr-1"></i>  <span class=" text-danger">{{ $error }}</span>
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

                        <h4 class="h3 card-title mb-4 text-center font-weight-bold">
                          Reset password
                        </h4>

                        <p class="text-center mb-0">{{ session('message') }}</p>

                        @else

                        <h4 class="h3 card-title mb-4 text-center font-weight-bold">
                          Reset password
                        </h4>

                        <form action="/change-password" method="post">
                            @csrf
                            <div class="input-group input-group-seamless mb-3">
                               
                                <input type="password" class="form-control form-control-lg" name="password" placeholder="New password">
                            </div>
                            <div class="input-group input-group-seamless mb-3">
                                
                                <input type="password" class="form-control form-control-lg" name="password_confirmation" placeholder="Repeat new password">
                            </div>       
                            <input type="hidden" class="form-control" name="token" value="{{ $token }}" placeholder="New password confirmation">    
                            <button type="submit" class="mb-2 btn download btn-primary btn-block btn-lg font-weight-bold">
                            Set new password
                            </button> 
 
                          


                        </form>

                         @endif


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