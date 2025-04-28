@extends('pages.AdminSubsystem.layout', 
    [
    'html_class' => 'homepage', 
    'title' => 'Trade Pairs - CryptoParrot',
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

        <h2 class="mb-4 font-weight-bold">Trade Pairs <a href="/admin/pairs/new" class="btn ml-2 btn-primary" type="submit"> <i class="fal fa-plus mr-2"></i> New</a></h2>

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
                        <th>Pair</th>
                        <th>Rate</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @if(count($pairs['pairs']) > 0)
                            @php
                                $iterationFirst = !Request::segment(4) ? 1 : (Request::segment(4) - 1) * config('custom.admin.itemsPerPage') + 1;
                            @endphp
                            @foreach($pairs['pairs'] as $pair)                 
                                <tr>
                                    <td><span class="td-holder"><span class="td-inner align-self-center w-100">{{$iterationFirst++}}</span></span></td>
                                    <td><span class="td-holder"><span class="td-inner align-self-center w-100">{{$pair['from_acronym']}}/{{$pair['to_acronym']}}</span></span></td>
                                    <td><span class="td-holder"><span class="td-inner align-self-center w-100">{{$pair['rate']}}</span></span></td>
                                    <td><span class="td-holder"><span class="td-inner align-self-center w-100"><a href="/admin/pairs/{{$pair['id']}}/edit" class="btn btn-primary">Edit</a></span></span></td>
                                </tr>
                            @endforeach
                        @else
                            <tr><td>No pairs yet</td></tr>
                        @endif
                    </tbody>
                </table>
                       


            </div>

             @if(isset($pairs['pagination']))
                            {!! $pairs['pagination'] !!}
                        @endif
                    

        </div>

        <div class="col-xl-3">



              
        </div>
        </div>


        @include('pages.AdminSubsystem.common.footer') 

@endsection  
  
@section('footer')

@endsection  




