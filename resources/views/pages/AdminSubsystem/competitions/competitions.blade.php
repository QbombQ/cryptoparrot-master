@extends('pages.AdminSubsystem.layout', 
    [
    'html_class' => 'homepage', 
    'title' => 'Competitions - CryptoParrot',
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

        <h2 class="mb-4 font-weight-bold">Competitions <a href="/admin/competitions/new" class="btn ml-2 btn-primary" type="submit"> <i class="fal fa-plus mr-2"></i> New</a></h2>


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
                <strong>Competitions</strong>
            </li>
            
        </ol>

            <div class="table-responsive">

                <table class="table table-hover table-striped">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                                @if(count($competitions['competitions']) > 0)
                                    @php
                                        $iterationFirst = !Request::segment(4) ? 1 : (Request::segment(4) - 1) * config('custom.admin.itemsPerPage') + 1;
                                    @endphp
                                    @foreach($competitions['competitions'] as $competition)                 
                                        <tr>
                                            <td class="align-middle"><span class="td-holder"><span class="td-inner align-self-center w-100">{{$iterationFirst++}}</span></span></td>
                                            <td class="align-middle"><span class="td-holder"><span class="td-inner align-self-center w-100">{{$competition['title']}}</span></span></td>
                                            <td class="align-middle"><span class="td-holder"><span class="td-inner align-self-center w-100">{{$competition['start_date']}}</span></span></td>
                                            <td class="align-middle"><span class="td-holder"><span class="td-inner align-self-center w-100">{{$competition['end_date']}}</span></span></td>
                                            <td class="align-middle"><span class="td-holder"><span class="td-inner align-self-center w-100"><a href="/app/competitions/{{$competition['id']}}" class="btn btn-default btn-sm mr-2">View</a><a href="/admin/competitions/{{$competition['id']}}/edit" class="btn btn-primary btn-sm mr-2">Edit</a><a href="/admin/competitions/{{$competition['id']}}/delete" class="btn btn-danger btn-sm" onClick="return confirm('Are you sure you want to delete competition?')">Delete</a></span></span></td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr><td>No competitions yet</td></tr>
                                @endif
                            </tbody>
                        </table>
                       


            </div>
                        @if(isset($competitions['pagination']))
                            {!! $competitions['pagination'] !!}
                        @endif

        </div>

        <div class="col-xl-3">

            @php                
                $allowed_goals = array(
                    'meetup', 
                    'steem',
                    'gowling', 
                    'reddit', 
                    'deloitte', 
                    'carletoncryptoclub',
                    'carletoncrypto',
                    'uzdarbis',
                    'bankofcanada',
                    'theamlshop',
                    'blockchainbrew', 
                    'panamacrypto',
                    'otusgroup',
                    'bittube',
                    'rbc',
                    'crypto-twice',
                ); 
            @endphp


              <div class="card mb-4">
                  <div class="card-body">
                    <h5 class="card-title font-weight-bold">Register users to competition</h5>



            <form method="post" enctype="multipart/form-data" action="/admin/competitions/register" class="form-horizontal">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group mb-3">
                                        
                                        <select class="select2 form-control mb-0" name="goals">
                                            @foreach($allowed_goals as $goal)
                                                <option value="{{$goal}}">{{$goal}}</option>
                                            @endforeach
                                        </select>
                                    
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group mb-3">
                                        
                                        <select class="select2 form-control mb-0" name="user_id">
                                            <option value="-1">User</option>
                                            @foreach($users as $id => $name)
                                                <option value="{{$id}}">{{$name}}</option>
                                            @endforeach
                                        </select>
                                    
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group mb-3">
                                    
                                        <select class="select2 form-control mb-0" name="competition_id">
                                            @foreach($competitions['competitions'] as $competition)
                                                <option value="{{$competition['id']}}">{{$competition['title']}}</option>
                                            @endforeach
                                        </select>
                                    
                                    </div>         
                                </div>  
                                <div class="col-12">                                                                                                  
                                    <div class="form-group mb-0">
                                        <div class="">
                                            <button class="btn btn-block btn-primary" type="submit">Register</button>
                                        </div>
                                    </div>
                                </div>
                            </div>                           
                        </form>


                    </div>
                    </div>
        </div>
        </div>


        @include('pages.AdminSubsystem.common.footer') 

@endsection  
  
@section('footer')

@endsection  




