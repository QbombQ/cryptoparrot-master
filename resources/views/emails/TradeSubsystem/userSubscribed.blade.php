@component('mail::message')

<p>Hello {{$userUsername}}, </p>

<p>You have a new subscriber on {{ env('APP_NAME') }}</p> 
<p>Tap the button below to view {{$subscriberUsername}} profile!</p>
 
@component('mail::button', ['url' => $url])
View Profile
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