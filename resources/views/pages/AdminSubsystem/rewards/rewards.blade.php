@extends('pages.AdminSubsystem.layout', 
[
    'title' => 'Rewards'
])

@section('content')


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
                        <h5>Rewards</h5>
                        <div class="ibox-tools">

                            <a href="/admin/rewards/new" class="btn btn-xs btn-primary"><i class="fa fa-plus"></i> Add Reward</a>

                                      <a href="/admin/user-rewards" class="btn btn-primary btn-xs">User orders</a>

                          
 
                           
                             
                        </div>
                    </div>
                    <div class="ibox-content">

                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                                @if(count($rewards['rewards']) > 0)
                                    @php
                                        $iterationFirst = !Request::segment(4) ? 1 : (Request::segment(4) - 1) * 10 + 1;
                                    @endphp
                                    @foreach($rewards['rewards'] as $reward)
                                        <tr>
                                            <td class="align-middle">{{$iterationFirst++}}</td>
                                            <td class="align-middle">{{$reward['title']}}</td>
                                            <td class="align-middle">{{$reward['quantity']}}</td>
                                            <td class="align-middle">{{$reward['price']}}</td>
                                            <td class="align-middle"><a href="/admin/rewards/{{$reward['id']}}/edit" class="btn btn-default btn-sm mr-2">Edit</a><a href="/admin/rewards/{{$reward['id']}}/delete" class="btn btn-danger btn-sm" onClick="return confirm('Are you sure you want to delete reward?')">Delete</a></td>  
                                        </tr>
                                    @endforeach
                                @else
                                    <tr><td>No rewards yet</td></tr>
                                @endif
                            </tbody>
                        </table>
                        @if(isset($rewards['pagination']))
                            {!! $rewards['pagination'] !!}
                        @endif

              
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection