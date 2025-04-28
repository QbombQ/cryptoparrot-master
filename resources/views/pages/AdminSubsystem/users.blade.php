@extends('pages.AdminSubsystem.layout', 
[
    'title' => 'Users'
])

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Users</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="/admin">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Users</strong>
                </li>
                
            </ol>
        </div>
        <div class="col-lg-2">

        </div>
    </div>
    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-lg-12">
                @if (session('message'))
                    <div class="alert alert-success mb-0">
                        {{ session('message') }}
                    </div>
                @endif                
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Users</h5>
                        <div class="ibox-tools">                 
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                             
                        </div>
                    </div>
                    <div class="ibox-content">

                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Date registered</th>
                                <th>Status</th>
                                <th>Method</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                                @if(count($users['users']) > 0)
                                    @php
                                        $iterationFirst = !Request::segment(4) ? 1 : (Request::segment(4) - 1) * config('custom.admin.itemsPerPage') + 1;
                                    @endphp
                                    @foreach($users['users'] as $user)                 
                                        <tr>
                                            <td>{{$iterationFirst++}}</td>
                                            <td>{{$user['username']}}</td>
                                            <td>{{$user['email']}}</td>
                                            <td>{{$user['date']}}</td>
                                            <td>{{$user['status']}}</td>
                                            <td>{{$user['method']}}</td>
                                            <td><a href="/{{$user['slug']}}" class="btn btn-default btn-sm">View</a><a href="/admin/users/{{$user['id']}}/edit" class="btn btn-default btn-sm">Edit</a><a href="/admin/users/{{$user['id']}}/delete" class="btn btn-default btn-sm">Delete</a></td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr><td>No users yet</td></tr>
                                @endif
                            </tbody>
                        </table>
                        @if(isset($users['pagination']))
                            {!! $users['pagination'] !!}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection