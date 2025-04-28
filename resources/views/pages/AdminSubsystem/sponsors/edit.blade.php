@extends('pages.AdminSubsystem.layout', 
[
    'title' => 'Edit Sponsor'
])

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Sponsors</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="/admin">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="/admin/sponsors">Sponsors</a>
                </li>                
                <li class="breadcrumb-item active">
                    <strong>Edit</strong>
                </li>
                
            </ol>
        </div>
        <div class="col-lg-2">

        </div>
    </div>

    <form method="post" enctype="multipart/form-data" action="" class="form-horizontal">
    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-lg-8">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Edit Sponsor</h5>
                        <div class="ibox-tools">             
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                            @php
                                $title = old('title') ? old('title') : $sponsor['title'];
                                $url = old('url') ? old('url') : $sponsor['url'];
                            @endphp
                            @csrf
                            <input type="hidden" name="sponsor_id" value="{{$sponsor['id']}}">

                            <div class="input-group m-b">
                                <div class="input-group-prepend">
                                    <span class="input-group-addon">Title</span>
                                </div>
                                <input id="sponsor-title"  type="text" value="{{ $title }}" name="title" placeholder="Title" class="form-control">
                            </div>

                            <div class="input-group m-b">
                                <div class="input-group-prepend">
                                    <span class="input-group-addon">URL</span>
                                </div>
                                <input id="sponsor-title"  type="text" value="{{ $url }}" name="url" placeholder="URL" class="form-control">
                            </div>

                    </div>
                </div>
            </div>
            <div class="col-lg-4">

                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        Logo
                        <div class="ibox-tools">             
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        @if($sponsor['logo'])
                            <img class="mw-100" alt="thumbnail" src="{{$sponsor['logo']}}"/>
                        @endif
                        <div class="form-group mb-0"><label class="col-sm-2 control-label">Logo</label>
                            <input type="file" class="form-control" accept="image/*" name="logo"/>
                        </div>
                    </div>
                </div>
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        Publish
                        <div class="ibox-tools">             
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">

                    <div class="hr-line-dashed"></div>                                                                     
        
                    
                    <button class="btn btn-lg btn-block btn-primary" type="submit">Update</button>
                        
                
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger alert-dismissible fade show mb-0 border-top" role="alert">
                                <i class="fa fa-exclamation-circle"></i> 
                                {{ $error }}
                            </div>
                        @endforeach
                    @endif  

                    </div>
                </div>
        </div>
    </div>
    </form>
@endsection