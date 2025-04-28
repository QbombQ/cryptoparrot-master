@extends('pages.AdminSubsystem.layout', 
[
    'title' => 'Edit Earn Play Dollar'
])

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Earn Play Dollars</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="/admin">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="/admin/earnPlayDollars">Earn Play Dollars</a>
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
                        <h5>Edit Earn Play Dollar</h5>
                        <div class="ibox-tools">             
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                            @php
                                $title = old('title') ? old('title') : $earnPlayDollar['title'];
                                $description = old('description') ? old('description') : $earnPlayDollar['description'];
                                $quantity = old('quantity') ? old('quantity') : $earnPlayDollar['quantity'];
                                $price = old('price') ? old('price') : $earnPlayDollar['price'];
                            @endphp
                            @csrf
                            <input type="hidden" name="earnPlayDollar_id" value="{{$earnPlayDollar['id']}}">

                            <div class="input-group m-b">
                                <div class="input-group-prepend">
                                    <span class="input-group-addon">Title</span>
                                </div>
                                <input id="earnPlayDollar-title"  type="text" value="{{ $title }}" name="title" placeholder="Title" class="form-control">
                            </div>


                            <div class="hr-line-dashed"></div>                                                         
                            <div class="form-group"><label class="control-label">Description</label>
                                <textarea class="form-control" name="description">{{ $description }}</textarea>
                            </div>        

                            <div class="input-group m-b">
                                <div class="input-group-prepend">
                                    <span class="input-group-addon">Quantity</span>
                                </div>
                                <input type="number" value="{{ $quantity }}" name="quantity" placeholder="Quantity" class="form-control">
                            </div>

                            <div class="input-group m-b">
                                <div class="input-group-prepend">
                                    <span class="input-group-addon">Price</span>
                                </div>
                                <input type="number" value="{{ $price }}" name="price" placeholder="Price" class="form-control">
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
                        @if($earnPlayDollar['image'])
                            <img class="mw-100" alt="thumbnail" src="{{$earnPlayDollar['image']}}"/>
                        @endif
                        <div class="form-group mb-0"><label class="col-sm-2 control-label">Thumbnail</label>
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