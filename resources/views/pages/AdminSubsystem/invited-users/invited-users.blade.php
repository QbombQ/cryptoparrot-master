@extends('pages.AdminSubsystem.layout', 
    [
    'html_class' => 'homepage', 
    'title' => 'Invited Users - CryptoParrot',
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

        <h2 class="mb-4 font-weight-bold">Invited Users</h2>


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
                <strong>Invited Users</strong>
            </li>
            
        </ol>

             <div class="table-responsive">
        
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Invited user</th>
                                <th>Trades</th>
                                <th>Invited by (total invited)</th>
                                <th>Registered at</th>
                            </tr>
                            </thead>
                            <tbody>
                                @if(count($invitedUsers['invitedUsers']) > 0)
                                    @php
                                        $iterationFirst = !Request::segment(4) ? 1 : (Request::segment(4) - 1) * config('custom.admin.itemsPerPage') + 1;
                                    @endphp
                                    @foreach($invitedUsers['invitedUsers'] as $invitedUser)                 
                                        <tr>
                                            <td><span class="td-holder"><span class="td-inner align-self-center w-100">{{$iterationFirst++}}</span></td>
                                            <td><span class="td-holder"><span class="td-inner align-self-center w-100">{!!$invitedUser['username']!!}</span></td>
                                            <td><span class="td-holder"><span class="td-inner align-self-center w-100">{{$invitedUser['trades']}}</span></td>
                                            <td><span class="td-holder"><span class="td-inner align-self-center w-100">{!!$invitedUser['invitedBy']!!}</span></td>
                                            <td><span class="td-holder"><span class="td-inner align-self-center w-100">{{$invitedUser['registeredAt']}}</span></td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr><td>No invited users yet</td></tr>
                                @endif
                            </tbody>
                        </table>
                        @if(isset($invitedUsers['pagination']))
                            {!! $invitedUsers['pagination'] !!}
                        @endif
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




