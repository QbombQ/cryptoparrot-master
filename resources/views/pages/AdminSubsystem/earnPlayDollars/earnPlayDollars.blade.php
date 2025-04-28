@extends('pages.AdminSubsystem.layout', 
[
    'title' => 'Earn Play Dollars'
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
                        <h5>Earn Play Dollars</h5>
                        <div class="ibox-tools">
                            <a href="/admin/earnPlayDollars/new"><i class="fa fa-plus"></i></a>                  
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
                                <th>Title</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                                @if(count($earnPlayDollars['earnPlayDollars']) > 0)
                                    @php
                                        $iterationFirst = !Request::segment(4) ? 1 : (Request::segment(4) - 1) * 10 + 1;
                                    @endphp
                                    @foreach($earnPlayDollars['earnPlayDollars'] as $earnPlayDollar)
                                        <tr>
                                            <td class="align-middle">{{$iterationFirst++}}</td>
                                            <td class="align-middle">{{$earnPlayDollar['title']}}</td>
                                            <td class="align-middle">{{$earnPlayDollar['quantity']}}</td>
                                            <td class="align-middle">{{$earnPlayDollar['price']}}</td>
                                            <td class="align-middle"><a href="/admin/earnPlayDollars/{{$earnPlayDollar['id']}}/edit" class="btn btn-default btn-sm mr-2">Edit</a><a href="/admin/earnPlayDollars/{{$earnPlayDollar['id']}}/delete" class="btn btn-danger btn-sm" onClick="return confirm('Are you sure you want to delete earnPlayDollar?')">Delete</a></td>  
                                        </tr>
                                    @endforeach
                                @else
                                    <tr><td>No earnPlayDollars yet</td></tr>
                                @endif
                            </tbody>
                        </table>
                        @if(isset($earnPlayDollars['pagination']))
                            {!! $earnPlayDollars['pagination'] !!}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection