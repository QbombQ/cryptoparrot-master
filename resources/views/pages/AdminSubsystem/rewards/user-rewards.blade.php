@extends('pages.AdminSubsystem.layout', 
[
    'title' => 'User Rewards'
])

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>User Rewards</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="/admin">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>User Rewards</strong>
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
                        <h5>User Rewards</h5>
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
                                <th>User</th>
                                <th>Reward</th>
                                <th>Full name</th>
                                <th>Address 1</th>
                                <th>Address 2</th>
                                <th>City</th>
                                <th>State</th>
                                <th>Country</th>
                                <th>Postcode</th>
                                <th>Info</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody>
                                @if(count($userRewards['userRewards']) > 0)
                                    @php
                                        $iterationFirst = !Request::segment(4) ? 1 : (Request::segment(4) - 1) * 10 + 1;
                                    @endphp
                                    @foreach($userRewards['userRewards'] as $reward)
                                        <tr>
                                            <td class="align-middle">{{$iterationFirst++}}</td>
                                            <td class="align-middle"><a href="/{{$reward['handle']}}">{{$reward['user']}}</a> ( {{$reward['email'] }} )</td>
                                            <td class="align-middle">{{$reward['reward']}}</td>
                                            <td class="align-middle">{{$reward['full_name']}}</td>
                                            <td class="align-middle">{{$reward['address_line_1']}}</td>
                                            <td class="align-middle">{{$reward['address_line_2']}}</td>
                                            <td class="align-middle">{{$reward['city']}}</td>
                                            <td class="align-middle">{{$reward['state']}}</td>
                                            <td class="align-middle">{{$reward['country']}}</td>
                                            <td class="align-middle">{{$reward['postcode']}}</td>
                                            <td class="align-middle">{{$reward['additional_info']}}</td>
                                            <td class="align-middle">
                                                <form class="change-order-status" method="post" action="/admin/user-rewards/update">
                                                    <input type="hidden" name="reward_id" value="{{$reward['id']}}"/>
                                                    <select name="status" style="display: inline-block; width: 80%; margin-right: 5px;" class="form-control order-status-select">
                                                        <option @if($reward['status'] == 'completed') selected @endif value="completed">Completed</option>
                                                        <option @if($reward['status'] == 'cancelled') selected @endif value="cancelled">Cancelled</option>
                                                        <option @if($reward['status'] == 'processing') selected @endif value="processing">Processing</option>
                                                    </select> <i class="fa fa-2x fa-check-circle" style="vertical-align: sub; display: inline-block" aria-hidden="true"></i>
                                                </form>    
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr><td>No User Rewards yet</td></tr>
                                @endif
                            </tbody>
                        </table>
                        @if(isset($userRewards['pagination']))
                            {!! $userRewards['pagination'] !!}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection