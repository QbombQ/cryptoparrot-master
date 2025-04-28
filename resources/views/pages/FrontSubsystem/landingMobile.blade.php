@extends('pages.FrontSubsystem.layout-no-footer',[
    'title' => 'Learn how to trade cryptocurrency on a simulated exchange',
    'classes' => 'shards-landing-page--1',
    'html_class' => '',
    'landing' => true, 
    'description' => 'Niffler.co is a free cryptocurrency trading simulator that helps you learn how to trade cryptocurrencies safely and claim rewards from your play dollar profits.',
	'poster' => 'assets/images/niffler-og.jpg'
])

@section('main') 

    @parent

    @section('styles')
        @parent
        <link rel="stylesheet" href="{{ asset('assets/css/mobileLanding.css') }}"> 
    @endsection  

    
    @section('content')


    <div class="container vh-100">
    	<div class="row justify-content-center py-5 vh-100">
    		<div class="col-10 col-sm-6 d-flex pb-5">

    			<div class="align-self-center w-100">


    			<img src="{{ asset('assets/images/svg_icon.svg') }}" class="logo-mobile" alt="logo-small">
    			

		    	<h3 class="welcome-heading mt-5 mt-lg-0 font-weight-bold">Cryptocurrency <br/>  trading simulator.
		                    </h3>

		        
		        <a class="btn btn-primary btn-lg text-center font-weight-bold" href="/signup">Get Started</a>

		        <p class="mt-5">Have an account already? <a href="/login">Log in</a>

	    	</div>     
    	</div>     
    </div>     
 

	@endsection


@endsection




@section('footer-scripts')

<script>

    function sendGuestIP(ip){

        if (window.webkit) {

            var message = {
                ip: ip,
            };

            window.webkit.messageHandlers.guestVisit.postMessage(message);

        }

    }

    sendGuestIP("{{Request::ip()}}");

</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/cleave.js/1.3.3/cleave.min.js"></script> 
<script src="{{ asset('assets/js/ccc-streamer-utilities.js') }}"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.1.0/socket.io.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.1/moment.min.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.js"></script>

<script src="{{ asset('assets/js/plugins/formvalidation/formValidation.popular.min.js') }}"></script>  
<script src="{{ asset('assets/js/plugins/formvalidation/framework/bootstrap4.min.js') }}"></script>  

<script src="{{ asset('assets/js/landing.js') }}"></script>   
@endsection
