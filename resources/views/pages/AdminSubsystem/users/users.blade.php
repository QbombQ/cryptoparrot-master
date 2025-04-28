@extends('pages.AdminSubsystem.layout', 
    [
    'html_class' => 'homepage', 
    'title' => 'Users - CryptoParrot',
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

        <h2 class="mb-4 font-weight-bold">Users</h2>

        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif


        <div class="row">
        <div class="col-xl-9">


         <div class="row mb-4">
                    <div class="col-xl-3">

                        <div class="card text-center h-100 d-flex">
                        <div class="card-body p-4 d-flex">
                        <div class="align-self-center w-100">
                        <h3 class="font-weight-bold mb-0"> <i class="fad mr-2 fa-users fa-1x text-primary"></i> {{ $stats['totalUsers'] }} <span class="mb-0 text-muted font-weight-normal small">Total users </span></h3>
                        </div>
                        </div>
                        </div>

                  
                    </div>
                    <div class="col-xl-3">

                        <div class="card text-center h-100 d-flex">
                        <div class="card-body p-4 d-flex">
                        <div class="align-self-center w-100">
                        <h3 class="font-weight-bold mb-0"> <i class="fad fa-user-check mr-2 text-primary"></i> {{ $stats['verifiedUsers'] }} <span class="mb-0 text-muted font-weight-normal small">Verified users </span></h3>
                        </div>
                        </div>
                        </div>


                    </div>
                    <div class="col-xl-3">

                         <div class="card text-center h-100 d-flex">
                        <div class="card-body p-4 d-flex">
                        <div class="align-self-center w-100">
                        <h3 class="font-weight-bold mb-0"> <i class="fad fa-user-unlock mr-2 text-primary"></i>{{ $stats['withAtLeastOneTrade'] }} <span class="mb-0 text-muted font-weight-normal small">With 1+ trade </span></h3>
                        </div>
                        </div>
                        </div>

    
                    </div>
                    <div class="col-xl-3">

                        <div class="card text-center h-100 d-flex">
                        <div class="card-body p-4 d-flex">
                        <div class="align-self-center w-100">
                        <h3 class="font-weight-bold mb-0"> <i class="fad fa-user-clock mr-2 text-primary"></i> {{ $stats['incompleteRegistration'] }} <span class="mb-0 text-muted font-weight-normal small">Incomplete registration</span></h3>
                        </div>
                        </div>
                        </div>


                    </div>
                </div> 

        <form method="get" action="/admin/users" class="form-horizontal mb-4">
            @csrf
            <div class="input-group">

                <?php
                    $keyword = '';
                    if(isset($_GET['keyword'])) { 
                        $keyword = $_GET['keyword'];
                    }
                ?>
                <input type="text" placeholder="Search users" name="keyword" value="{{$keyword}}" class="form-control form-control-lg">
                <div class="input-group-btn">
                    <button class="btn btn-lg btn-primary" type="submit">
                        Search
                    </button>
                </div>
            </div>

        </form>

            <div class="table-responsive">

                <table class="table table-hover">
                   
                            <tbody>
                                @if(count($users['users']) > 0)
                                    @php
                                        $iterationFirst = !Request::segment(4) ? 1 : (Request::segment(4) - 1) * config('custom.admin.itemsPerPage') + 1;
                                    @endphp
                                    @foreach($users['users'] as $user)     




                                    <tr>  
                                            <td class="project-status" style="width:50px;">
                                                <span class="td-holder"><span class="td-inner align-self-center text-center w-100">
                                                @if($user['status'] == 'confirmed')
                                                <span class="label text-success"><i class="fas fa-check"></i></span>
                                                @else
                                                <span class="label text-warning"><i class="fas fa-exclamation"></i></span>
                                                @endif
                                                </span></span>
                                               
                                            </td>
                                            <td class="project-title">
                                                <span class="td-holder"><span class="td-inner align-self-center w-100">
                                                @if($user['username'])
                                                {{$user['username']}} 
                                                @else
                                                <span class="text-danger">Username not set</span>
                                                @endif
                                                <br>
                                                <small>{{$user['email']}} | #{{$user['id']}} |  Ref: @if($user['ref_code']) {{$user['ref_code']}} @else n/a @endif </small> 
                                                </span></span>
                                            </td> 
                                            <td class="project-completion text-capitalize" style="width: 100px;">
                                                <span class="td-holder"><span class="td-inner align-self-center w-100">
                                               {{$user['date']}}  
                                               </span></span> 
                                            </td>
                                            <td class="project-people">
                                                <span class="td-holder"><span class="td-inner align-self-center w-100">
                                                {{$user['method']}} 
                                                </span></span>  
                                            </td> 
                                            <td style="width: 300px;" class="project-actions px-0">
                                                <span class="td-holder"><span class="td-inner align-self-center w-100">
                                                 <a target="_blank" href="/{{$user['slug']}}" class="btn btn-default btn-sm mr-2">View</a>
                                                <!--<a href="/admin/users/{{$user['slug']}}/check" class="btn btn-default btn-sm mr-2">Check balances</a>-->
                                                <a href="/admin/users/{{$user['slug']}}/edit" class="btn btn-primary btn-sm mr-2">Edit</a>
 
                                                <div class="dropdown d-inline-block">
                                                  <a class="btn btn-sm btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Actions
                                                  </a>
 
                                                  <div class="dropdown-menu py-2" aria-labelledby="dropdownMenuLink">
                                                    <a class="dropdown-item py-2" href="/admin/users/{{$user['id']}}/reset">Reset</a>
                                                    <a class="dropdown-item py-2 text-danger" href="/admin/users/{{$user['id']}}/delete" onClick="return confirm('Are you sure you want to delete this user?')"><i class="fas fa-trash"></i> Delete</a>

                                                    @if($user['status'] === 'banned')
                                                    <a class="dropdown-item  py-2 text-warning" href="/admin/users/{{$user['id']}}/unban"><i class="fas fa-thumbs-up"></i> Unban</a>
                                                    @else
                                                    <a class="dropdown-item py-2 text-warning" href="/admin/users/{{$user['id']}}/ban"><i class="fas fa-ban"></i> Ban</a>
                                                    @endif

                                                  </div>
                                                </div>

                                                </span></span>
                                       
                                                
                                            </td>
                                        </tr>   

                                    
                                    @endforeach
                                @else
                                    <tr><td>No users yet</td></tr>
                                @endif
                            </tbody>
                        </table>
                       


            </div>  

            @if(isset($users['pagination']))
                {!! $users['pagination'] !!}
            @endif



             <a href="/admin/users/resend-verification" class="btn btn-xs btn-primary mt-4 mb-4">Resend verification emails</a>
       

        </div>

        <div class="col-xl-3">

       
        </div>
        </div>


        @include('pages.AdminSubsystem.common.footer') 

@endsection  
  
@section('footer')

@endsection  




