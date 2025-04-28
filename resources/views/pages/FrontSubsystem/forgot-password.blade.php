@extends('pages.FrontSubsystem.layout', 
[
    'title' => 'Forgot Password | CryptoParrot',
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


        <div class="col-xl-4 d-flex pt-5">
           
            <div class="align-self-center w-100">

                
              <div class="card card-register">
                    <div class="card-body p-sm-5">

                        @if (session('message'))

                            <h4 class="h3 card-title mb-4 text-center font-weight-bold">
                              Reset password
                            </h4>

                            <p class="text-center mb-0">{{ session('message') }}</p>

                        @else

                        <h4 class="card-title mb-4 text-center font-weight-bold">
                           Reset password
                        </h4> 

                        @if ($errors->any())
                        <div class="alert alert-danger-outline alert-dismissible fade show mb-3 mt-2" role="alert">
                        @foreach ($errors->all() as $error)
                       
                            <div><i class="fa fa-exclamation-circle"></i> 
                            {{ $error }}</div>
                       
                        @endforeach
                        </div>
                        @endif

                        @if (session('message'))
                        <div class="alert alert-danger-outline alert-dismissible fade show mb-0 mt-2" role="alert">
                            <div><i class="fa fa-exclamation-circle"></i> 
                            {!! session('message') !!}</div>
                            
                        </div>
                        @endif  
                     
                         <form action="/forgot-password" method="post">
                            @csrf
                            
                        
                            <input type="email" class="form-control form-control-lg mb-3" name="email" placeholder="Email address">
                                
                        
                            <button type="submit" class="mb-3 btn download btn-primary btn-block btn-lg font-weight-bold">
                                Reset my password
                            </button> 

                         

                        </form>

                        @endif


                    </div>
            </div>

            <div class="text-center text-white mt-3 mb-5">
                    Don't have an account?   <a class="font-weight-bold text-white" href="/signup">Sign Up</a>
            </div>
 
     
            
            </div>

        </div> 
 
   
    </div>
    @endsection 

    @section('content')
    @endsection

@endsection