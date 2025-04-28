@extends('pages.FrontSubsystem.layout-no-footer', 
[
    'title' => 'Login | Niffler.co',
    'classes' => '',
    'html_class' => 'login-screen',
    'description' => '',
	'poster' => 'assets/images/niffler-og.jpg'
])

@section('main')

    @parent

    @section('content')

    <div class="container-fluid h-100">
        <div class="row h-100">
            <main class="main-content col">
            <div class="main-content-container container-fluid px-4 my-auto h-100">

                <div class="row no-gutters h-100">
                <div class="col-lg-5 col-md-5 mx-auto my-auto">

  
                    <a class="navbar-brand mt-5 d-block text-center pb-4" href="/"> 
                    <img src="{{ asset('assets/images/niffler-vector-logo-v2.svg') }}" class="" alt="">
                    </a>

                    <div class="card card-register">
                        <div class="card-body p-5">
                            
                            <h4 class="h3 card-title mb-0 text-center font-weight-bold">
                              Sorry to see you go
                            </h4>

					   </div>

                    </div>

                    <div class="text-center  mt-3 mb-5">
                       <a class="font-weight-bold text-dark" href="/login">Log in</a> to control your notification settings 
                   </div>
 
                </div>
                </div>

            </div>
            </main>
        </div>
        </div>

    @endsection

@endsection