@if(Auth::check())
    <div id="invite-modal" class="modal fade" role="dialog">

       
        <div class="modal-dialog modal-lg modal-dialog-centered">

            <!-- Modal content-->
            <div class="modal-content">

                 <button type="button" class="close" data-dismiss="modal"><i class="fal fa-times"></i></button>


                <div class="modal-body p-4 p-md-5">

                    <h4 class="mb-0 font-weight-bold">Invite <span id="invite-users-left">5</span> Friends &</h4>
                    <h5 class="mb-4 font-weight-bold">Get $10 to trade on <a href="/ospreyfx" class="text-success font-weight-bold">OspreyFX <span class="iconify ml-1" data-icon="ant-design:arrow-right-outlined" data-inline="false"></span></a></h5>
                    
                    <div id="copied-success" class="text-center text-success d-none mb-2">Link successfully copied! <i class="ml-2 far fa-check"></i></div>

                    <div class="input-group input-group-lg">
                      <input id="invite-link" type="text" readonly class="form-control text-center copy-to-clipboard" aria-label="" value="{{ env('APP_URL') }}/invite/{{Auth::user()->handle}}">
                      <div class="input-group-append"> 
                        <button class="btn btn-primary btn-lg dropdown-toggle dropdown-toggle-no-arrow pl-4 pr-4" type="button" data-display="static" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="d-none d-md-inline">Share </span><span class="iconify ml-2" data-icon="ant-design:arrow-down-outline" data-inline="false"></span></button>
                        <div class="dropdown-menu dropdown-menu-right">
                          <a class="dropdown-item" rel="nofollow noopener" target="_blank" href="https://twitter.com/intent/tweet?text=I’m using @cryptoparrot to learn how to trade cryptocurrencies safely. Join me it’s FREE {{ env('APP_URL') }}/invite/{{Auth::user()->handle}}">Twitter <span class="pull-right"><i class="fab fa-twitter"></i></span></a>
                          <a class="dropdown-item" rel="nofollow noopener" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{ env('APP_URL') }}/invite/{{Auth::user()->handle}}">Facebook <span class="pull-right"><i class="fab fa-facebook-f"></i></span></a>
                          <a class="dropdown-item" id="copy-invite-link" href="#">Copy Link <span class="pull-right"><i class="far fa-link"></i></span></a>
                        </div> 
                      </div> 
                    </div>  

                         
                    <small class="text-muted d-block mt-2" style="line-height: 1.2;">* Please note, invited friends must verify their email and make at least one trade. This offer can be claimed only once. If you already claimed OspreyFX reward through some other promotion you are not eligible.</small>

                    <div  class="">
                        <p class="mb-2 mt-4 text-muted d-none" id="invited-users-heading">User <span class="float-right">Status</span></p>
                        <div id="invited-users-content">
                            
                        </div>
                    </div>

                    

                </div>
            </div>

        </div>
    </div> 
    @endif