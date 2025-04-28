@extends('pages.FrontSubsystem.layout', 
[
    'title' => 'Pick your username, before it\'s gone!',
    'classes' => '',
    'html_class' => '',
    'header' => true,
    'header_outer_class' => 'bg-purple-gradient', 
    'header_class' => 'bg-header bg-header-right', 
    'description' => 'You are one step from joining CryptoParrot community! Choose your username before it gets taken by others.',
    'poster' => 'assets/images/poster.jpg'
])

@section('main') 

    @parent
 
    @section('header-landing')


                @if ($errors->any())
                 <div style="position: fixed;bottom: 2rem;right: 2rem;z-index: 10;">
                 
                  <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                  
                    <div class="toast-body"> 
                    
                    @foreach ($errors->all() as $error)
                    <div class=""><i class="fa fa-exclamation-circle text-danger pr-1"></i>  <span class="font-weight-bold text-danger">{{ $error }}</span>
                    </div>
                    @endforeach

                    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                        <span class="iconify" data-icon="ant-design:close-circle-outlined" data-inline="false"></span>
                      </button>

                    </div>
                  </div>
                  
                </div>
                @endif

                <div class="row justify-content-center py-5">
                <div class="col-xl-4 d-flex pt-xl-5">
           
                <div class="align-self-center w-100 pb-5">


                    <div class="card card-register ">
                    <div class="card-body p-sm-5">
                        <h4 class="card-title mb-4 text-center font-weight-bold">
                            Pick you username
                        </h4> 
 
                        <form method="post" class="" action="/pick-your-handle">
                                            @csrf
                                            <?php
                                                $username = '';
                                                if(session('nickname')) {
                                                    $username = session('nickname');
                                                }
                                                if(old('username')) {
                                                    $username = old('username');
                                                }
                                            ?>
                                            <div class="input-group input-group-seamless mb-2">
                                              
                                                <input type="text" class="form-control form-control-lg" name="username" id="form1-username" value="{{ $username }}" placeholder="Username">
                                            </div>      
                                            @php
                                                $fakeEmail = Auth::user()->key . '@cryptoparrot.com';
                                            @endphp
                                            @if(Auth::user()->email === $fakeEmail)

                                                <div class="input-group input-group-seamless mb-2">
                                                    
                                                    <input type="text" class="form-control form-control-lg" name="email" id="form1-email" value="{{ old('email') }}" placeholder="Email">
                                                </div>
                                                <small class="mb-3 d-block mt-2">Unfortunately we are not able to access your email from {{session('method')}}</small>
 
                                            @endif 
                                            
                                            <button class="btn download btn-primary btn-lg btn-block"> Proceed <i class="fal fa-arrow-right ml-1"></i></button>
                                            

                                        </form>

                    </div> 
                    </div>

                </div>

                </div>
                </div>

                              
                   

            


    @endsection 

    @section('content')
    @endsection

@endsection