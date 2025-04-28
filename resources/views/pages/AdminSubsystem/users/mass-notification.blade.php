
@extends('pages.AdminSubsystem.layout', 
    [
    'html_class' => 'homepage', 
    'title' => 'Send signal - CryptoParrot',
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

        <h2 class="mb-4 font-weight-bold">Send signal</h2>


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
                <strong>Send signal</strong>
            </li>
            
        </ol>

        
           <form method="post" enctype="multipart/form-data" action="" class="form-horizontal">
    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-lg-8">
          
                            @csrf

                            <div class="form-group">
                                <label class="control-label">Text</label> 
                                <textarea class="form-control" value="{{ old('text') }}" name="text">{{ old('text') }}</textarea>
                            </div>

                            <div class="form-group">
                                <label class="control-label">URL</label> 
                                <input placeholder="Enter url" type="text" value="{{ old('url') }}" name="url" class="form-control">
                            </div>  

                            <div class="hr-line-dashed"></div>                              
                            
                            @if ($errors->any())
                                @foreach ($errors->all() as $error)
                                    <div class="alert alert-danger alert-dismissible fade show mb-0 border-top" role="alert">
                                        <i class="fa fa-exclamation-circle"></i> 
                                        {{ $error }}
                                    </div>
                                @endforeach
                            @endif         
                            @if (session('message'))
                                <div class="alert alert-success mb-0">
                                    {{ session('message') }}
                                </div>
                            @endif                                                 
                       
                  
            </div>
            <div class="col-lg-4">
                       

                        <div class="form-group">
                             <label class="control-label">Test <small class="text-muted pl-2">If set it will send signal to specified user</small></label> 
                            <input placeholder="Enter user handle" type="text" value="{{ old('test_handle') }}" name="test_handle" class="form-control">
                        </div>      

                        <div class="form-group">
                            <label class="control-label">Competition <small class="text-muted pl-2">If set it will send signal to competition participants only</small></label>
                            
                                <select class="select2 form-control m-b" name="competition">
                                    <option value="none">None</option>
                                    @foreach($competitions as $key => $value)
                                        <option value="{{$key}}">{{$value}}</option>
                                    @endforeach
                                </select>
                          
                        </div>   
  
                        <button class="btn btn-primary btn-block" type="submit">Send signal</button>
                       
                   
            </div>
        </div>
    </div>
    </form>

        </div>
        </div>


        @include('pages.AdminSubsystem.common.footer') 

@endsection  
  
@section('footer')

@endsection  




