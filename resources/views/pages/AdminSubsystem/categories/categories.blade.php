@extends('pages.AdminSubsystem.layout', 
    [
    'html_class' => 'homepage', 
    'title' => 'Categories - CryptoParrot',
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

        <h2 class="mb-4 font-weight-bold">Categories <a href="/admin/categories/new" class="btn ml-2 btn-primary" type="submit"> <i class="fal fa-plus mr-2"></i> New</a></h2>


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
            <li class="breadcrumb-item active">
                <strong>Badges</strong>
            </li>
            
        </ol>

            <div class="table-responsive">

                <table class="table table-hover">

                             <thead>
                            <tr>
                                <th>Title</th>
                                <th>Slug</th>
                                <th>Actions</th>
                            </tr>
                            </thead>

                            <tbody>
                                @if(count($categories['categories']) > 0)
                                    @php
                                        $iterationFirst = !Request::segment(4) ? 1 : (Request::segment(4) - 1) * config('custom.admin.itemsPerPage') + 1;
                                    @endphp
                                    @foreach($categories['categories'] as $category)   

                                        <tr>  
                                            <td><span class="td-holder"><span class="td-inner align-self-center w-100">{{$category['title']}}</span></span></td>
                                            <td><span class="td-holder"><span class="td-inner align-self-center w-100">{{$category['slug']}}</span></span></td>
                                            <td><span class="td-holder"><span class="td-inner align-self-center w-100"><a href="/admin/categories/{{$category['id']}}/edit" class="btn btn-primary btn-sm mr-2">Edit</a><a href="/admin/categories/{{$category['id']}}/delete" class="btn btn-danger btn-sm" onClick="return confirm('Are you sure you want to delete this category?')">Delete</a></span></span></td>
                                        </tr>              
                                       
                                    @endforeach
                                @else
                                    <tr><td>No categories yet</td></tr>
                                @endif
                            </tbody>
                        </table>
                       


            </div>
                    

        </div>

        <div class="col-xl-3">



              
        </div>
        </div>


        @include('pages.AdminSubsystem.common.footer') 

@endsection  
  
@section('footer')

@endsection  




