@extends('pages.AdminSubsystem.layout', 
[
    'title' => 'New Category'
])

@section('styles')
@endsection


@section('content')

  @include('pages.AdminSubsystem.common.header') 

    <div class="row">

          @if(Session::has('alert'))
          <div class="col-xl-12 pb-2 mt-4">
              <div class="alert alert-warning">{!! session('alert') !!}</div>
          </div>
          @endif

    
        </div>

        <h2 class="mb-4 font-weight-bold">Create Category</h2>


        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif


        <div class="row">
        <div class="col-xl-9">


        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="/admin">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                <a href="/admin/categories/">Categories</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>New</strong>
            </li>
            
        </ol>


        <form method="post" enctype="multipart/form-data" action="" class="form-horizontal">


            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show mb-3 border-top" role="alert">
                @foreach ($errors->all() as $error)
                   
                        <div><i class="fa fa-exclamation-circle"></i> 
                        {{ $error }}</div>
                   
                @endforeach
                </div>
            @endif 

                                @csrf
                            

                                <div class="form-group">
                                <label class="control-label">Title</label>
                                <div class="">
                                    <input id="article-title"  type="text" value="{{ old('title') }}" name="title" placeholder="Title" class="form-control">
                                </div>
                                </div>


                                <div class="form-group">
                                <label class="control-label">Slug</label>
                                <div class="">
                                     <input id="article-slug" type="text" value="{{ old('slug') }}" name="slug" placeholder="Slug" class="form-control">
                                </div>
                                </div>


                                <div class="form-group">
                                <label class="control-label">Meta Title</label>
                                <div class="">
                                     <input type="text" value="{{ old('meta_title') }}" name="meta_title" placeholder="Meta Title" class="form-control">
                                </div>
                                </div>

                                <div class="form-group">
                                <label class="control-label">Meta Description</label>
                                <div class="">
                                     <input type="text" value="{{ old('meta_description') }}" name="meta_description" placeholder="Meta Description" class="form-control">
                                </div>
                                </div>

                    
                                <button class="btn btn-lg btn-block btn-primary mt-4" type="submit">Create</button>
                          
                 

        </form>


        </div>

        </div>



        @include('pages.AdminSubsystem.common.footer') 


@endsection

@section('footer')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>

<script>
        $(document).ready(function() {

            $('.tagsinput').tagsinput({
                tagClass: 'label label-primary'
            });
        
        });
</script>
@endsection
