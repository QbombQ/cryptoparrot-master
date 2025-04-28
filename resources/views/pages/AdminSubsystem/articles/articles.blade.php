@extends('pages.AdminSubsystem.layout', 
    [
    'html_class' => 'homepage', 
    'title' => 'Articles - CryptoParrot',
    ]
)
 
@section('content')

    @include('pages.AdminSubsystem.common.header') 
 
        <div class="row">

          @if(Session::has('alert'))
          <div class="col-xl-12 pb-2 mt-4">
              <div class="alert alert-warning">{!! session('alert') !!}</div>
          </div>
          @endif

    
        </div>

        <h2 class="mb-4 font-weight-bold">Articles <a href="/admin/articles/new" class="btn ml-2 btn-primary" type="submit"> <i class="fal fa-plus mr-2"></i> New</a></h2>


        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif


        <div class="row">
        <div class="col-xl-9">


        <form method="get" action="/admin/articles" class="form-horizontal mb-4">
                @csrf
                <div class="input-group">

                    <?php
                        $keyword = '';
                        if(isset($_GET['keyword'])) { 
                            $keyword = $_GET['keyword'];
                        }
                    ?>
                    <input type="text" placeholder="Search posts" name="keyword" value="{{$keyword}}" class="form-control form-control-lg">
                    <div class="input-group-btn">
                        <button style="border-top-left-radius: 0px;border-bottom-left-radius: 0px;" class="btn btn-lg btn-primary" type="submit">
                            Search
                        </button>
                    </div>
                </div>

            </form>

            <div class="table-responsive">

                  <table class="table table-hover">
                            <tbody>
                                @if(count($articles['articles']) > 0)
                                    @php
                                        $iterationFirst = !Request::segment(4) ? 1 : (Request::segment(4) - 1) * config('custom.admin.itemsPerPage') + 1;
                                    @endphp
                                    @foreach($articles['articles'] as $article)   

                                        <tr>  
                                            <td class="project-status">
                                                <span class="td-holder"><span class="td-inner align-self-center w-100">
                                                @if($article['url'])
                                                <span class="label label-primary">Aggregate</span>
                                                @else
                                                <span class="label label-warning">Article</span>
                                                @endif 
                                                </span>
                                                </span>
                                            </td>
                                            <td class="project-title">
                                                <span class="td-holder"><span class="td-inner align-self-center w-100">
                                                <a href="project_detail.html">{{$article['title']}}</a>
                                                <br>
                                                <small>{{$article['date']}}</small>
                                                </span>
                                                </span>
                                            </td> 
                                            <td class="project-completion text-capitalize" style="width: 100px;">
                                                <span class="td-holder"><span class="td-inner align-self-center w-100">
                                               @if($article['status'] == 'published')
                                               <i class="fas fa-check-circle text-success"></i> 
                                               @else
                                               <i class="fas fa-exclamation-circle text-danger"></i>
                                               @endif 
                                               {{$article['status']}} 
                                                </span>
                                                </span>  
                                            </td>
                                            <td class="project-people">
               
                                            </td> 
                                            <td style="width: 300px;" class="project-actions px-0">

                                                <span class="td-holder"><span class="td-inner align-self-center w-100">

                                                @if($article['url'])
                                                <a target="_blank" href="{{$article['url']}}" class="btn btn-default btn-sm mr-2">Preview link</a>
                                                @else
                                                <a target="_blank" href="/news/{{$article['slug']}}" class="btn btn-default btn-sm mr-2">View</a>
                                                @endif


                                                <a href="/admin/articles/{{$article['id']}}/edit" class="btn btn-primary btn-sm mr-2">Edit</a><a href="/admin/articles/{{$article['id']}}/delete" class="btn btn-danger btn-sm" onClick="return confirm('Are you sure you want to delete this article?')">Delete</a>

                                                </span>
                                                </span>
                                            </td>
                                        </tr>              
                                       
                                    @endforeach
                                @else
                                    <tr><td>No articles yet</td></tr>
                                @endif
                            </tbody>
                        </table>
                       


            </div>

            @if(isset($articles['pagination']))
                            {!! $articles['pagination'] !!}
                        @endif
                    

        </div>

        <div class="col-xl-3">



              
        </div>
        </div>


        @include('pages.AdminSubsystem.common.footer') 

@endsection  
  
@section('footer')

@endsection  




