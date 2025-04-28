@component('mail::message')

<p>Hello {{$username}},</p>   

<p>To reset your password and create a new one, tap the button below. If you did not request a password reset, please ignore this message.</p>

<p>Change your password on {{ env('APP_NAME') }} by clicking the button below:</p>

@component('mail::button', ['url' => $url])
Set new password
@endcomponent

Thanks,<br>
Team {{ env('APP_NAME') }}

@slot('footer')
@component('mail::footer') 
This email was sent by {{ env('APP_NAME') }}</a><br/>
<a href="{{ env('APP_URL') }}" targt="_blank">{{ env('APP_NAME') }}</a> &copy; {{ date('Y') }}
@endcomponent 
@endslot 
 
@endcomponent 


  