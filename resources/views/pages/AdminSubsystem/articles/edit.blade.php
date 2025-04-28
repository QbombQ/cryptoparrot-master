@extends('pages.AdminSubsystem.layout', 
    [
    'html_class' => 'homepage', 
    'title' => 'Edit Article - CryptoParrot',
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

        <h2 class="mb-4 font-weight-bold">Edit Article</h2>


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
                    <strong>Edit</strong>
                </li>
                
            </ol>

        
       <form method="post" enctype="multipart/form-data" action="" class="form-horizontal">
    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-lg-8">
          
                             @php
                                $title = old('title') ? old('title') : $article['title'];
                                $slug = old('slug') ? old('slug') : $article['slug'];
                                $status = old('status') ? old('status') : $article['status'];
                                $author = old('author') ? old('author') : $article['author'];
                                $excerpt = old('excerpt') ? old('excerpt') : $article['excerpt'];
                                $content = old('content') ? old('content') : $article['content'];
                                $tags = old('tags') ? old('tags') : $article['tags'];
                                $metaTitle = old('meta_title') ? old('meta_title') : $article['meta_title'];
                                $url = old('url') ? old('url') : $article['url'];
                                $metaDescription = old('meta_description') ? old('meta_description') : $article['meta_description'];
                                $createdAt = old('created_at') ? old('created_at') : $article['created_at'];
                            @endphp
                            @csrf
                        
                            
                            <input type="hidden" name="article_id" value="{{$article['id']}}">

                            <label class="control-label">Title</label>
                            <input id="article-title"  type="text" value="{{ $title }}" name="title" placeholder="Title" class="form-control">

                            @if(!$url)
                                <label class="control-label mt-3">Slug</label>
                                <input id="article-slug" type="text" value="{{ $slug }}" name="slug" placeholder="Slug" class="form-control">
                            @else
                                <input type="hidden" value="{{ $slug }}" name="slug">
                            @endif 

                            <label class="control-label mt-3">Url</label>
                            <input  type="text"  value="{{ $url }}" name="url" placeholder="External URL (optional)" class="form-control">

                                                            
                            <div class="form-group mt-3"><label class="control-label">Excerpt</label>
                                <textarea class="form-control" name="excerpt">{{ $excerpt }}</textarea>
                            </div> 

                            <div class="" id="editorjs"></div>


                            <div class="hr-line-dashed"></div>
                            <div class="form-group"><label class="control-label">Content</label>
                                <textarea class="form-control" name="content">{{ $content }}</textarea>
                            </div>     


                        
                  
            </div>
            <div class="col-lg-4">
                           
          

                <div class="card mb-4">
                  <div class="card-body">
                    <h5 class="card-title font-weight-bold">Thumbnail</h5>
                    <div>
                         

                        @if($article['thumbnail'])
                            <img class="mw-100" alt="thumbnail" src="{{$article['thumbnail']}}"/>
                        @endif

                         <div class="input-group">
                    
                              <div class="custom-file">
                                <input type="file" class="custom-file-input" id="thumbnail" aria-describedby="thumbnail" accept="image/*" name="thumbnail"/>
                                <label class="custom-file-label" for="thumbnail">Choose file</label>
                              </div>
                            </div>

                    </div>
                  </div>
                </div>


                @if(!$url)
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5 class="card-title font-weight-bold">SEO</h5>
                     
                    </div>
                    <div class="ibox-content">

                        <div class="form-group">
                            <label class="control-label">Meta title</label>
                            <input id="article-title" type="text" value="{{ $metaTitle }}" name="meta_title" class="form-control">
                        </div>               
                        <div class="form-group">
                            <label class="control-label">Meta description</label>
                            <textarea class="form-control" name="meta_description">{{ $metaDescription }}</textarea>
                        </div>                            
                     
                    </div>
                </div>
                @else
                    <input type="hidden" value="{{ $metaTitle }}" name="meta_title">
                    <input type="hidden" value="{{ $metaTitle }}" name="meta_description">
                @endif

                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5 class="card-title font-weight-bold">Publish</h5>
           
                    </div>
                    <div class="ibox-content">


                    <div class="form-group">
                        <label class="control-label">Categories (1 or more)</label>
                        <div class="">
                            <select class="select2 form-control m-b" multiple name="category[]">
                                @foreach($categories as $category)
                                    <option @if(in_array($category['value'], $article['categories'])) selected @endif value="{{$category['value']}}">{{$category['label']}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div> 

                    <div class="form-group">
                        <input type="text" value="{{ $tags }}" placeholder="Tags (comma seperated list)" name="tags" class="form-control tagsinput w-100">
                    </div> 

                    <div class="form-group">
                        <label class="control-label">Author (user id)</label>
                        <input class="form-control" value="{{$author}}" name="author">
                    </div>  

                    <div class="form-group">
                        <label class="control-label">Created at</label>
                        <input class="form-control" value="{{$createdAt}}" name="created_at">
                    </div>     

                    <div class="form-group">
                        <label class="control-label">Status</label>
                        <select class="form-control m-b" name="status">
                            <option @if($status === 'draft') selected @endif value="draft">Draft</option>
                            <option @if($status === 'published') selected @endif value="published">Published</option>
                        </select>
                    </div>

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






