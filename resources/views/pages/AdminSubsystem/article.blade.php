@extends('pages.AdminSubsystem.layout', 
[
    'title' => 'New Article'
])

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Articles</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="/admin">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="/admin/articles">Articles</a>
                </li>                
                <li class="breadcrumb-item active">
                    <strong>New</strong>
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
                        <h5>New Article</h5>
                        <div class="ibox-tools">             
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <form method="post" enctype="multipart/form-data" action="" class="form-horizontal">
                            @csrf
                            <div class="form-group"><label class="col-sm-2 control-label">Title</label>
                                <div class="col-sm-10"><input type="text" value="{{ old('title') }}" name="title" class="form-control"></div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group"><label class="col-sm-2 control-label">Excerpt</label>
                                <textarea class="form-control" value="{{ old('excerpt') }}" name="excerpt">{{ old('excerpt') }}</textarea>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group"><label class="col-sm-2 control-label">Content</label>
                                <textarea class="form-control" value="{{ old('content') }}" name="content">{{ old('content') }}</textarea>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group"><label class="col-sm-2 control-label">Thumbnail</label>
                                <input type="file" class="form-control" accept="image/*" name="thumbnail"/>
                            </div>
                            <div class="hr-line-dashed"></div>                            
                            <div class="form-group">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <button class="btn btn-primary" type="submit">Create</button>
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
                </div>
            </div>
        </div>
    </div>
@endsection