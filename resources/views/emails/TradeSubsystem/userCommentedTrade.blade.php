@component('mail::message')

<p>Hellow {{$tradeAuthorUsername}}, </p>

<p>{{$commentAuthorUsername}} just posted a comment on your trade.</p> 

<p>Click button below to view the comment.</p>

@component('mail::button', ['url' => $url])
View comment
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