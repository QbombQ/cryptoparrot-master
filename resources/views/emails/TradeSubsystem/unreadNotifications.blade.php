@component('mail::message')

<p>Hello {{$username}}, </p>

<p>You have {{$total}} unread notifications.</p> 

@component('mail::button', ['url' => 'https://niffler.co/app/notifications'])
View Notifications
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