@extends('pages.TradeSubsystem.layout', 
[
    'title' => 'Verification',
    'classes' => 'h-100',
    'html_class' => '',
    'description' => '',
    'poster' => ''
])

@section('main')

    @parent

    @section('content')



        <div class="wrapper">

            <div class="sidebar">
                @include('pages.TradeSubsystem.common.sidebar') 
            </div>
            <div class="main">

                <div class="shade"></div>
                
                @include('pages.TradeSubsystem.common.header') 

                <main class="main-content py-5 text-center">
                  <div class="px-5 py-xl-5">

                     <h2><i class="fal fa-hand-paper text-grey"></i></h2>
                      <h3 class="font-weight-bold text-grey">Restricted access</h3>
                      <p class="text-grey">Please verify your email in order to direct message other users</p> 
                      <a href="/app/settings" class="btn btn-primary btn-lg"><i class="far fa-cog mr-2 "></i> Settings</a>

                  </div>  
                </main>
            </div>

        </div> 

    @endsection

@endsection