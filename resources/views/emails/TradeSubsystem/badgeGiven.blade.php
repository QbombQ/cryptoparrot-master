@component('mail::message')

<p>Hey {{ $username }},</p> 

<p>Congrats on receiving the “{{ $badge }}” badge. You can learn more about this badge by checking out your profile and hovering on the badge.</p>

@component('mail::button', ['url' => $url])
Visit your profile
@endcomponent 

Thanks,<br />
Team {{ env('APP_NAME') }}

@slot('footer')
@component('mail::footer') 
This email was sent by {{ env('APP_NAME') }}</a><br/>
<a href="{{ env('APP_URL') }}" targt="_blank">{{ env('APP_NAME') }}</a> &copy; 2020
@endcomponent 
@endslot  

@endcomponent 
