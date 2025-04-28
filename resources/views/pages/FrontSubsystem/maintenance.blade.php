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
                              Down for maintenance.
                            </h4>
                            <p class="lead text-center mb-0">Server upgrade is in progress.<br/> Please check back in few hours.</p>

                             <a href="/" class="btn btn-lg btn-block btn-primary d-table mx-auto mt-4"> Try again</a>
                          

                            @php

                            if(isset($_GET['login'])){

                            @endphp

                            <form action="" method="post">
                            @csrf
                            <div class="input-group input-group-seamless mb-3">
                                <span class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="far fa-at"></i>
                                    </span>
                                </span>
                                <input type="email" class="form-control" name="email" placeholder="Email">
                            </div>
                            <div class="input-group input-group-seamless mb-3">
                                <span class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="far fa-lock-alt"></i>
                                    </span>
                                </span> 
                                <input type="password" class="form-control" name="password" placeholder="Password">
                            </div>
                    
                            <button type="submit" class="btn btn-lg btn-block btn-primary d-table mx-auto"><i class="far fa-sign-in-alt mr-1"></i> Login</button>
                            </form> 

                            @php

                            }

                            @endphp

                            @if ($errors->any())
                                <div class="alert alert-danger-outline alert-dismissible fade show mb-0 mt-2" role="alert">
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