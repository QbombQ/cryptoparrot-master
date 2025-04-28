@extends('pages.TradeSubsystem.layout', 
[
    'title' => 'Crypto currency trading rewards - Niffler.co',
    'classes' => 'h-100',
	'html_class' => '',
    'description' => '',
	'poster' => 'assets/images/niffler-og.jpg'
])

@section('main')

    @parent

     @section('styles')
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/fixedcolumns/3.3.0/css/fixedColumns.dataTables.min.css">
        @parent
        
        <link rel="stylesheet" href="https://unpkg.com/scroll-hint@latest/css/scroll-hint.css">
        <link rel="stylesheet" href="{{ asset('assets/css/TradeSubsystem/rewards.css') }}">
    @endsection    

    @section('content')

        <div class="wrapper">

            <div class="sidebar">
                @include('pages.TradeSubsystem.common.sidebar') 
            </div>
            <div class="main">

                <div class="shade"></div>
                
                @include('pages.TradeSubsystem.common.header') 

                <main class="main-content  main-content-md py-3 py-lg-5">
                  <div class="px-3 px-lg-5">

                    <div class="row justify-content-center">

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

                        <div class="col-xl-11">
                        
                        <div class="mb-3 mb-sm-4 mb-lg-5">
 
                                <a href="/app/rewards" class="lead font-weight-medium link pr-4 ">
                                    <span class="mb-0 iconify h4 mr-1" data-icon="ant-design:gift-outline" data-inline="false"></span><span> Rewards</span>
                                </a>
                                <a href="/app/reward-history"class="lead font-weight-medium link pr-4 active">
                                    <span class="mb-0  iconify h4 mr-1" data-icon="ant-design:bell-outline" data-inline="false"></span><span class="d-none d-sm-inline-block"> Reward History</span>
                                </a>
                               
                        </div>

                        </div>
 
                        <div class="col-xl-11 pb-4">

                            <div class="card-patron card bg-purple card-small">
                            <div class="card-trader-status">
                            <div class="card-body p-4 p-md-5"> 


                                <h4 class="h2 font-weight-bold ">Reward History</h4>
                                <p class="mb-2 lead">Explore your reward history and see every claim you have made with your account. It's impressive how quickly play dollars can turn into real Bitcoin. </p> 

                            </div> 
                            </div>
                            </div>
  
                  

                            <h4 class="mt-4 font-weight-bold">Your transactions</h4>

                            <div class="table-responsive js-scrollable">
                            <table id="claim-table" class="table mt-4">
                                <thead>
                                    <tr>
                                        <th>Play dollars</th>
                                        <th>Exchanged to</th>
                                        <th>Rate</th>
                                        <th>BTC amount in Sats</th>
                                        <th>Address</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($exchanges) > 0)

                                        @foreach($exchanges as $exchange)
                    
                                            <tr>
                                                <td><span class="td-inner">{{$exchange['amount']}}</span></td>
                                                <td><span class="td-inner">{{$exchange['exchange_to']}}</span></td>
                                                <td><span class="td-inner">{{$exchange['exchange_rate']}}</span></td>
                                                <td><span class="td-inner">{{$exchange['exchanged_amount']}}</span></td>
                                                <td><span class="td-inner"><span class="address-ln">{{$exchange['invoice_address']}}</span></span></td>
                                                <td><span class="td-inner">{{$exchange['status']}}</span></td>
                                                <td><span class="td-inner">{{$exchange['date']}}</span></td>
                                            </tr> 

                                        @endforeach
                                    @else
                                         <tr><th colspan="7"><span class="td-inner text-center">Nothing to show</span></th></tr>
                                    @endif
                                </tbody>
                            </table>
                            </div>

                        </div>

                  


                        
                      </div>

                  </div>  
                </main>
            </div>

        </div>

    @endsection

    @section('body-scripts')
        @parent   
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
        <script src="https://cdn.datatables.net/fixedcolumns/3.3.0/js/dataTables.fixedColumns.min.js"></script>
        <script src="https://unpkg.com/scroll-hint@latest/js/scroll-hint.min.js"></script>
    @endsection  

@endsection