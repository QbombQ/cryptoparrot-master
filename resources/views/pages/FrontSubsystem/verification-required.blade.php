@extends('pages.FrontSubsystem.layout-no-footer', 
[
    'title' => 'Learn About Crypto Trading | Cryptocurrency Education | Niffler.co',
    'classes' => 'h-100 shards-app--login',
    'html_class' => 'login-screen',
    'description' => '',
    'poster' => 'assets/images/niffler-og.jpg'
])

@section('main')

    @parent

    @section('content') 

    <script type="text/javascript">
        
        //document.location.href="/app";

    </script> 


    <div class="container-fluid h-100">
        <div class="row h-100">
            <main class="main-content col">
            <div class="main-content-container container px-4 my-auto h-100">
                <div class="row no-gutters h-100">
                <div class="col-lg-5 col-md-8 mx-auto my-auto">

 
                    <a class="navbar-brand mt-5 d-block text-center pb-4" href="/"> 
                    <img src="{{ asset('assets/images/niffler-logo-white.png') }}" class="" alt="">
                    </a>

                    <div class="card card-register">
                        <div class="card-body p-5">
                            
                            <h4 class="h3 card-title mb-4 text-center font-weight-bold">

                              <i style="opacity: 0.2;" class="fal fa-cogs fa-3x mb-4"></i><br/>
                              You need to verify your email to access this page.
                            </h4>

                        </div>

                    </div>
 
                </div>
                </div>
            </div>
            </main>
        </div>
        </div>



    @endsection

@endsection