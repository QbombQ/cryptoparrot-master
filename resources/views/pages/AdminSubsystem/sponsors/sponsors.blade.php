@extends('pages.AdminSubsystem.layout', 
[
    'title' => 'Sponsors'
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
                        <h5>Sponsors</h5>
                        <div class="ibox-tools">
                                         
                              <a href="/admin/sponsors/new" class="btn btn-xs btn-primary"><i class="fa fa-plus"></i> Add Sponsor</a>
                             
                        </div>
                    </div>
                    <div class="ibox-content">

                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Url</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                                @if(count($sponsors['sponsors']) > 0)
                                    @php
                                        $iterationFirst = !Request::segment(4) ? 1 : (Request::segment(4) - 1) * 10 + 1;
                                    @endphp
                                    @foreach($sponsors['sponsors'] as $sponsor)
                                        <tr>
                                            <td class="align-middle">{{$iterationFirst++}}</td>
                                            <td class="align-middle">{{$sponsor['title']}}</td>
                                            <td class="align-middle">{{$sponsor['url']}}</td>
                                            <td class="align-middle"><a href="/admin/sponsors/{{$sponsor['id']}}/edit" class="btn btn-default btn-sm mr-2">Edit</a><a href="/admin/sponsors/{{$sponsor['id']}}/delete" class="btn btn-danger btn-sm" onClick="return confirm('Are you sure you want to delete sponsor?')">Delete</a></td>  
                                        </tr>
                                    @endforeach
                                @else
                                    <tr><td>No sponsors yet</td></tr>
                                @endif
                            </tbody>
                        </table>
                        @if(isset($sponsors['pagination']))
                            {!! $sponsors['pagination'] !!}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection