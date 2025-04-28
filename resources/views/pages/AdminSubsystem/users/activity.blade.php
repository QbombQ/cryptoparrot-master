@extends('pages.AdminSubsystem.layout', 
[
    'title' => $heading
])

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>{{$heading}}</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="/admin">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>{{$heading}}</strong>
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
                        <h5>{{$heading}}</h5>
                        <div class="ibox-tools">                 
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                             
                        </div>
                    </div>
                    <div class="ibox-content">

                        <table class="table table-hover table-striped">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Username</th>
                                <th>Last online</th>
                            </tr>
                            </thead>
                            <tbody>
                                @if(count($usersActivity) > 0)
                                    @php
                                        $iterationFirst = 1;
                                    @endphp
                                    @foreach($usersActivity as $activity)                 
                                        <tr> 
                                            <td class="align-middle">{{$iterationFirst++}}</td>
                                            <td class="align-middle">{{$activity['username']}}</td>
                                            <td class="align-middle">{{$activity['activeAt']}}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr><td>No users activity yet</td></tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection