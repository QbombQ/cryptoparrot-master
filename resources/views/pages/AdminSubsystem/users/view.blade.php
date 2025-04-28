@extends('pages.AdminSubsystem.layout', 
[
    'title' => 'User view'
])

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Users</h2>
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
        </div>
        <div class="col-lg-2">

        </div>
    </div>
    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>View {{$user['username']}}</h5>
                        <div class="ibox-tools">             
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <h3>Transactions</h3>
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Amount</th>
                                <th>Available on</th>
                                <th>Created</th>
                                <th>Currency</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Type</th>
                            </tr>
                            </thead>
                            <tbody>
                                @if(count($user['transactions']) > 0)
                                    @foreach($user['transactions'] as $transaction)                  
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$transaction['amount']}}</td>
                                            <td>{{$transaction['available_on']}}</td>
                                            <td>{{$transaction['created']}}</td>
                                            <td>{{$transaction['currency']}}</td>
                                            <td>{{$transaction['description']}}</td>
                                            <td>{{$transaction['status']}}</td>
                                            <td>{{$transaction['type']}}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr><td>No transactions yet</td></tr>
                                @endif
                            </tbody>
                        </table>       
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection