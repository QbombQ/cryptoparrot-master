@extends('pages.AdminSubsystem.layout', 
[
    'title' => 'Articles'
])

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Articles</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="/admin">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Articles</strong>
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
                        <h5>Articles</h5>
                        <div class="ibox-tools">
                            <a href="articles/new"><i class="fa fa-plus"></i></a>                  
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
                                <th>Status</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                                @if(count($articles['articles']) > 0)
                                    @php
                                        $iterationFirst = !Request::segment(4) ? 1 : (Request::segment(4) - 1) * config('custom.admin.itemsPerPage') + 1;
                                    @endphp
                                    @foreach($articles['articles'] as $article)   
                                        <?=print_r($article); exit;?>              
                                        <tr>
                                            <td>{{$article['id']}}</td>
                                            <td>{{$article['title']}}</td>
                                            <td>{{$article['status']}}</td>
                                            <td>{{$article['date']}}</td>
                                            <td><a href="/app/articles/{{$article['slug']}}" class="btn btn-default btn-sm">View</a><a href="/admin/articles/{{$article['id']}}/edit" class="btn btn-default btn-sm">Edit</a><a href="/admin/articles/{{$article['id']}}/delete" class="btn btn-default btn-sm">Delete</a></td>
                                        </tr> 
                                    @endforeach
                                @else
                                    <tr><td>No articles yet</td></tr>
                                @endif
                            </tbody>
                        </table>
                        @if(isset($articles['pagination']))
                            {!! $articles['pagination'] !!}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection