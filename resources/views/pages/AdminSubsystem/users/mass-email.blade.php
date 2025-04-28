@extends('pages.AdminSubsystem.layout', 
    [
    'html_class' => 'homepage', 
    'title' => 'Newsletter - CryptoParrot',
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

        <h2 class="mb-4 font-weight-bold">Send newsletter</h2>


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
                <strong>Send newsletter</strong>
            </li>
            
        </ol>

        
        <form method="post" enctype="multipart/form-data" action="" class="form-horizontal">

    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-lg-8">
          
                             @csrf
 
                            <label class="control-label">Subject</label> 
                            <input type="text" value="{{ old('subject') }}" name="subject" placeholder="" class="form-control mb-3">


                            <div class="form-group">
                                <label class="control-label">Content</label> 
                                <textarea class="form-control" value="{{ old('content') }}" name="content">{{ old('content') }}</textarea>
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
                            <label class="control-label">Badges <small class="text-muted pl-2">(0 or more)</small></label>
                            <select class="select2 form-control m-b" multiple name="badge[]">
                                @foreach($badges as $key => $value)
                                    <option value="{{$key}}">{{$value}}</option>
                                @endforeach
                            </select>
                           
                        </div>


                        <div class="form-group">
                            <label class="control-label">Ref. Code.</label>
                            <input class="form-control m-b" placeholder="Enter Ref" name="ref"/>               
                        </div>

                        <div class="form-group">

                            <label class="control-label">Competitions (0 or more)</label>
                            <select class="select2 form-control m-b" multiple name="competition[]">
                                @foreach($competitions as $key => $value)
                                    <option value="{{$key}}">{{$value}}</option>
                                @endforeach
                            </select>
                            
                        </div>

                        <div class="form-group">

                            <label class="control-label">Specific users (0 or more)</label>
                            <select class="select2 form-control m-b" multiple name="users[]">
                                @foreach($users as $key => $value)
                                    <option value="{{$key}}">{{$value}}</option>
                                @endforeach
                            </select>

                        </div>                        

                        <div class="form-group">
          
                            <input placeholder="Enter test email" type="email" value="{{ old('test_email') }}" name="test_email" class="form-control">
                        </div>                                                                                                                                                     
                        <button class="btn btn-primary btn-block" type="submit">Send Newsletter</button>
                       
                   
            </div>
        </div>
    </div>


        </div>
        </div>

        </form>


        @include('pages.AdminSubsystem.common.footer') 

@endsection  
  
@section('footer')

@endsection  




