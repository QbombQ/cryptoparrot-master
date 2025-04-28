@extends('pages.TradeSubsystem.layout', 
[
    'title' => 'Blocked Users',
    'classes' => 'h-100',
    'html_class' => '',
    'description' => '',
	'poster' => ''
])

@section('main')

    @parent

    @section('content')
         
        <div class="wrapper">

            <div class="sidebar">
                @include('pages.TradeSubsystem.common.sidebar') 
            </div>
            <div class="main">

                <div class="shade"></div>
                
                @include('pages.TradeSubsystem.common.header') 


                @if(isset($blockedUsers['data']) && count($blockedUsers['data']) > 0)



                <main class="main-content py-5">
                      <div class="px-5 ">
                            <div class="row">
                            <div class="col col-xl-7 col-lg-12 mb-1">

                                <div id="replacable-main-content">

                                        
                                        @foreach($blockedUsers['data'] as $blockedUser) 

                                            <div class="card card-small mb-3">
                                                <div class="card-body">
                
                                                    <div class="row">

                                                   
                                                        <div class=" col-12 col-xl-112">
                                                            
                                                            <img alt="" style="width: 50px;border-radius: 50%;" class="mr-3 user-avatar float-left" src="{{$blockedUser['avatar']}}"/>
                                                            <h6 class="mb-0 font-weight-bold">{{ $blockedUser['username'] }}</h6>
                                                            <p class="mb-0">
                                                                <a href="/app/unblock-user/{{$blockedUser['id']}}" class="view-notification d-inline-block">Unblock <i class="far fa-angle-right"></i></a>
                                                            </p>

                                                        </div>

                                                    </div>
                                
                                                </div> 
                                            </div>
                                        
                                        @endforeach
                                    

                                    @if(isset($blockedUsers['pagination']))
                                        {!! $blockedUsers['pagination'] !!}
                                    @endif

                                </div>

                            </div> 
                            <div class="col-xl-5 col-lg-12 mb-4">
                                <div class="card bg-purple-gradient">
                                <div class="">
                                <div class="card-body p-5">  


                                    <h4 class="h3 font-weight-bold text-white">About Blocked Users</h4>
                                    <p class="mb-2 text-white lead">
                                    Users you have blocked are unable to send a direct message to you. You can control who can and cannot message you within your settings.</p>

                                    <a href="/app/settings#notification-preferances" class="btn btn-lg btn-primary mt-2"><i class="fal fa-cog mr-2"></i> Settings</a> 
                                       

                                </div>
                                </div>
                                </div>
                            </div>
                            </div>
                    </div>
                </div>
            </main>
                

                @else

                 
                    <main class="main-content py-5 text-center">
                      <div class="px-5 py-xl-5">

                         <h2><i class="fal fa-user-slash text-grey"></i></h2>
                          <h3 class="font-weight-bold text-grey">No blocked users</h3>
                          <p class="text-grey">You have not blocked anyone</p> 
                          <a href="/app/messages" class="btn btn-primary btn-lg"><i class="far fa-envelope mr-2 "></i> Messages</a>

                      </div>  
                    </main>
                

                @endif



            </div>

        </div> 


    @endsection

@endsection