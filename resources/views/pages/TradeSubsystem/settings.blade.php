@extends('pages.TradeSubsystem.layout', 
[
    'title' => 'Settings',
    'classes' => 'h-100',
    'html_class' => '',
    'description' => '',
	'poster' => ''
])

@section('main')

    @parent

    @section('styles')
        @parent
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.4.0/cropper.min.css">
        <link rel="stylesheet" href="{{ asset('assets/css/TradeSubsystem/settings.css') }}">
    @endsection

    @section('content')

        <div class="wrapper">

            <div class="sidebar">
                @include('pages.TradeSubsystem.common.sidebar') 
            </div>
            <div class="main">

                <div class="shade"></div>
                
                @include('pages.TradeSubsystem.common.header') 

                <main class="main-content pt-4 pb-4 pt-sm-4 py-lg-5">
                  <div class="px-4 px-sm-4 px-lg-5">

                    <div class="row">
                        <div class="col-12">

                        
                        
                            <div class="toast-block" id="success-alert" style="display: none;">
                         
                              <div class="toast success" role="alert" aria-live="assertive" aria-atomic="true">
                              
                                <div class="toast-body"> 
                                
                                <div class="text-white">
                                    <i class="fa fa-check-circle mr-1"></i> 
                                    <span id="success-alert-text"></span>
                                </div>
     
                                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                                    <span class="iconify" data-icon="ant-design:close-circle-outlined" data-inline="false"></span>
                                  </button>

                                </div>
                              </div>
                            
                            </div> 


                            <div class="toast-block" id="error-alert" style="display: none;">
                         
                              <div class="toast error" role="alert" aria-live="assertive" aria-atomic="true">
                              
                                <div class="toast-body"> 
                                
                                <div class="text-danger">
                                    <i class="fa fa-exclamation-circle mr-1"></i> 
                                    <span id="error-alert-text"></span>
                                </div>
     
                                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                                    <span class="iconify" data-icon="ant-design:close-circle-outlined" data-inline="false"></span>
                                  </button>

                                </div>
                              </div>
                            
                            </div> 
    

                            <div class="mb-3 mb-sm-4 mb-lg-5">
 
                                <a href="" class="lead font-weight-medium link pr-4 active"data-target="#setttings-carousel" data-slide-to="0"><span class="mb-0 iconify h4 mr-1" data-icon="ant-design:setting-outline" data-inline="false"></span><span> General</span></a>
                                <a href="" data-target="#setttings-carousel" data-slide-to="1" class="lead font-weight-medium link pr-4"><span class="mb-0  iconify h4 mr-1" data-icon="ant-design:bell-outline" data-inline="false"></span><span class="d-none d-sm-inline-block"> Notifications</span></a>
                                <a href="" data-target="#setttings-carousel" data-slide-to="2" class="lead font-weight-medium link pr-4"><span class="mb-0  iconify h4 mr-1" data-icon="ant-design:user-add-outline" data-inline="false"></span><span class="d-none d-sm-inline-block"> Social </span></a>
                                <a href="" data-target="#setttings-carousel" data-slide-to="3" class="lead font-weight-medium link"><span class="mb-0  iconify h4 mr-1" data-icon="ant-design:lock-outline" data-inline="false"></span><span class="d-none d-sm-inline-block"> Password</span></a>

                            </div>

                            <div class="pb-4 pb-lg-0">
                            <div id="setttings-carousel" class="carousel slide carousel-fade pb-5" data-interval="false" data-wrap="false">
                                <div class="carousel-inner"> 
                                    <div class="carousel-item active">
                                        <!--general-->
                                        @include('pages.TradeSubsystem.settings.general')
                                    </div>
                                    <div class="carousel-item">
                                        <!--notifications-->
                                        @include('pages.TradeSubsystem.settings.notifications')
                                    </div>
                                    <div class="carousel-item">
                                        <!--social-->
                                        @include('pages.TradeSubsystem.settings.social')   
                                    </div>
                                    <div class="carousel-item">
                                        <!--password-->
                                        @include('pages.TradeSubsystem.settings.password')   
                                    </div>
                                </div>
                            </div>
                            </div>
              


                        </div>
                    </div>

                  </div>  
                </main>
            </div>

        </div> 

    @endsection

    @section('body-scripts')
        @parent
        <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.4.0/cropper.min.js"></script>
        <script src="{{ asset('assets/js/plugins/uploader/js/jquery.dm-uploader.js') }}"></script>
        <script src="{{ asset('assets/js/TradeSubsystem/settings.js') }}"></script>
    @endsection      


@endsection