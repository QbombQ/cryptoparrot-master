@extends('pages.AdminSubsystem.layout', 
    [
    'html_class' => 'homepage', 
    'title' => 'Trades - CryptoParrot',
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

        <h2 class="mb-4 font-weight-bold">Trades</h2>

        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif


        <div class="row">
        <div class="col-xl-9">

        <form method="get" action="/admin/trades" class="form-horizontal">
                            @csrf
                            <div class="row"> 
                                <div class="col-3">
                                    <div class="form-group mb-3">
                                        <?php
                                            $visibility = -1;
                                            if(isset($_GET['visibility'])) {
                                                $visibility = $_GET['visibility'];
                                            }
                                        ?>
                                        <select class="select2 form-control mb-3" name="visibility">
                                            <option>Visibility</option>
                                            <option @if($visibility == 2) selected @endif value="2">All</option>
                                            <option @if($visibility == 1) selected @endif value="1">Public</option>
                                            <option @if($visibility == 0) selected @endif value="0">Private</option>
                                        </select>
                                    </div>
                                </div>                  
                                <div class="col-3">
                                    
                                    <div class="form-group mb-3">
                                        <?php
                                            $description = -1;
                                            if(isset($_GET['description'])) {
                                                $description = $_GET['description'];
                                            }
                                        ?>
                                        <select class="select2 form-control mb-3" name="description">
                                            <option>Description</option>
                                            <option @if($description == 2) selected @endif value="2">All</option>
                                            <option @if($description == 1) selected @endif value="1">With</option>
                                            <option @if($description == 0) selected @endif value="0">Without</option>
                                        </select>
                                    </div>
                                </div>  
                                <div class="col-3">
                                    
                                    <div class="form-group mb-3">
                                        <?php
                                            $usersId = -1;
                                            if(isset($_GET['users'])) {
                                                $usersId = $_GET['users'];
                                            }
                                        ?>
                                        <select class="select2 form-control mb-3" name="users">
                                            <option>Users</option>
                                            <option value="0">All</option>
                                            @foreach($users as $id => $username)
                                                <option @if($usersId == $id) selected @endif value="{{$id}}">{{$username}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>                                                                                                            
                                <div class="col-3">                                                                                                  
                                    <div class="form-group mb-0">
                                        <div class="">
                                            <button class="btn btn-block btn-primary" type="submit">Filter</button>
                                        </div>
                                    </div>
                                </div>
                            </div>                           
                        </form>
 
            <div class="table-responsive">

                <table class="table table-hover table-striped">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Author</th>
                        <th>Pair</th>
                        <th>Type</th>
                        <th>Comments</th>
                        <th>Public</th>
                        <th>Follow</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                        @if(count($trades['data']) > 0)
                            @php
                                $iterationFirst = !Request::segment(4) ? 1 : (Request::segment(4) - 1) * config('custom.admin.itemsPerPage') + 1;
                            @endphp
                            @foreach($trades['data'] as $trade)                 
                                <tr>
                                    <td class="align-middle"><span class="td-holder"><span class="td-inner align-self-center w-100">{{$iterationFirst++}}</span></span></td>
                                    <td class="align-middle"><span class="td-holder"><span class="td-inner align-self-center w-100"><a target="_blank" href="/{{$trade['authorHandle']}}">{{$trade['authorUsername']}}</a></span></span></td>
                                    <td class="align-middle"><span class="td-holder"><span class="td-inner align-self-center w-100">{{$trade['pair']}}</span></span></td>
                                    <td class="align-middle"><span class="td-holder"><span class="td-inner align-self-center w-100">{{$trade['type']}}</span></span></td>
                                    <td class="align-middle"><span class="td-holder"><span class="td-inner align-self-center w-100">{{$trade['commentsCount']}}</span></span></td>
                                    <td class="align-middle"><span class="td-holder"><span class="td-inner align-self-center w-100">{!!$trade['public']!!}</span></span></td>
                                    <td class="align-middle"><span class="td-holder"><span class="td-inner align-self-center w-100">{!!$trade['follow']!!}</span></span></td>
                                    <td class="align-middle"><span class="td-holder"><span class="td-inner align-self-center w-100">{{$trade['date']}}</span></span></td>
                                    <td class="align-middle"><span class="td-holder"><span class="td-inner align-self-center w-100"><a target="_blank" href="/{{$trade['authorHandle']}}/trade/{{$trade['id']}}" class="btn btn-default mr-2 btn-sm">View</a><a href="/admin/trades/{{$trade['id']}}/edit" class="btn btn-primary btn-sm">Edit</a></span></span></td>
                                </tr>
                            @endforeach
                        @else
                            <tr><td>No trades yet</td></tr>
                        @endif
                    </tbody>
                </table>


            </div>  

            @if(isset($trades['pagination']))
                {!! $trades['pagination'] !!}
            @endif


            <a href="/admin/trades/sitemap" class="btn btn-primary mt-4 mb-4">Generate trades sitemap</a>
          
       

        </div>

        <div class="col-xl-3">

       
        </div>
        </div>


        @include('pages.AdminSubsystem.common.footer') 

@endsection  
  
@section('footer')

@endsection  




