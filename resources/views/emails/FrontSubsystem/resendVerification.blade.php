@component('mail::message')


<p>Hey there,</p>

<p>Confirm this email address below… Resend</p>

@component('mail::button', ['url' => $url])
Confirm
@endcomponent

<p>If you did not register on {{ env('APP_NAME') }}, please ignore this message.</p>

Thanks,<br>
Team {{ env('APP_NAME') }}

@slot('footer')
@component('mail::footer') 
This email was sent by {{ env('APP_NAME') }}</a><br/>
<a href="{{ env('APP_URL') }}" targt="_blank">{{ env('APP_NAME') }}</a> &copy; {{ date('Y') }}
@endcomponent 
@endslot 

@endcomponent  
  