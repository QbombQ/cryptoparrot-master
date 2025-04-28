@extends('pages.FrontSubsystem.layout', 
[
    'title' => 'Disclaimer | '.env('APP_NAME'),
    'classes' => '',
    'html_class' => '',
    'header' => true,
    'header_class' => 'header-white ',
    'header_outer_class' => 'bg-disclaimer',
    'header_colour' => true,
    'description' => 'Please read the risk disclaimer you must have agreed to read before being able to continue to use '.env('APP_NAME'),
    'nofollow'=>true,
	'poster' => 'assets/images/poster.jpg'
])

@section('main')

    @parent 

    @section('header-landing')
    <div class="row justify-content-between py-5">
 

        <div class="col-md-6 col-xl-6 d-flex pt-xl-5">
           
            <div class="align-self-center w-100">
              <h1 class="welcome-heading mt-lg-5 text-purple font-weight-bold mb-4">Disclaimer
              </h1>
  
                <p class="lead text-purple mb-4">These are the general terms and conditions of {{ env('APP_NAME') }} for use of the {{ env('APP_NAME') }} website (the “Site”). Please read these terms and conditions carefully as your use of the Site is subject to them. {{ env('APP_NAME') }} reserves the right at its sole discretion to change, modify or add to these terms and conditions without prior notice to you.</p>

                <p class="lead font-weight-medium text-purple mb-5">By continuing to use the Site you agree to be bound by such amended terms.</p>

            
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

                    <h2 class="font-weight-normal h1 mb-4">Newbie &amp; Trader Disclaimer</h2>

                    <p class="">If you choose to use the site, application and services, you do so at your sole risk. You acknowledge and agree that {{ env('APP_NAME') }} does not have an obligation to conduct background checks on any member, including, but not limited to, Newbies and traders, but may conduct such background checks in it's sole discretion.  The site, application, services and collective content are provided "as is", without warranty of any kind, either expressed or implied.</p> 

                    <p>Without limiting the foregoing, {{ env('APP_NAME') }} explicitly disclaims any warranties of merchantability, fitness for a particular purpose, quiet enjoyment or non-infringement, and any warranties arising out of course of dealing or usage of trade. {{ env('APP_NAME') }} makes no warranty that the site, application, services, collective content, including, but not limited to, the listings or any information provided via appointments will meet your requirements or be available on an uninterrupted, secure, or error-free basis.  {{ env('APP_NAME') }} makes no warranty regarding the quality of any any listings, the services or collective content or the accuracy, timeliness, truthfulness, completeness or reliability of any collective content obtained through the site, application of the services.</p>

                    <p>No advice or information, whether oral or written, obtained from {{ env('APP_NAME') }} or through the site, application, services or collective content, will create any warranty not expressly made herein. </p>

                    <p class="mb-5">
                    You are solely responsible for all of your communications and interactions with other users of the site, application or services and with other person with whom you communicate or interact as a result of your use of the site, application or services.  You understand that {{ env('APP_NAME') }} does not make any attempt to verify the statements of users of the site, application or services.  {{ env('APP_NAME') }} makes no representations or warranties as to the conduct of users of the site, application or services or their compatibility with any current of future users of the site, application or services.  You agree to take reasonable precautions in all communications and interactions with other users of the site, application or services and with other persons with whom you communicate or interact as a result of your user of the site, application or services, including, but not limited to, traders, regardless of whether such communications or interactions are organized by {{ env('APP_NAME') }}.
                    </p> 


                    <h2 class="font-weight-normal h1 mb-4">Limitation of Liability</h2>

                    <p>You acknowledge and agree that, to the maximum extent permitted by law, the entire risk arising out of your access to and use of the site, application, services and collective content, listings or appointments via the site, application and services, and any contact you have with other users of {{ env('APP_NAME') }} whether in person, by phone, online or other means remains with you.  Neither {{ env('APP_NAME') }} nor any other party involved in creating, producing, or delivering the site, application, services or collective content will be liable for any incidental, special, exemplary or consequential damages, including lost profits, loss of data or loss of goodwill, service interruption, computer damage or system failure or the cost of the substitute products or services, or for any images for person or bodily injury or emotional distress arising out of or in connection with these terms, from the use of or inability to use the site, application, services or collective content, from any communications, interactions or meetings with other users of the site, application, or services or other persons with whom you communicate or interact with as a result of you use of the site, application, services, whether based on warranty, contract, tort (including negligence), product liability or any other legal theory, and whether or not {{ env('APP_NAME') }} has been informed of the possibility of such damage, even if a limited remedy set forth herein is found to have failed of it essential purpose.  </p>


                    <p class="mb-5">In no event will {{ env('APP_NAME') }}'s aggregate liability arising out of or in connection with this disclaimer and your use of the site, application and services including, but not limited to, from your listing or booking of any appointment via the site, application and services, or form the use of or inability to use the site, application, services or collective content and in connection with any interactions with any other members, exceed the amounts you have paid or owe for appointments made vie the site, application and services as a member in the twelve (12) month period prior to the event giving rise to the liability or one hundred dollars ($100), if no such payments have been made, as applicable.  The limitations of damages set forth above are fundamental elements of the basis of the bargain between {{ env('APP_NAME') }} and you.  Some jurisdiction do not allow the exclusion of limitation of liability for consequential or incidental damage, so the above limitation may not apply to you.</p>


                    <h2 class="font-weight-normal h1 mb-4">Indemnification</h2>

                    <p>You agree to release, indemnify, and hold {{ env('APP_NAME') }} and its affiliates and subsidiaries, and their officers, directors, employees and agents, harmless from and against any claims, liabilities, damages, losses, and expenses, including, without limitation, reasonable legal and accounting fees, arising out of or in any way connected with (a) your access to or use of the Site, Application, Services, or Collective Content or your violation of these Terms; (b) your Member Content and (c) your (i) interaction with any Member, (ii) reliance on any information exchanged via the Site, Application or Services, or (iii) creation of a Listing. {{ env('APP_NAME') }} shall have the right to control all defense and settlement activities.</p>


                    <p class="mb-5">You fully understand that you are using any and all information available on {{ env('APP_NAME') }} AT YOUR OWN RISK.</p>

                    <h2 class="font-weight-normal h1 mb-4">Not Investment Advice</h2>

                    <p>The information provided on this website does not constitute investment advice, financial advice, trading advice or any other sort of advice and you should not treat any of the website’s content as such. {{ env('APP_NAME') }} does not recommend that any cryptocurrency should be bought, sold or held by you and nothing on this website should be taken as an offer to buy, sell or hold a cryptocurrency. {{ env('APP_NAME') }} and the information found within is for educational purposes so please conduct your own due diligence and consult your financial adviser before making any investment decisions.</p>

                    <p>You understand and acknowledge that there is a very high degree of risk involved in trading cryptocurrency. You acknowledge and agree that you, and not {{ env('APP_NAME') }}, are solely responsible for your own investment research and decisions. Do not trade with money that you cannot afford to lose. You understand that the {{ env('APP_NAME') }} encourages you to seek the advice of a qualified securities professional and/or tax or legal advisor, as necessary, before making any investment outside of the {{ env('APP_NAME') }} platform, and to investigate and fully understand any and all risks before investing outside of the {{ env('APP_NAME') }} platform. {{ env('APP_NAME') }} assumes no responsibility or liability for any future trading and investment results outside of the {{ env('APP_NAME') }} platform and you agree to hold {{ env('APP_NAME') }} harmless for any such results or losses.</p>

                    <p class="mb-5">You fully understand that you are using any and all information available on {{ env('APP_NAME') }} AT YOUR OWN RISK.</p>

                    <h2 class="font-weight-normal h1 mb-4">Accuracy of Information</h2>

                    <p>{{ env('APP_NAME') }} and our team will strive to ensure accuracy of information listed on this website although it will not hold any responsibility for any missing or wrong information. You understand that you are using any and all information available here AT YOUR OWN RISK.</p>


                </div>
            </div>
            </div>
        
        </div>

    @endsection

@endsection