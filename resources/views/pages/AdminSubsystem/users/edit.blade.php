@extends('pages.AdminSubsystem.layout', 
    [
    'html_class' => 'homepage', 
    'title' => 'Edit User - CryptoParrot',
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

        <h2 class="mb-4 font-weight-bold">Edit {{$user['username']}}</h2>


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
                <li class="breadcrumb-item">
                    <a href="/admin/users">Users</a>
                </li>                
                <li class="breadcrumb-item active">
                    <strong>{{$user['username']}}</strong>
                </li>
                
            </ol>

        
    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-lg-8">
          
                            <form method="post" action="/admin/users/edit" class="form-horizontal">
                            @csrf
                            @php
                                $username = $user['username'];
                                $email = $user['email'];
                                $statuses = config('custom.userStatuses');
                            @endphp
                            <input type="hidden" name="user_id" value="{{$user['id']}}"/>
                            <div class="form-group"><label class="control-label">Username</label>
                                <div class=""><input type="text" value="{{$username}}" name="username" class="form-control"></div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group"><label class="control-label">Email</label>
                                <div class=""><input type="text" value="{{$email}}" name="email" class="form-control"></div>
                            </div>
                            <div class="hr-line-dashed"></div>   
                            <div class="form-group"><label class="control-label">Status</label>
                                <div class="">
                                    <select class="form-control m-b select2" name="status">
                                        @foreach($statuses as $value => $label)
                                            <option @if($user['status'] == $value) selected @endif value="{{$value}}">{{$label}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>         
                            <div class="form-group">
                                <div class="">
                                    <input type="hidden" name="ghosted" value="off"/>
                                    <input type="checkbox" name="ghosted" @if($user['ghosted']) checked @endif />
                                    <label class=" control-label">Ghosted</label>
                                </div>

                            </div>                                                                           
                            <div class="form-group">
                                <div class="">
                                    <button class="btn btn-primary" type="submit">Update</button>
                                </div>
                            </div>
                            @if ($errors->any())
                                @foreach ($errors->all() as $error)
                                    <div class="alert alert-danger alert-dismissible fade show mb-0 border-top" role="alert">
                                        <i class="fa fa-exclamation-circle"></i> 
                                        {{ $error }}
                                    </div>
                                @endforeach
                            @endif                            
                        </form>                                            
                       
                  
            </div>
            <div class="col-lg-4">
                       

                       
                   
            </div>
        </div>
    </div>


        </div>
        </div>


        @include('pages.AdminSubsystem.common.footer') 

@endsection  
  
@section('footer')

@endsection  




