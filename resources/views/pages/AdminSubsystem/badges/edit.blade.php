@extends('pages.AdminSubsystem.layout', 
[
    'title' => 'Edit Badge'
])

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Badges</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="/admin">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="/admin/badges">Badges</a>
                </li>                
                <li class="breadcrumb-item active">
                    <strong>Edit</strong>
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
                        <h5>Edit Badge</h5>
                        <div class="ibox-tools">             
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <form method="post" enctype="multipart/form-data" action="" class="form-horizontal">
                        @php
                                $title = old('title') ? old('title') : $badge['title'];
                                $description = old('description') ? old('description') : $badge['description'];
                                $icon = old('icon') ? old('icon') : $badge['icon'];
                            @endphp                        
                            @csrf 
                            <input type="hidden" name="badge_id" value="{{$badge['id']}}">
                            <div class="form-group"><label class="col-sm-2 control-label">Title</label>
                                <div class="col-sm-10"><input id="badge-title" type="text" value="{{$title}}" name="title" class="form-control"></div>
                            </div>        
                            <div class="form-group"><label class="col-sm-2 control-label">Description</label>
                                <div class="col-sm-10"><textarea class="form-control" name="description">{{ $description }}</textarea></div>
                            </div>
                            <div class="form-group"><label class="col-sm-2 control-label">Icon</label>
                                <div class="col-sm-10"><input id="badge-icon" type="text" value="{{$icon}}" name="icon" class="form-control"></div>
                            </div>
                            <div class="hr-line-dashed"></div>   
                            <div class="form-group"><label class="col-sm-2 control-label">Is branded</label>
                                <input type="hidden" name="is_branded" value="off">
                                <input type="checkbox" @if($badge['is_branded'] == 1) checked @endif name="is_branded"/>
                            </div>
                            <div class="hr-line-dashed"></div>                                                                                              
                            <div class="form-group">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <button class="btn btn-primary" type="submit">Update</button>
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