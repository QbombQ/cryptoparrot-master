@component('mail::message')

<p>Hello {{$username}}, </p>

<p>Your trade #{{$trade_id}} has been completed.</p> 

@component('mail::button', ['url' => $url])
Make another trade
@endcomponent

<h4 style="font-weight: bold;margin-top: 20px;">Ready to trade in real life?</h4>

<a href="https://cryptoparrot.com/ospreyfx" targt="_blank">
<img style="max-width: 120px;margin-top: 15px;margin-bottom: 15px;" src="{{ asset('assets/images/ospreyfx.png') }}" alt=""></a> 
 
<p>We want to introduce you to OspreyFx. Lightning Fast ECN broker offering 1:500 leverage
<a href="https://cryptoparrot.com/ospreyfx" targt="_blank">Sign up</a> to trade Forex, Cryptos, CFD’s, Stocks and Commodities with full STP execution.</p> 
 
@component('mail::button', ['url' => 'https://cryptoparrot.com/ospreyfx'])
Start Now
@endcomponent
  
Thanks,<br>
Team {{ env('APP_NAME') }} 

@slot('footer')
@component('mail::footer') 
This email was sent by {{ env('APP_NAME') }}</a><br/>
<a href="{{ env('APP_URL') }}" targt="_blank">{{ env('APP_NAME') }}</a> &copy; 2020
@endcomponent 
@endslot   

@endcomponent  