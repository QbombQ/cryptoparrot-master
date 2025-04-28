@extends('pages.FrontSubsystem.layout', 
[
    'title' => 'You\'re Almost There!',
    'classes' => '',
    'html_class' => '',
    'description' => 'Check your mailbox, shortly you will receive email asking to verify your email address.',
	'poster' => 'assets/images/niffler-og.jpg'
])

@section('main')

    @parent

    @section('content')

        @if (session('message'))
            <div class="alert alert-success mb-0">
                {{ session('message') }}
            </div>
        @endif

        <!-- Welcome Section -->
        <div class="welcome d-flex justify-content-center flex-column ">

            @include('pages.FrontSubsystem.common.header') 

				<div class="container-fluid h-100">
			        <main class="main-content col">
			          <div class="main-content-container container-fluid px-4 my-auto h-100">
			            <div class="row no-gutters h-100">
			              <div class="col-lg-3 col-md-5 auth-form mx-auto my-auto">
			                <div class="card mt-5">
			                  <div class="card-body">
			                  	
			                    @if (session('message'))

	                            <h4 class="card-title mb-0">You're Almost There!</h4>
	                            <p class="mb-3">

	                            {{ session('message') }}

	                            </p>

	                            @endif

			              
			                    <a href="/" class="btn btn-md btn-pill btn-primary d-table mx-auto">
			                    <i class="fal fa-chevron-circle-left mr-1"></i> Go Back</a>
			                   
			                  </div>
			                </div>
			              </div>
			            </div>
			          </div>
			        </main>
			    </div>

  
            <!-- / Inner Wrapper -->
        </div>
        <!-- / Welcome Section --> 

    @endsection

@endsection