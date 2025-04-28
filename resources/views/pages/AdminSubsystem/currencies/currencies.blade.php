@extends('pages.AdminSubsystem.layout', 
    [
    'html_class' => 'homepage', 
    'title' => 'Currencies - CryptoParrot',
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

        <h2 class="mb-4 font-weight-bold">Currencies <a href="/admin/currencies/new" class="btn ml-2 btn-primary" type="submit"> <i class="fal fa-plus mr-2"></i> New</a></h2>

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
                <strong>Trade Pairs</strong>
            </li>
            
        </ol>

            <div class="table-responsive">

                <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Acronym</th>
                                <th>Symbol</th>
                                <th>USD Rate</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @if(count($currencies['currencies']) > 0)
                                    @php
                                        $iterationFirst = !Request::segment(4) ? 1 : (Request::segment(4) - 1) * config('custom.admin.itemsPerPage') + 1;
                                    @endphp
                                    @foreach($currencies['currencies'] as $currency)                 
                                        <tr>
                                            <td><span class="td-holder"><span class="td-inner align-self-center w-100">{{$iterationFirst++}}</span></span></td>
                                            <td><span class="td-holder"><span class="td-inner align-self-center w-100">{{$currency['name']}}</span></span></td>
                                            <td><span class="td-holder"><span class="td-inner align-self-center w-100">{{$currency['acronym']}}</span></span></td>
                                            <td><span class="td-holder"><span class="td-inner align-self-center w-100">{{$currency['symbol']}}</span></span></td>
                                            <td><span class="td-holder"><span class="td-inner align-self-center w-100">{{$currency['usd_value']}}</span></span></td>
                                            <td><span class="td-holder"><span class="td-inner align-self-center w-100">{{$currency['description']}}</span></span></td>
                                            <td><span class="td-holder"><span class="td-inner align-self-center w-100"><a href="/admin/currencies/{{$currency['id']}}/edit" class="btn btn-primary btn-xs">Edit</a></span></span></td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr><td>No currencies yet</td></tr>
                                @endif
                            </tbody>
                        </table>
                       


            </div>

              @if(isset($currencies['pagination']))
                            {!! $currencies['pagination'] !!}
                        @endif
                    

        </div>

        <div class="col-xl-3">



              
        </div>
        </div>


        @include('pages.AdminSubsystem.common.footer') 

@endsection  
  
@section('footer')

@endsection  




