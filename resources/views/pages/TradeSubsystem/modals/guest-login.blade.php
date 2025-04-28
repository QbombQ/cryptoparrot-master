<div id="guest-login-modal" class="modal fade" role="dialog">

   
    <div class="modal-dialog modal-dialog-centered">

        <!-- Modal content-->
        <div class="modal-content">

        	 <button type="button" class="close" data-dismiss="modal"><i class="fal fa-times"></i></button>


            <div class="modal-body p-5"> 

                <h4 class="card-title mb-4 text-left font-weight-bold">
                  Join {{ env('APP_NAME') }} Simulated Exchange
                </h4> 


                <form method="post" id="register" class="" action="/register">
                    @csrf

     
                    <input autocomplete="email" type="email" class="form-control mb-2" name="email" id="form1-email" value="{{ old('email') }}" placeholder="Email">
                    

                    <input type="password" class="form-control mb-3" name="password" id="form1-password" placeholder="Password">
        
                    <span class="d-block mb-3 small">By signing up you agree to the <a href="/tos" target="_blank">Terms of Service</a>.</span>  
                         
                    <button type="submit" class="btn btn-primary btn-block btn-lg font-weight-bold mb-3">Create Your Account</button>
         
                    <p class="mb-0">
                    <span class="pr-2">Or sign up with</span> 
                    <a href="/social/google" class="lead  pr-1">
                        <span class="iconify" data-icon="ant-design:google-outline" data-inline="false"></span>
                    </a>
                    <a href="/social/twitter" class="lead  pr-1">
                        <span class="iconify" data-icon="ant-design:twitter-outline" data-inline="false"></span>
                    </a>
                    <a href="/social/reddit" class="lead  pr-1">
                        <span class="iconify" data-icon="ant-design:reddit-outline" data-inline="false"></span>
                    </a> 
                    <a href="/social/discord" class="lead pr-1">
                          <i class="fab fa-discord"></i>
                    </a>
                    
                    </p> 

                    <div class="text-left border-top mt-3 pt-3">
                    Have an account?  <a class="font-weight-bold " href="/login">Login</a>
            </div>
  

                </form> 

          
 
            </div>

        </div>

    </div>

</div> 