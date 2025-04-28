@extends('pages.AdminSubsystem.layout', 
    [
    'html_class' => 'homepage', 
    'title' => 'Badges - CryptoParrot',
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

        <h2 class="mb-4 font-weight-bold">Badges <a href="/admin/badges/new" class="btn ml-2 btn-primary" type="submit"> <i class="fal fa-plus mr-2"></i> New</a></h2>


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
                                <th>#</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Is branded</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                                @if(count($badges['badges']) > 0)
                                    @php
                                        $iterationFirst = !Request::segment(4) ? 1 : (Request::segment(4) - 1) * config('custom.admin.itemsPerPage') + 1;
                                    @endphp
                                    @foreach($badges['badges'] as $badge)                 
                                        <tr>
                                            <td class="align-middle"><span class="td-holder"><span class="td-inner align-self-center w-100">{{$iterationFirst++}}</span></span></td>
                                            <td class="align-middle"><span class="td-holder"><span class="td-inner align-self-center w-100">{{$badge['title']}}</span></span></td>
                                            <td class="align-middle"><span class="td-holder"><span class="td-inner align-self-center w-100">{{$badge['description']}}</span></span></td>
                                            <td class="align-middle"><span class="td-holder"><span class="td-inner align-self-center w-100">{{$badge['is_branded']}}</span></span></td>
                                            <td class="align-middle"><span class="td-holder"><span class="td-inner align-self-center w-100"><a href="/admin/badges/{{$badge['id']}}/edit" class="btn btn-default btn-sm mr-2">Edit</a><a href="/admin/badges/{{$badge['id']}}/delete" class="btn btn-danger btn-sm" onClick="return confirm('Are you sure you want to delete badge?')">Delete</a></span></span></td>  
                                        </tr>
                                    @endforeach
                                @else
                                    <tr><td>No badges yet</td></tr>
                                @endif
                            </tbody>
                        </table>
                       


            </div>
                        @if(isset($badges['pagination']))
                            {!! $badges['pagination'] !!}
                        @endif

        </div>

        <div class="col-xl-3">



              
        </div>
        </div>


        @include('pages.AdminSubsystem.common.footer') 

@endsection  
  
@section('footer')

@endsection  




