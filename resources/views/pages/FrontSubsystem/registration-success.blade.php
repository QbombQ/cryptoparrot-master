@extends('pages.FrontSubsystem.layout', 
[
    'title' => 'You have successfully pre-registered!',
    'classes' => '',
    'html_class' => '',
    'description' => 'Congrats! You just became a part of something awesome.',
	'poster' => 'assets/images/niffler-og.jpg'
])

@section('main')

    @parent

    @section('content')

        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif

        <!-- Welcome Section -->
        <div class="welcome d-flex justify-content-center flex-column ">

            @include('pages.FrontSubsystem.common.header') 

            <!-- Inner Wrapper -->
            <div class="border-bottom pb-4 pb-sm-5 page-content pt-5 pt-sm-5">
                <div class="inner-wrapper mt-auto mb-auto container">
                <div class="row justify-content-center">
                    <div class="col-11 col-sm-10 col-lg-8 text-left">

                        <div class="text-center">
                            <i class="fal fa-user-check display-1 mb-5 text-success"></i>
                        </div>
             
                        <div class="card mb-3">


                            <div class="card-body">
                                <h4 class="card-title">Thanks for pre-registering</h4>


                                <p class="lead ">Before you go… we’re asking all of our early adopters to share Niffler.co with other awesome folks you know! </p>

                                <p class="lead">In return, we're gonna give your profile an “early adopter badge” letting others know, you helped build the Niffler community from day 1!</p>
 

                                <a href="#" data-toggle="modal" data-target="#shareWithFriends" class="d-block d-lg-inline-block mt-2 btn btn-primary"><i class="fas fa-paper-plane mr-2 "></i> Invite Friends</a>

                                <a class="btn mt-2 btn-primary  btn-smm d-block d-lg-inline-block" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fniffler.co%2F&amp;src=sdkpreparse" > <i class="fab fa-facebook-f mr-1"></i>  Share</a>
                                

                              
                                <a target="_blank" class="btn mt-2 btn-primary btn-smm d-block d-lg-inline-block"
                                      href="https://twitter.com/intent/tweet?text=I%20just%20signed%20up%20to%20the%20best%20place%20to%20learn%20cryptocurrency%20trading%20and%2For%20getting%20paid%20to%20teach%20others%20how%20to%20trade%21%20%20https%3A%2F%2Fniffler.co&hashtags=cryptocurrency,cryptotrader,cryptoexchange"
                                      data-size="large">
                                    <i class="fab fa-twitter mr-1"></i> Tweet</a>   
                               

                                <a href="https://www.linkedin.com/shareArticle?mini=true&url=https%3A%2F%2Fniffler.co%2F&title=I%20just%20joined%20Niffler.io&summary=I%20just%20signed%20up%20to%20the%20best%20place%20to%20learn%20cryptocurrency%20trading%20and%2For%20getting%20paid%20to%20teach%20others%20how%20to%20trade!%20%20https%3A%2F%2Fniffler.co%20" target="_blank" class="btn btn-primary btn-smm mt-2 d-block d-lg-inline-block"><i class="fab fa-linkedin-in mr-1" style="position: relative;top:-1px;"></i> Share</a>
                              

                            </div>
                        </div>


                    </div>
                </div>
                </div>
            </div>

            <div class="modal" id="shareWithFriends">
                <form autocomplete="off" id="shareWithFriendsForm" action="/shareWithFriends" method="post">
                    @csrf
                    <div class="modal-dialog">
                        <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Invite your friends</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">


                
                            <div class="input-group input-group-seamless mb-3">
                                <span class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="far fa-at"></i>
                                    </span>
                                </span>
                                <input autocomplete="off"  type="email" class="form-control" name="emails[]" id="form1-email" placeholder="Email 1">
                            </div>
                            <div class="input-group input-group-seamless mb-3">
                                <span class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="far fa-at"></i>
                                    </span>
                                </span>
                                <input autocomplete="off" type="email" class="form-control" name="emails[]" id="form2-email" placeholder="Email 2"> 
                            </div>
                            <div class="input-group input-group-seamless mb-3">
                                <span class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="far fa-at"></i>
                                    </span>
                                </span>
                                <input  autocomplete="off" type="email" class="form-control" name="emails[]" id="form3-email" placeholder="Email 3">
                            </div>
                            <div class="input-group input-group-seamless mb-3">
                                <span class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="far fa-at"></i>
                                    </span>
                                </span>
                                <input  autocomplete="off" type="email" class="form-control" name="emails[]" id="form4-email" placeholder="Email 4">
                            </div>
                            <div class="input-group input-group-seamless mb-3">
                                <span class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="far fa-at"></i>
                                    </span>
                                </span>
                                <input  autocomplete="off" type="email" class="form-control" name="emails[]" id="form5-email" placeholder="Email 5">
                            </div>                                                                                                                

                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button onclick="gtag('event', 'Invite Friends');" type="submit" class="btn btn-primary">Send Invites</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>

                        </div>
                    </div>
                </form>
            </div>

  
            <!-- / Inner Wrapper -->
        </div>
        <!-- / Welcome Section --> 

    @endsection

    @section('footer-scripts') 
        <script src="{{ asset('assets/js/FrontSubsystem/registration-success.js') }}"></script>   
    @endsection    

@endsection