@extends('pages.FrontSubsystem.layout', 
[
    'title' => 'Terms and Conditions | '.env('APP_NAME'),
    'classes' => '',
    'html_class' => '',
    'header' => true,
    'header_class' => 'header-white ',
    'header_outer_class' => 'bg-white',
    'header_colour' => true,
    'description' => 'Please read this document carefully, as it sets out the terms and conditions for using '.env('APP_NAME').' the FREE crypto community.',
    'nofollow'=>true,
	'poster' => 'assets/images/poster.jpg'
])

@section('main') 

    @parent

    @section('header-landing')
    <div class="row justify-content-center py-5">


        <div class="col-xl-8 d-flex pt-xl-5">
           
            <div class="align-self-center w-100">
              <h1 class="welcome-heading mt-lg-5 text-purple font-weight-bold mb-5">{{ env('APP_NAME') }} Terms & Conditions
              </h1>
 
    
         
              <p class="text-purple lead mb-5">These are the general terms and conditions of {{ env('APP_NAME') }} for use of the {{ env('APP_NAME') }} website (the “Site”). Please read these terms and conditions carefully as your use of the Site is subject to them. {{ env('APP_NAME') }} reserves the right at its sole discretion to change, modify or add to these terms and conditions without prior notice to you.</p> 

               <p class="text-purple font-weight-medium lead mb-5">
              By continuing to use the Site you agree to be bound by such amended terms.</p>   
            
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

                    <h2 class="font-weight-normal h1 mb-4">1. What you are allowed to do.</h2>
                    <p class="lead font-weight-bold mb-0">You may:</p>
                    <p class="mb-0"><span class="font-weight-bold">a.</span> Browse the Site and view the information on it for private, non-commercial use only.</p>
                    <p class="mb-5"><span class="font-weight-bold">b.</span> Print off pages from the Site to the extent reasonably necessary for your use of the Site in accordance with the above.
                    provided that at all times you do not do any of the things set out in clause 2.</p>
                           

                    <h2 class="font-weight-normal h1 mb-4">2. What you are not allowed to do.</h2>
                    <p class="lead font-weight-bold mb-0">Subject to these terms and conditions, you may not:</p>
                    <p class="mb-0"><span class="font-weight-bold">a.</span> Systematically copy (whether by printing off onto paper, storing on disk, web scraping or in any other way) substantial parts of the Site.</p>
                    <p class="mb-0"><span class="font-weight-bold">b.</span> Remove, change or obscure in any way anything on the Site or otherwise use any material contained on the Site except as set out in these terms and conditions.</p>
                    <p class="mb-0"><span class="font-weight-bold">c.</span> Reproduce, retransmit, disseminate, sell, publish, broadcast the Site nor can anything available on the Site be used in connection with creating, promoting, trading, marketing investment products without the express written consent of {{ env('APP_NAME') }} or its information providers.</p>
                    <p class="mb-0"><span class="font-weight-bold">d.</span> For unlawful purposes and you shall comply with all applicable laws, statutes and regulations at all times.</p>
                    <p class="mb-5"><span class="font-weight-bold">e.</span> Although third party or self promotion is allowed in moderation, any abusive posts or use of the {{ env('APP_NAME') }} platform for third party or self promotion as determined by the {{ env('APP_NAME') }} community manager/moderator at the time will see those posts relegated to the offending accounts private feed; further continued abuse, use and posts, post an email warning may lead to suspension and/or removal of the offending account.</p>

 
                    <h2 class="font-weight-normal h1 mb-4">3. No Investment Advice.</h2>
                    <p class="lead font-weight-bold mb-0">You acknowledge that:</p>
                    <p class="mb-0"><span class="font-weight-bold">a.</span> {{ env('APP_NAME') }} and {{ env('APP_NAME') }} "Traders" do not provide investment advice and that nothing on the Site constitutes investment advice and that you will not treat any of the Site’s content as such.</p>
                    <p class="mb-0"><span class="font-weight-bold">b.</span> {{ env('APP_NAME') }} does not recommend any financial product(s).</p>
                    <p class="mb-0"><span class="font-weight-bold">c.</span> {{ env('APP_NAME') }} does not recommend that any financial product should be bought, sold or held by you.</p>
                    <p class="mb-0"><span class="font-weight-bold">d.</span> Nothing on the Site should be construed as an offer, nor the solicitation of an offer, to buy or sell crypto currency by {{ env('APP_NAME') }}</p>
                    <p class="mb-5"><span class="font-weight-bold">e.</span> Information which may be referred to on the Site from time to time may not be suitable for you and that you should not make any investment decision without consulting a fully qualified financial advisor.</p>


                    <h2 class="font-weight-normal h1 mb-4">4. Copyright and Trademarks</h2>
                    <p class="mb-5">The Site contains trade marks, including the {{ env('APP_NAME') }} name and logo. All trademarks included on the Site belong to {{ env('APP_NAME') }} or have been licensed to {{ env('APP_NAME') }} by the trade mark owner(s) for use on the Site. You are not allowed to copy or otherwise use any of these trademarks in any way except as set out in these terms and conditions.</p>
                    

                    <h2 class="font-weight-normal h1 mb-4">5. Exclusions and limitations of liability</h2>
              
                    <p class="mb-0">{{ env('APP_NAME') }} does not exclude or limit its liability for death or personal injury resulting from its negligence, fraud or any other liability which may not by applicable law be excluded or limited.</p>
                    <p class="mb-5">Subject to clause 5.1, in no event shall {{ env('APP_NAME') }} be liable (whether for breach of contract, negligence or for any other reason) for (i) any loss of profits, (ii) exemplary or special damages, (iii) loss of sales, (iv) loss of revenue, (v) loss of goodwill, (vi) loss of any software or data, (vii) loss of bargain, (viii) loss of opportunity, (ix) loss of use of computer equipment, software or data, (x) loss of or waste of management or other staff time, or (xi) for any indirect, consequential or special loss, however arising.</p>

                    <h2 class="font-weight-normal h1 mb-4 mb-5">6. Disclaimer <a href="/disclaimer" class="font-weight-bold text-purple" target="_blank">Read Here</a></h2>
              

                    <h2 class="font-weight-normal h1 mb-4">7. Availability and updating of the Site</h2>
  
                    <p class="mb-0">{{ env('APP_NAME') }} may suspend the operation of the Site for repair or maintenance work or in order to update or upgrade its content or functionality from time to time. {{ env('APP_NAME') }} does not warrant that access to or use of the Site or of any sites or pages linked to it will be uninterrupted or error free.</p>
                    <p class="mb-5">Nifffler.co may change the format and content of the Site at its sole discretion from time to time. You should refresh your browser each time you visit the Site to ensure that you access the most up to date version of the Site.</p>

                    <h2 class="font-weight-normal h1 mb-4">8. Subscription And Payment</h2>
         
                    <p class="">In connection with any purchase of services or materials from {{ env('APP_NAME') }}, the {{ env('APP_NAME') }} does not make any promise regarding the continuation of any current features or functionality or delivery of any future functionality or features.</p>
                    <p class="">If you purchase a subscription to any {{ env('APP_NAME') }} service or material, by authorizing {{ env('APP_NAME') }} to charge a payment card for the fees associated with your subscription(s), you are authorizing the {{ env('APP_NAME') }} to automatically continue charging that card (or any replacement card issued by the card issuer) for all fees or charges associated with your subscription, including any renewal fees as described below. {{ env('APP_NAME') }} may at any time change any of its pricing, or institute new charges or fees. Price changes and new charges announced during your subscription term for a service will apply to subsequent subscription terms. During the term of your subscription, you agree to inform {{ env('APP_NAME') }} of any payment card information changes.</p>
                    <p class="">Your subscriptions will be set to automatically renew upon expiration. This means that unless you cancel your subscription prior to its expiration, your account will automatically renew for the same term.</p>
                    <p class="">If you cancel or terminate a subscription, you acknowledge and agree that any refunds will be in {{ env('APP_NAME') }} sole discretion. Your obligations hereunder, including your obligation to pay amounts owed to us under these Terms for use of or access to our services or materials, including subscriptions, shall survive expiration or termination of these Terms and your cessation of use of {{ env('APP_NAME') }} Sites and Materials.</p>
                    <p class="mb-5">You are responsible for the payment of any taxes associated with the purchase of services or materials from {{ env('APP_NAME') }}</p>
                    

                    <h2 class="font-weight-normal h1 mb-4">9. User Submissions And Other Content</h2>
                    <p class="">{{ env('APP_NAME') }} Sites and Materials may permit the submission of content by users, including, for example, comments, articles, links, and conversations in our chat rooms (“User Submissions”). By posting any such User Submissions, you grant {{ env('APP_NAME') }} an irrevocable, worldwide, non-exclusive, royalty-free license (with the right to sublicense) to use, copy, reproduce, process, adapt, modify, publish, transmit, display and distribute such User Submission in any and all media or distribution methods (now known or later developed). {{ env('APP_NAME') }} has the right, in its sole discretion and without further notice to you, to monitor, censor, edit, move, and/or remove any and all content posted on {{ env('APP_NAME') }} Sites and Materials, including any User Submission, at any time and for any reason.</p>
                    <p class="mb-5">We do not represent or guarantee the completeness, truthfulness, accuracy, usefulness or reliability of any content or User Submission and do not necessarily endorse any opinions expressed therein. You understand that by using {{ env('APP_NAME') }} Site and Materials, you may be exposed to content that might be offensive, harmful, inaccurate or otherwise inappropriate. We may not monitor or control the content or User Submissions accessible on {{ env('APP_NAME') }} Sites and Materials.</p>


                    <h5 id="rewards" class="font-weight-bold">Rules For The {{ env('APP_NAME') }} Rewards Program</h5>

                    <p>The {{ env('APP_NAME') }} Rewards program was established to reward {{ env('APP_NAME') }} users who are eager to learn and further familiarize themselves with cryptocurrency trading in a safe and simulated environment. It is solely meant for education purposes.<p>

                    <p>At no point is the rewards program or anything within the {{ env('APP_NAME') }} platform meant to be used as a means of financial advice. Any registered user participating in the {{ env('APP_NAME') }} rewards program acknowledges by way of having registered on the {{ env('APP_NAME') }} that they are bound to our Terms of Service & Disclaimer.</p>

                    <p class="mb-5">ALWAYS consult your personal financial advisor for any and all financial advice conducted outside of the {{ env('APP_NAME') }} platform.</p>

                    <h5 class="font-weight-bold">Eligibility Conditions</h5>

                    <p class="mb-5">Each participant in the {{ env('APP_NAME') }} rewards program must be a registered user of {{ env('APP_NAME') }} and make a minimum of 15 trades while also maintaining a 0.05% average profit margin per trade and in doing so further acknowledges by way of having registered on the {{ env('APP_NAME') }} platform they are bound to our Terms of Service & Disclaimer during any and all interaction(s) with the {{ env('APP_NAME') }} platform including participation in the {{ env('APP_NAME') }} rewards program.</p>
 

                    <h5 class="font-weight-bold">How Reward Dollars Are Determined</h5>

                    <p class="mb-5">Eligible “Reward Dollars” (ie profit) are those play dollars that are accrued by way of successful trading of the listed tokens on the {{ env('APP_NAME') }} simulated exchange and are over and above the default $100k USD in play dollars given to each user upon initial registration on the {{ env('APP_NAME') }} platform. 

                    <h5 class="font-weight-bold">Reward Claims & Allocation</h5>

                    <p>Rewards that are based in cryptocurrency will be sent by {{ env('APP_NAME') }} to your existing wallet and will be sent in Bitcoin. Other prizes can be claimed with or will be sent by the corresponding sponsors unless otherwise noted.</p> 

                    <p class="mb-5">It is up to {{ env('APP_NAME') }} users and participants in the Rewards program to provide accurate contact information and {{ env('APP_NAME') }} Inc and its rewards sponsors will not be held liable for inaccurate contact information nor will {{ env('APP_NAME') }} and it’s sponsors be held accountable for any items shipped by mail that are lost or damaged, nor will {{ env('APP_NAME') }} be held accountable for sponsored rewards provided by our sponsors that are shipped by mail and damaged or lost during that process.</p>

                    <h5 class="font-weight-bold">Badge Recognition For Having Claimed A Reward</h5>

                    <p class="mb-5">Users who claim a prize from the Rewards Program will also receive a “Rewards Recognition Badge" that will identify them to their current and future prospective followers as being someone who has achieved that status.</p>

                    <h5 class="font-weight-bold mb-4">Disqualification</h5>

                    <p>{{ env('APP_NAME') }} reserves the right to disqualify ANY & ALL USERS from the Rewards Program if any of the following infractions are committed by a user or group of users:</p>

                    <p>a) Tampers with or manipulates or tries to tamper with or manipulate the Rewards Program in any way whatsoever.</p>

                    <p>b) Carries out or tries to carry out maneuvers which, according to the {{ env('APP_NAME') }}, compromise or misrepresent or aim to compromise or misrepresent the goal or spirit of the Rewards Program.</p>

                    <p>c) Transmits false or misleading information at registration.</p>

                    <p>e) Contravenes the RULES, applicable legislation and Rules of the {{ env('APP_NAME') }} Rewards Program published on this page, or anywhere within the {{ env('APP_NAME') }} platform.</p>

                    <p>f) Adopts a behavior that jeopardizes the {{ env('APP_NAME') }} Rewards Program process or any other behavior deemed inappropriate by {{ env('APP_NAME') }}.</p>

                    <p class="mb-5">g) Is not in full compliance with all eligibility conditions. Any and all disqualified users are not eligible for a prize.</p>

                    <h5 class="font-weight-bold">Post Reward Allocation Contact</h5>

                    <p class="mb-5">Post and reward claims, {{ env('APP_NAME') }} may also reach out to those claimant(s) to request an optional Q & A to share their experience, backgrounds etc with future {{ env('APP_NAME') }} community members and users. Although this is completely optional we hope that those who do participate in the Rewards Program would have interest in sharing their experience with the {{ env('APP_NAME') }} community.</p>

                    <h5 class="font-weight-bold">Legal Discretion</h5>

                    <p>Decisions regarding the administration of the REWARDS according to the RULES are made at the full discretion of {{ env('APP_NAME') }} and are irrevocable. {{ env('APP_NAME') }} Inc its subsidiaries and sponsors, as well as their respective officers, directors, employees, consultants, representatives and agents, can in no case be held liable for any damages or losses of any kind resulting from or related to the REWARDS program, including technical problems, malfunction of trading software or any other software used as part of the simulation, or for any problems that may impede or jeopardize the simulation process, or for errors in the calculation of profit or errors made by participants at the time of registration.</p>


                    </div>
            </div>
            </div>
        
        </div>

    @endsection

@endsection