@extends('pages.AdminSubsystem.layout', 
[
    'title' => 'New Reward'
])

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Rewards</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="/admin">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="/admin/rewards">Rewards</a>
                </li>                
                <li class="breadcrumb-item active">
                    <strong>New</strong>
                </li>
                
            </ol>
        </div>
        <div class="col-lg-2">

        </div>
    </div>

    <form method="post" enctype="multipart/form-data" action="" class="form-horizontal">
    <div class="wrapper wrapper-content">

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show mb-3 border-top" role="alert">
            @foreach ($errors->all() as $error)
               
                    <div><i class="fa fa-exclamation-circle"></i> 
                    {{ $error }}</div>
               
            @endforeach
            </div>
        @endif 

        <div class="row">
            <div class="col-lg-8">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>New Reward</h5>
                        <div class="ibox-tools">             
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                            @csrf
                        
                            <div class="input-group m-b">
                                <div class="input-group-prepend">
                                    <span class="input-group-addon">Title</span>
                                </div>
                                <input id="reward-title"  type="text" value="{{ old('title') }}" name="title" placeholder="Title" class="form-control">
                            </div>

                            <div class="hr-line-dashed"></div>     
                            <div class="input-group m-b">
                                <div class="input-group-prepend">
                                    <span class="input-group-addon">URL</span>
                                </div>
                                <input id="reward-title"  type="text" value="{{ old('url') }}" name="url" placeholder="URL" class="form-control">
                            </div>

                            <div class="hr-line-dashed"></div>                                                     
                            <div class="form-group">
                                <label class="control-label">Description</label>
                                <textarea class="form-control" value="{{ old('description') }}" name="description">{{ old('description') }}</textarea> 
                            </div>

                            <div class="hr-line-dashed"></div>                                                     
                            <div class="form-group">
                                <label class="control-label">Additional info</label>
                                <textarea class="form-control" value="{{ old('info') }}" name="info">{{ old('info') }}</textarea> 
                            </div>

                            <div class="input-group m-b">
                                <div class="input-group-prepend">
                                    <span class="input-group-addon">Quantity</span>
                                </div>
                                <input type="number" value="{{ old('quantity') }}" name="quantity" placeholder="Quantity" class="form-control">
                            </div>

                            <div class="input-group m-b">
                                <div class="input-group-prepend">
                                    <span class="input-group-addon">Price</span>
                                </div>
                                <input type="number" value="{{ old('price') }}" name="price" placeholder="Price" class="form-control">
                            </div>

                    </div>
                </div>
            </div>
            <div class="col-lg-4">

                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        Thumbnail
                        <div class="ibox-tools">             
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="form-group mb-0">
                            <input type="file" class="form-control" accept="image/*" name="image"/>
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


                    <div class="form-group">
                        <label class="control-label">Sponsor</label>
                        <div class="">

                            <select class="select2 form-control m-b" name="sponsor">
                                <option value=""></option>
                                @foreach($sponsors as $key => $value)
                                    <option value="{{$key}}">{{$value}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div> 

                    <div class="hr-line-dashed"></div>                                                                      
        
                    
                    <button class="btn btn-lg btn-block btn-primary" type="submit">Create</button>
                        
                 
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show mb-0 border-top" role="alert">
                        @foreach ($errors->all() as $error)
                           
                                <div><i class="fa fa-exclamation-circle"></i> 
                                {{ $error }}</div>
                           
                        @endforeach
                        </div>
                    @endif  

                    </div>
                </div>
        </div>
        </div>
    </div>
    </form>

@endsection