@extends('pages.TradeSubsystem.layout', 
[
    'title' => 'Crypto currency trading prizes - Niffler.co',
    'classes' => 'h-100',
	'html_class' => '',
    'description' => '',
	'poster' => 'assets/images/niffler-og.jpg'
])

@section('main')

    @parent

    @section('styles')
        @parent
        <link rel="stylesheet" href="{{ asset('assets/css/TradeSubsystem/prizes.css') }}">
    @endsection   

    @section('content')

        <div class="container-fluid">
        <div class="row">

            @include('pages.TradeSubsystem.common.sidebar') 
            <main class="main-content col-xl-10 col-lg-9 col-md-9 col-sm-12 p-0 offset-xl-2 offset-lg-3 offset-md-3">

            @include('pages.TradeSubsystem.common.header') 
            <div class="main-content-container container-fluid px-4 pt-2 ">

             <div class="row">

             	<div class="col-12">
             		@if (session('message_success'))
                        <div class="alert mb-3 alert-success mb-3">
                            {{ session('message_success') }}
                        </div>
                	@endif 
                    @if (session('message_failed'))
                        <div class="alert mb-3 alert-danger mb-3">
                            {{ session('message_failed') }}
                        </div>
                	@endif 
             	</div>   

                

                <div class="col-12">

                    <table class="table">
                        <thead>
                            <tr>
                                <th>Prize</th>
                                <th>Description</th>
                                <th>Date</th>
                                <th>Price paid</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($prizes) > 0)

                                @foreach($prizes as $prize)
            
                                    <tr>
                                        <td>{{$prize['title']}}</td>
                                        <td>{{$prize['description']}}</td>
                                        <td>{{$prize['date']}}</td>
                                        <td>${{$prize['price_paid']}}</td>
                                    </tr>

                                @endforeach
                            @else
                                <tr>Nothing to show</th>
                            @endif
                        </tbody>
                    </table>
                </div>

                <div class="col-12">

                    You have ${{$amountLeft}} left

                    <a href="/app/prizes" class="btn btn-primary">Prizes</a>

                </div>
                
        	  </div>

            </div>
            @include('pages.TradeSubsystem.common.footer')
            </main>
        </div>
        </div>

    @endsection

@endsection