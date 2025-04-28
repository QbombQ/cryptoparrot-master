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

        <h2 class="mb-4 font-weight-bold">Edit Competition</h2>


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
                <strong>Edit</strong>
            </li>
            
        </ol>


          <form method="post" enctype="multipart/form-data" action="" class="form-horizontal">
                
                @php
                    $title = old('title') ? old('title') : $competition['title'];
                    $password = old('password') ? old('password') : $competition['password'];
                    $geo = old('geo') ? old('geo') : $competition['geo'];
                    $startDate = old('start_date') ? old('start_date') : $competition['start_date'];
                    $endDate = old('end_date') ? old('end_date') : $competition['end_date'];
                    $description = old('description') ? old('description') : $competition['description'];
                    $prize = old('prize') ? old('prize') : $competition['prize'];
                    $prizePlaces = old('prize_places') ? old('prize_places') : $competition['prizes']['prize_places'];
                    $prizeTitles = old('prize_titles') ? old('prize_titles') : $competition['prizes']['prize_titles'];
                    $isPrivate = old('is_private') ? old('is_private') : $competition['is_private'];
                @endphp                        
                @csrf

                <div class="row">
                <div class="col-xl-8">

                    <input type="hidden" name="competition_id" value="{{$competition['id']}}">
                    <div class="form-group"><label class=" control-label">Title</label>
                        <div class=""><input id="competition-title" type="text" value="{{$title}}" name="title" class="form-control"></div>
                    </div>

                    <div class="hr-line-dashed"></div>

                    <div class="form-group"><label class=" control-label">Password (optional)</label>
                        <div class=""><input id="competition-password" type="text" value="{{$password}}" name="password" class="form-control"></div>
                    </div>

                    <div class="hr-line-dashed"></div>

                    <div class="form-group"><label class=" control-label">GEO (optional) e.g. US</label>
                        <div class=""><input id="competition-geo" type="text" value="{{$geo}}" name="geo" class="form-control"></div>
                    </div>
 
                    <div class="form-group"><label class=" control-label">Start date</label>
                        <div class=""><input type="text" value="{{$startDate}}" name="start_date" class="form-control datepicker"></div>
                    </div>
                    <div class="hr-line-dashed"></div> 
                    <div class="form-group"><label class=" control-label">End date</label>
                        <div class=""><input type="text" value="{{$endDate}}" name="end_date" class="form-control datepicker"></div>
                    </div>
                    <div class="hr-line-dashed"></div>                                                       
                    <div class="form-group"><label class=" control-label">Badges (1 or more)</label>
                        <div class="">
                            <select class="form-control m-b" multiple name="badge[]">
                                @foreach($badges as $key => $value)
                                    <option @if(in_array($key, $competition['badges'])) selected @endif value="{{$key}}">{{$value}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>   
                    <label class=" control-label">Prizes</label>
              
                        <div class="mb-2">
                            <textarea name="prize" class="form-control prize-desc" placeholder="Prize">{{$prize}}</textarea>
                        </div>
                                                  
                    <div class="hr-line-dashed"></div>     
                    <div class="form-group"><label class=" control-label">Description</label>
                        <textarea class="form-control" value="{{$description}}" name="description">{{$description}}</textarea>
                    </div>

                </div>
                <div class="col-xl-4">

                    <div class="hr-line-dashed"></div>   
                    @if($competition['logo'])
                        <img style="width: 150px;" alt="thumbnail" src="{{$competition['logo']}}"/>
                    @endif                                 
                    <label class="control-label">Logo</label>
                    <div class="input-group mb-3">
                     
                      <div class="custom-file">
                        <input accept="image/*" name="logo" type="file" class="custom-file-input" id="competitionLogo" aria-describedby="inputGroupFileAddon01">
                        <label class="custom-file-label" for="competitionLogo">Choose file</label>
                      </div>
                    </div>


                    @if($competition['cover'])
                        <img style="width: 150px;" alt="thumbnail" src="{{$competition['cover']}}"/>
                    @endif                                 
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
                        <input type="checkbox" @if($isPrivate == 1) checked @endif name="is_private"/>
                        <label class="control-label">Is private</label>
                        
                    </div>

                    <button class="btn btn-lg btn-primary" type="submit">Update</button>

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









