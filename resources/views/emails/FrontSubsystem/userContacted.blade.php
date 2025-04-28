@component('mail::message')

Contact form submission on {{ env('APP_NAME') }}<br />

<strong>Full name:</strong> {{ $fullName }} <br />
<strong>Email:</strong> {{ $email }} <br />
<strong>Message:</strong><br> {{ $message }} <br /> <br />

Thanks,<br>
Team {{ env('APP_NAME') }}

@slot('footer')
@component('mail::footer') 
This email was sent by {{ env('APP_NAME') }}</a><br/>
<a href="{{ env('APP_URL') }}" targt="_blank">{{ env('APP_NAME') }}</a> &copy; {{ date('Y') }}
@endcomponent 
@endslot 
 

@endcomponent

 