@component('mail::message')

<p>Hello {{$username}}, </p>

<p>You just have succesfully exchanged {{$amountPlayDollars}} play dollars for real {{$amountBTC}}BTC.</p> 
 
<h4 style="font-weight: bold;margin-top: 20px;">Reward was made posible by our sponsor OspreyFX</h4>

<a href="https://cryptoparrot.com/ospreyfx" targt="_blank">
<img style="max-width: 120px;margin-top: 15px;margin-bottom: 15px;" src="{{ asset('assets/images/ospreyfx.png') }}" alt=""></a> 
 
<p>In order for us to be able to continue to payout rewards, it's important that you thank our sponsor by visiting their site. OspreyFX allows to trade crypto and forex (FX) on MT4 with up to 1:500 leverage.</p>  
 
@component('mail::button', ['url' => 'https://cryptoparrot.com/ospreyfx'])
Visit OspreyFX
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