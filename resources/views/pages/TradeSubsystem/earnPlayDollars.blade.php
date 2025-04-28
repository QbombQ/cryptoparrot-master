@extends('pages.TradeSubsystem.layout', 
[
    'title' => 'Crypto currency trading earnPlayDollars - Niffler.co',
    'classes' => 'h-100',
	'html_class' => '',
    'description' => '',
	'poster' => 'assets/images/niffler-og.jpg'
])

@section('main')

    @parent

    @section('styles')
        @parent
        <link rel="stylesheet" href="{{ asset('assets/css/TradeSubsystem/earnPlayDollars.css') }}">
    @endsection   

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

                     <h2><i class="far fa-money-bill-wave"></i></h2>
                      <h3 class="font-weight-bold text-grey">Coming soon</h3>
                      <p class="text-grey">Soon you will be able to earn more play dollars through our incentive program.</p> 
                      <a href="/app/rewards" class="btn btn-primary btn-lg"><i class="fal fa-arrow-left mr-2"></i> Go back</a> 

                  </div>  
                </main>
            </div>

        </div>
 

    @endsection

@endsection