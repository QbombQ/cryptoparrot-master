@extends('pages.AdminSubsystem.layout', 
    [
    'html_class' => 'homepage', 
    'title' => 'New Competition - CryptoParrot',
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

        <h2 class="mb-4 font-weight-bold">New Competition</h2>


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
                <a href="/admin/competitions/">Competitions</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>New</strong>
            </li>
            
        </ol>
 

          <form method="post" enctype="multipart/form-data" action="" class="form-horizontal">
                @csrf

                <div class="row">
                <div class="col-xl-8">

                    <div class="form-group">

                        <label class="control-label">Title</label>
                        <input id="article-title" type="text" value="{{ old('title') }}" name="title" class="form-control">

                    </div>
                    <div class="hr-line-dashed"></div>

                    <div class="hr-line-dashed"></div>

                    <div class="form-group"><label class=" control-label">Password (optional)</label>
                        <div class=""><input id="competition-password" type="text" value="{{ old('password') }}" name="password" class="form-control"></div>
                    </div>

                    <div class="hr-line-dashed"></div>

                    <div class="form-group"><label class=" control-label">GEO (optional) e.g. US</label>
                        <div class=""><input id="competition-geo" type="text" value="{{ old('geo') }}" name="geo" class="form-control"></div>
                    </div>

                    <div class="form-group">

                        <label class="control-label">Start date</label>
                        <input type="text" value="{{ old('start_date') }}" name="start_date" class="form-control datepicker">

                    </div>

                    <div class="form-group">

                        <label class="control-label">End date</label>
                        <div class=""><input type="text" value="{{ old('end_date') }}" name="end_date" class="form-control datepicker"></div>

                    </div>
                                                            
                    <div class="form-group">

                        <label class="control-label">Badges (1 or more)</label>
                        <div class="">
                            <select class="form-control m-b" multiple name="badge[]">
                                @foreach($badges as $key => $value)
                                    <option value="{{$key}}">{{$value}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                     <div class="form-group">
                        <label class="control-label">Prizes</label>
                        <textarea name="prize" class="form-control prize-desc" placeholder="Prize">{{ old('prize') }}</textarea>
                    </div>

                    <div class="form-group">
                        <label class="control-label">Description</label>
                        <textarea class="form-control" value="{{ old('description') }}" name="description">{{ old('description') }}</textarea>
                    </div>

                </div>
                <div class="col-xl-4">


                    <label class="control-label">Logo</label>
                    <div class="input-group mb-3">
                     
                      <div class="custom-file">
                        <input accept="image/*" name="logo" type="file" class="custom-file-input" id="competitionLogo" aria-describedby="inputGroupFileAddon01">
                        <label class="custom-file-label" for="competitionLogo">Choose file</label>
                      </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label">Cover</label>
                   
                         <div class="input-group mb-3">
                     
                          <div class="custom-file">
                            <input accept="image/*" name="cover" type="file" class="custom-file-input" id="competitionCover" aria-describedby="inputGroupFileAddon01">
                            <label class="custom-file-label" for="competitionCover">Choose file</label>
                          </div>
                         </div>

                    </div>

                    <div class="form-group">
                        <input type="hidden" name="is_private" value="off">
                        <input type="checkbox" name="is_private"/>
                        <label class="control-label">Is private</label>
                        
                    </div>

                    <button class="btn btn-lg btn-primary" type="submit">Create</button>

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

                                         
            </form>

            
        </div>

        <div class="col-xl-3">

          
        </div>
        </div>


        @include('pages.AdminSubsystem.common.footer') 

@endsection  
  
@section('footer')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script type="text/javascript">
    
    flatpickr(".datepicker",{
        enableTime: true,
        dateFormat: "Y-m-d H:i:S",
    });
 
    //2020-05-09 13:00:00

</script>

@endsection  







