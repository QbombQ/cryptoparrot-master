@extends('pages.FrontSubsystem.layout', 
[
    'title' => 'Privacy Policy | '.env('APP_NAME'),
    'classes' => '',
    'html_class' => '',
    'header' => true,
    'header_class' => 'header-white ',
    'header_outer_class' => 'bg-privacy',
    'header_colour' => true,
    'description' => 'Welcome to '.env('APP_NAME').' Privacy Notice. We respect your privacy and we are committed to protecting your personal data. ',
    'nofollow'=>true,
	'poster' => 'assets/images/poster.jpg'
])

@section('main')
 
    @parent

    @section('header-landing')
    <div class="row justify-content-between py-5">


        <div class="col-xl-6 d-flex pt-xl-5">
           
            <div class="align-self-center w-100">
              <h1 class="welcome-heading mt-lg-5 text-purple font-weight-bold mb-4">Privacy Policy 
              </h1> 
 
    
            
              <p class="text-purple lead mb-4">Your privacy is very important to us. This Privacy Policy outlines the types of information we gather from your use of this service (the “Service”), how we use it, with whom we might share it, the means by which we keep it secure, and the choices you have about the information you choose to share with us.</p> 

              <p class="text-purple lead mb-5">
              If you have any questions about the privacy practices of {{ env('APP_NAME') }} or this Privacy Policy, please e-mail support&commat;{{ env('APP_FORK') }}.com </p>   
              
            </div>
 
        </div>  
 
   
    </div>
    @endsection 

    @section('content')

        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif

        <div class="container-fluid text-center pt-5 pb-5">
 
            <div class="px-3 px-md-5">
            <div class="row pt-4 justify-content-center">
                <div class="col-lg-8 text-left"> 

                    <h2 class="font-weight-normal h1 mb-4">Personal information we collect</h2>

                    <p>The types of personal information we collect depend on the product or service you (“You”) receive from us. This information may include, but is not limited to:</p>

                    <ul class="mb-5">
                        <li>Your name and email address;</li>
                        <li>Your account information, including, but not limited to, account balances and the like;
                        </li>
                        <li>Your demographic information, such as your age, occupation, investment preferences, etc.;
                        </li>
                        <li>Cryptocurrency information (e.g., cryptocurrency ticker symbols), if You create a personalized portfolio, as well as financial information relating to the cryptocurrency You track; and
                        </li>
                        <li>Your usage information</li>
                    </ul>

                    <h2 class="font-weight-normal h1 mb-4">Personal information - why we collect it</h2>

                    <p class="mb-5">{{ env('APP_NAME') }} may collect certain personal information to provide You with the Service, to perform marketing and research related activities, to supply other administrative services (e.g., setting up new accounts and maintaining your existing account), and to respond to inquiries about your account and the Service. In addition we may from time to time review your usage of the Service to be able to better provide you with information about products or services that we believe may be interest to you.</p>

                    <h2 class="font-weight-normal h1 mb-4">Personal information - how we collect it</h2>

                    <p>The personal information we collect may be captured from a variety of sources. These sources include, but are not limited to:</p>

                    <ul class="mb-5">
                        <li>Voluntary submissions (e.g., responses to surveys, requests for information on our Service, our other products or those of our advertisers/marketing partners);
                        </li>
                        <li>Registrations/Applications to receive the Service; and</li>
                        <li>Reviews of site or app usage patterns</li>
                    </ul>

                    <h2 class="font-weight-normal h1 mb-4">Use and access of your personal information with other</h2>

                    <p class="mb-5">As a general rule, {{ env('APP_NAME') }} will not make the personal information gathered from your using the Service available to anyone outside of {{ env('APP_NAME') }} and its partners and affiliates — except as instructed by You or where required to comply with law, court orders, or legal investigations. Please note, however, that there are several exceptions to this policy. First, if we use service providers, these service providers may have access to your personal information to perform contractually specified services on behalf of {{ env('APP_NAME') }} or You. Second, if You indicate that You are interested in receiving information about a particular third party’s products/services, or You opt to receive certain products or services through {{ env('APP_NAME') }}, we may provide your personal information to that third party for purposes of fulfilling your request(s). With respect to service providers, {{ env('APP_NAME') }} contractually requires that all personal information be kept confidential. Additionally, {{ env('APP_NAME') }} takes reasonable steps to ensure that third parties receiving information about You at your request maintain the confidentiality of that information.</p>

                    <h2 class="font-weight-normal h1 mb-4">Links to other websites</h2>

                    <p class="mb-5">Where applicable, {{ env('APP_NAME') }} may provide links to one or more third party Web sites within the Service. We encourage You to read the individual privacy policies of these Websites before providing any of your personal information to them.</p>

                    <h2 class="font-weight-normal h1 mb-4">Protection of your personal information</h2>

                    <p>{{ env('APP_NAME') }} puts security measures in place to protect against unauthorized access to, or unauthorized use, alteration, disclosure or destruction of personal information. These measures include internal reviews of our data collection, storage and processing practices and security measures, as well as physical security measures to guard against unauthorized access to systems where we store personal information.</p>

                    <p>If You are using a Service on a mobile device, choosing to select “Keep me signed in” will keep your account logged into the Service until You manually log out or change your password. Your User Profile information will still remain password protected.</p>

                    <p>{{ env('APP_NAME') }} operates secure data networks protected by industry standard firewall and password protection systems. Our security and privacy policies are periodically reviewed and enhanced as necessary and only authorized individuals have </p>

                </div>
            </div>
            </div>

        </div>

    @endsection

@endsection