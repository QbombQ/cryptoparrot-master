@extends('pages.AdminSubsystem.layout', 
    [
    'html_class' => 'homepage', 
    'title' => 'Rewards - CryptoParrot',
    ]
)
 
@section('content')

    @include('pages.AdminSubsystem.common.header') 
 
        <div class="row">

          @if(Session::has('alert'))
          <div class="col-xl-12 pb-2 mt-4">
              <div class="alert alert-warning">{!! session('alert') !!}</div>
          </div>
          @endif

    
        </div>

        <h2 class="mb-4 font-weight-bold">Rewards</h2>


        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif


        <div class="row">
        <div class="col-xl-9">


        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="/admin">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Exchanges</strong>
            </li>
            
        </ol>

             <div class="table-responsive">
             <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>User</th>
                                <th>Amount</th>
                                <th>Exchanged to</th>
                                <th>Rate</th>
                                <th>Exchanged amount</th>
                                
                                <th>Status</th>
                                <th>Date</th>
                                <th>Address</th>
                            </tr>
                            </thead>
                            <tbody>
                                @if(count($exchanges['exchanges']) > 0)
                                    @php
                                        $iterationFirst = !Request::segment(4) ? 1 : (Request::segment(4) - 1) * 20 + 1;
                                        
                                    @endphp
                                    @foreach($exchanges['exchanges'] as $exchange)          
                                        <tr>
                                            <td><span class="td-holder"><span class="td-inner align-self-center w-100">{{$iterationFirst++}}</span></span></td>
                                            <td><span class="td-holder"><span class="td-inner align-self-center w-100"><a href="/{{$exchange['user']}}">{{$exchange['user']}}</a></span></span></td>
                                            <td><span class="td-holder"><span class="td-inner align-self-center w-100">{{$exchange['amount']}}</span></span></td>
                                            <td><span class="td-holder"><span class="td-inner align-self-center w-100">{{$exchange['exchange_to']}}</span></span></td>
                                            <td><span class="td-holder"><span class="td-inner align-self-center w-100">{{$exchange['exchange_rate']}}</span></span></td>
                                            <td><span class="td-holder"><span class="td-inner align-self-center w-100">{{$exchange['exchanged_amount']}}</span></span></td>
                                            
                                            <td><span class="td-holder"><span class="td-inner align-self-center w-100">{{$exchange['status']}}</span></span></td>
                                            <td><span class="td-holder"><span class="td-inner align-self-center w-100">{{$exchange['date']}}</span></span></td>
                                            <td><span class="td-holder"><span class="td-inner align-self-center w-100">{{$exchange['invoice_address']}}</span></span></td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr><td><span class="td-holder"><span class="td-inner align-self-center w-100">No exchanges yet</span></span></td></tr>
                                @endif
                            </tbody>
                        </table> 
                </div>
                        @if(isset($exchanges['pagination']))
                            {!! $exchanges['pagination'] !!}
                        @endif

        </div>
        </div>


        @include('pages.AdminSubsystem.common.footer') 

@endsection  
  
@section('footer')

@endsection  




 