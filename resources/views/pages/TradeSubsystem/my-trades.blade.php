@extends('pages.TradeSubsystem.layout', 
[
    'title' => 'My Trades',
    'classes' => 'h-100',
    'html_class' => '',
    'description' => '',
	'poster' => ''
])
 
@section('main')

    @parent


    @section('styles')
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/fixedcolumns/3.3.0/css/fixedColumns.dataTables.min.css">
        @parent
        
        <link rel="stylesheet" href="https://unpkg.com/scroll-hint@latest/css/scroll-hint.css">
    @endsection   
   
  
    @section('content')

        <div class="wrapper">

            <div class="sidebar">
                @include('pages.TradeSubsystem.common.sidebar') 
            </div>
            <div class="main">

                <div class="shade"></div>
                
                @include('pages.TradeSubsystem.common.header') 

                <main class="main-content pt-4 pb-4 pt-sm-4 py-lg-5">
                  <div class="px-4 px-lg-5"> 

                    <h5 class="mb-3 mb-sm-4 d-flex">
                        <span class="pr-4 align-self-center">My Trades</span>

                        <span class="ml-auto ml-lg-0">
                        <select id="trade-filter-select" class="select-2 d-none">
                            <option value="">View All</option>
                            <option @if(isset($_GET['status']) && $_GET['status'] === 'active') selected @endif value="active">Active/Open</option>
                            <option @if(isset($_GET['status']) && $_GET['status'] === 'cancelled') selected @endif value="cancelled">Cancelled</option>
                            <option @if(isset($_GET['status']) && $_GET['status'] === 'liquidated') selected @endif value="liquidated">Liquidated</option>
                            <option @if(isset($_GET['status']) && $_GET['status'] === 'finished') selected @endif value="finished">Finished</option>
                        </select>
                        </span>

                    </h5> 

              
                    @if($commonUserData['status'] == 'unconfirmed')
                        <div class="alert no-radius alert-warning alert-dismissible fade show mb-4" role="alert">
                        <span>Your trade won't be public unless you verify your email.</span>
                        <a class="alert-link" id="resend">Re-send verification email</a>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>

                        <div class="toast-block" id="success-alert" style="display: none;">
                         
                          <div class="toast success" role="alert" aria-live="assertive" aria-atomic="true">
                          
                            <div class="toast-body"> 
                            
                            <div class="text-white">
                                <i class="fa fa-check-circle mr-1"></i> 
                                <span id="success-alert-text"></span>
                            </div>
 
                            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                                <span class="iconify" data-icon="ant-design:close-circle-outlined" data-inline="false"></span>
                              </button>

                            </div>
                          </div>
                        
                        </div>  


                    @endif

                    @php $page = 'trade'; @endphp
                    
                    <div class="d-none d-sm-block text-muted font-weight-medium small mb-3 px-0 legend">
                      <span class="mr-4"><i class="fas fa-circle  text-success mr-1"></i> Active/Open</span>
                      <span class="mr-4"><i class="fas fa-circle  text-danger mr-1"></i> Liquidated</span>
                      <span class="mr-4"><i class="fas fa-circle  text-secondary mr-1"></i> Finished</span>
                      <span class="mr-4"><i class="fas fa-circle  text-dark mr-1"></i> Cancelled</span>
                    </div>
                    
 
                    <div class="row pt-2">  

                      <div class="col col-xl-12 col-md-12 col-sm-12 mb-4">
       
                        <script type="text/javascript">
                                @if(count($myTrades['data']) > 0)
                                  var hasTrades = true;
                                @else
                                  var hasTrades = false;
                                @endif
                              </script>

                        @if(count($myTrades['data']) > 0)
                        <div class="table-responsive js-scrollable">
                        <table id="active-orders-table" class="table table-no-wrap">
                            
                     
                            <thead>
                              <tr> 
                                <th scope="col">#</th>
                                <th scope="col">ORDER</th>
                                <th scope="col">PAIR</th>
                                <th scope="col">PRICE</th>
                                <th scope="col">VOLUME</th>
                                <th scope="col">COST</th>
                                <th scope="col">LEVERAGE</th>
                                <th scope="col">FEE</th>
                                <th scope="col">OPENED</th>
                                <th scope="col">SL / TP</th>
                                <th scope="col">PROFIT / LOSS</th>
                                <th scope="col">ACTION</th>
                              </tr>
                            </thead>
                           

                            <tbody>
                        

                              @foreach($myTrades['data'] as $myTrade)
                                <tr>
                                  <td scope="row">
                                    <span class="td-inner">
                                      @if($myTrade['status'] === 'active' || $myTrade['status'] === 'open')
                                        <i class="fas fa-circle small text-success mr-1"></i>
                                      @elseif($myTrade['status'] === 'cancelled')
                                        <i class="fas fa-circle small text-dark mr-1"></i>
                                      @elseif($myTrade['status'] === 'liquidated')
                                        <i class="fas fa-circle small text-danger mr-1"></i>
                                      @else
                                        <i class="fas fa-circle small text-secondary mr-1"></i>
                                      @endif

                                      {{$myTrade['id']}}
                                    </span>
                                  </td>
                              
                                  
                                  <td scope="row"><span class="td-inner">{{$myTrade['type']}}</span></td>
                                  <td scope="row"><span class="td-inner">{{$myTrade['pair']}}</span></td>
                                  <td scope="row"><span class="td-inner">{{$myTrade['targetPrice']}}</span></td>
                                  <td scope="row"><span class="td-inner">{{$myTrade['amount']}} <small class="text-muted">
                                    <?php 
                                      $pairParts = explode('/', $myTrade['pair']);
                                      $pairSymbol = $pairParts[0];
                                    ?>
                                    {{$pairSymbol}}</small>
                                  </span>
                                  </td>
                                  <td scope="row"><span class="td-inner">{{$myTrade['cost']}}</span></td>
                                  <td scope="row"><span class="td-inner">{{$myTrade['leverage']}}</span></td>
                                  <td scope="row"><span class="td-inner">{{$myTrade['tradeFeeSymbol']}} {{$myTrade['tradeFee']}}</span></td>
                                  <td scope="row"><span class="td-inner">{{$myTrade['opened']}}</span></td>
                                  <td scope="row"><span class="td-inner">{{$myTrade['stopLoss']}} / {{$myTrade['takeProfit']}}</span></td>
                                  <td scope="row"><span class="td-inner"><span class="{{$myTrade['profitClass']}} font-weight-bold">{{$myTrade['profit']}}</span>

                                    @if($myTrade['profit'] != 'n/a') <small class="text-muted"> inc. fee </small> @endif
                                  </span></td>
                                  <td scope="row">
                                    <span class="td-inner">

                                    <a class="text-purple-pale" href="/{{Auth::user()->handle}}/trade/{{$myTrade['id']}}">  
                                    <span class="iconify" data-icon="ant-design:eye-outline" data-inline="false"></span>
                                    </a>

                                    @if($myTrade['status'] === 'active')

                                    <a class="text-purple-pale trade-action cancel-trade" href="/app/trade/{{$myTrade['id']}}/cancel">

                                    <span class="iconify" data-icon="ant-design:close-circle-outline" data-inline="false"></span>

                                    </a>

                                    @elseif($myTrade['status'] === 'open')

                                    <a class="text-purple-pale  close-trade trade-action" href="/app/trade/{{$myTrade['id']}}/close">
                                      <span class="iconify" data-icon="ant-design:check-circle-outline" data-inline="false"></span>
                                    </a>

                                    <a href="" data-toggle="modal" data-target="#manageTrade" data-id="{{$myTrade['id']}}" data-sl="{{$myTrade['stopLoss']}}" data-tp="{{$myTrade['takeProfit']}}" class="text-purple-pale manage-trade trade-action"> 
                                      
                                      <span class="iconify" data-icon="ant-design:edit-outline" data-inline="false"></span>

                                    </a>

                                    @endif  
                                    

                                    </span>
                                    <!--<div class="dropdown">
                                      <button class="btn btn-secondary dropdown-toggle btn-sm btn-block" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Actions
                                      </button>
                                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                       
                                         <a class="dropdown-item" href="/{{Auth::user()->handle}}/trade/{{$myTrade['id']}}">View</a>

                                         @if($myTrade['status'] === 'active')
                                            <a class="dropdown-item trade-action cancel-trade" href="/app/trade/{{$myTrade['id']}}/cancel"><i class="far fa-times mt-1 float-right"></i> Cancel</a>

                                        @elseif($myTrade['status'] === 'open')
                                          <a class="dropdown-item close-trade trade-action" href="/app/trade/{{$myTrade['id']}}/close"><i class="far fa-times mt-1 float-right"></i> Close</a>
                                          <a data-toggle="modal" data-target="#manageTrade" data-id="{{$myTrade['id']}}" data-sl="{{$myTrade['stopLoss']}}" data-tp="{{$myTrade['takeProfit']}}" class="dropdown-item manage-trade trade-action"><i class="mt-1 far fa-pencil-alt float-right"></i> Manage</a>
                                        @endif

                                      </div>
                                    </div>-->
                                  </td>
                                </tr>
                              @endforeach

                          
                            </tbody>
                          </table> 
                        </div>
                        @else

                         <div class="p-5 text-center">
                          <h2><i class="far fa-money-check text-grey"></i></h2>
                          <h3 class="font-weight-bold text-grey mb-1">There are no trades</h3>
                          <p class="text-grey">Make sure you are viewing the correct portfolio.</p> 
                          <a href="/app" class="new-trade btn btn-primary btn-lg"><i class="far fa-exchange-alt mr-2 "></i> Post a trade</a>
                        </div>

                        @endif
                    
                    <div class=" pb-4 pb-lg-0 mt-3 mt-lg-4">
                    {!! $myTrades['pagination'] !!}
                    </div>

                    </div>

                  </div> 

                  </div>  
                </main> 
            </div>

        </div> 

    
        <div id="manageTrade" class="modal fade" role="dialog">

          <button type="button" class="close" data-dismiss="modal"><i class="fal fa-times"></i></button>

          <div class="modal-dialog">

              <!-- Modal content-->
              <div class="modal-content p-5">

                <div class="row">

                  <div class="col-12">

                    <h4 class="font-weight-bold">Manage trade</h4>

                    <p class="alert alert-warning">Use with caution, setting wrong values may execute trade immediatly</p>

                    <form action="/app/trades/edit/" method="post" id="manage-trade-form">
                        @csrf
                        <div class="form-group">
                            <p class="mb-1 font-weight-bold">Take Profit:</p>
                            <input class="form-control" name="take_profit" placeholder="Take profit" required/>
                        </div>
                        <div class="form-group">
                            <p class="mb-1 font-weight-bold">Stop Loss:</p>
                            <input class="form-control" name="stop_loss" placeholder="Stop loss" required/>
                        </div>
                        <button id="manage-trade" class="btn btn-primary btn-lg btn-block mt-2" type="submit">
                            Update
                        </button>
                    </form>

                    <p class="manage-trade-errors mt-4 mb-0"></p>

                  </div>

                </div>

              </div>

          </div>
        </div>

        
    @endsection

    @section('body-scripts')
        @parent   
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
        <script src="https://cdn.datatables.net/fixedcolumns/3.3.0/js/dataTables.fixedColumns.min.js"></script>
        <script src="https://unpkg.com/scroll-hint@latest/js/scroll-hint.min.js"></script>
        <script src="{{asset('assets/js/TradeSubsystem/my-trades.js')}}"></script>
    @endsection    

    

@endsection