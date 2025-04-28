@extends('pages.AdminSubsystem.layout', 
    [
    'html_class' => 'homepage', 
    'title' => 'New Article - CryptoParrot',
    ]
)


  
@section('styles')
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" integrity="sha512-xmGTNt20S0t62wHLmQec2DauG9T+owP9e6VU8GigI0anN7OXLip9i7IwEhelasml2osdxX71XcYm6BQunTQeQg==" crossorigin="anonymous" />
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

        <h2 class="mb-4 font-weight-bold">New Article</h2>


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
                    <a href="/admin/articles">Articles</a>
                </li>                
                <li class="breadcrumb-item active">
                    <strong>New</strong>
                </li>
                
            </ol>

        
       <form method="post" enctype="multipart/form-data" action="" class="form-horizontal">
    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-lg-8">
          
                            @csrf
                        
                            <label class="control-label">Title</label>
                            <input id="article-title"  type="text" value="{{ old('title') }}" name="title" placeholder="Title" class="form-control">
                       

                            <label class="control-label mt-3">Slug</label>
                            <input id="article-slug" type="text" value="{{ old('slug') }}" name="slug" placeholder="Slug" class="form-control">

                            <label class="control-label mt-3">Url</label>
                            <input  type="text"  value="{{ old('url') }}" name="url" placeholder="External URL (optional)" class="form-control">

                 
                            <div class="hr-line-dashed"></div>                                                   
                            <div class="form-group">
                                <label class="control-label mt-3">Excerpt</label>
                                <textarea class="form-control" value="{{ old('excerpt') }}" name="excerpt">{{ old('excerpt') }}</textarea> 
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="control-label">Content</label>
                                <textarea class="form-control" value="{{ old('content') }}" name="content">{{ old('content') }}</textarea>
                            </div>


                        
                  
            </div>
            <div class="col-lg-4">
                           


                 <div class="card mb-4">
                  <div class="card-body">
                    <h5 class="card-title font-weight-bold">Thumbnail</h5>
                    <div>
                         

                         <div class="input-group">
                  
                              <div class="custom-file">
                                <input type="file" class="custom-file-input" id="thumbnail" aria-describedby="thumbnail" accept="image/*" name="thumbnail"/>
                                <label class="custom-file-label" for="thumbnail">Choose file</label>
                              </div>
                            </div>

                    </div>
                  </div>
                </div>

               
                <div class="ibox float-e-margins">
                    <h5 class="card-title font-weight-bold">SEO</h5>
                    <div class="ibox-content">

                        <div class="form-group">
                            <label class="control-label">Meta title</label>
                            <input id="article-title" type="text" value="{{ old('meta_title') }}" name="meta_title" class="form-control">
                        </div>               
                        <div class="form-group">
                            <label class="control-label">Meta description</label>
                            <textarea class="form-control" name="meta_description">{{ old('meta_description') }}</textarea>
                        </div>                            
                     
                    </div>
                </div>
         

                <div class="ibox float-e-margins">
                    <h5 class="card-title font-weight-bold">Publish</h5>
                    <div class="ibox-content">


                    <div class="form-group">
                        <label class="control-label">Categories (1 or more)</label>
                        <div class="">

                            <select class="select2 form-control m-b" multiple name="category[]">
                                @foreach($categories as $category)
                                    <option {{ (collect(old('category'))->contains($category['value'])) ? 'selected':'' }} value="{{$category['value']}}">{{$category['label']}}</option>
                                @endforeach 
                            </select>
                        </div>
                    </div> 

                    <div class="form-group">
                        <input type="text" value="{{ old('tags') }}" placeholder="Tags (comma seperated list)" name="tags" class="form-control tagsinput w-100">
                    </div> 

                    <div class="form-group">
                        <label class="control-label">Author (user id)</label>
                        <input class="form-control" value="{{ old('author') }}" name="author">
                    </div>    

                    <div class="form-group">
                        <label class="control-label">Status</label>
                        <select class="form-control m-b select2" name="status">
                            <option value="published" selected>Published</option>
                            <option value="draft">Draft</option>
                        </select>
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




