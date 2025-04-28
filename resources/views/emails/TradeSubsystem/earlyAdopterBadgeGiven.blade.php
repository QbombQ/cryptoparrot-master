@component('mail::message')

<h1>Hello early Niffler.co adopters,</h1>

<p>Earlier today we soft launched/beta launched Niffler.co the simulated exchange for newbies and experienced traders!  Niffler.co as you know is designed to help newbies learn all about blockchain, crypto and cryptocurrency trading within our hands on, real time, real world simulated exchange that's safe, unique and insanely fun!  Best part is, once you get good at it as a newbie (or if you're experienced trader coming in from day one and showing "proof of experience"), you can earn money helping teach others!  Think of us as Coinbase meets Patreon, without the risk!</p>

<img style="width: 100%;" src="{{ asset('assets/images/email/early-adopters.jpg') }}" class="mr-2" alt="">

<p>Today's soft launch/beta invite is only open to our 700+ amazing pre-registered users (ie YOU) as we cannot thank enough for getting onboard early!  Each and everyone of you will get an "Early Adopter Badge" within your profiles denoting you are in fact early trail blazers when it comes to unique crypto projects like Niffler.co</p>

<p>To get started right away, <a href="{{$url}}/app/competitions">click here</a> (please do consider reading the whole email though as its packed full of great info!)</p>

<h2>A special thank you, for our early adopters and trailblazers...</h2>

<p>As a special thank you, we will be running a $500 in the crypto of your choice (and other prizes like Nano Ledgers, swag etc for runner ups) Niffler.co two week Top Trading Competition for early adopters starting October 1st 2018.  You can register to participate <a href="{{$url}}/contact">here</a> or on our competitions page. Start sharpening your trading skills today so you're ready to top the leaderboard, win great prizes and claim the title of Top Trader once the competition starts! 
</p>   

<h2>One request from the community...</h2>

<p>As you can imagine building a real time simulated exchange and community is no easy feat,...but no one liked a challenge like this better than us! Niffler and our team of insanely talented front-end, back-end devs, designers have been (and continue to be) working day and night to get Niffler.co to our ultimate goal. If there is one thing we could ask for, it's this: <strong>If you happen to run into any bugs, glitches please do let us know via our contact us page found <a href="{{$url}}/contact">here</a> or live chat found throughout the site.</strong> We think we squashed or caught them all through rigorous QA, but sometimes real world and live environments produce funny unforeseen issues and any feedback, thoughts and reporting of those etc back to us would be greatly appreciated by the entire team.  </p>

<h2>Last but not least...</h2>

<p>We also wanted to take a minute to thank all of those in the crypto community who have helped us in various ways, whether through exposure, feedback or just simple kind words of support....we wouldn't have been able to accomplish what we have without them....you can find out a little more about them below and if you have a minute, please do check out each and every one of those projects!  These are all amazing people, doing amazing things to help move the crypto community in the right direction and ultimately all the way to mass adoption! Apologies if we’ve missed any of the amazing people who contributed to this launch!</p>

 
<img style="width: 100%;" src="{{ asset('assets/images/email/supporters-logo.jpg') }}" class="mr-2" alt="">
 

<p>If for any reason you need to contact us, whether feedback, thoughts, partnerships etc, please feel to reply to this email or simply go to Niffler.co and use live chat.</p> 

@component('mail::button', ['url' => $url])
Visit Niffler.co
@endcomponent

<p>Thanks again from all of us!</p>

<p>- Team Niffler.co</p>


@endcomponent
