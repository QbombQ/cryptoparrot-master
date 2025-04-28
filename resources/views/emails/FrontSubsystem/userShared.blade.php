@component('mail::message')

<p>Hey</p>

<p>Your friend (not an Nigerian Prince but someone you actually know) asked us to send you this email about a really cool new cryptocurrency trading website called <a href="{{ env('APP_URL') }">{{ env('APP_NAME') }}</a> that teaches people how to trade cryptocurrency without risking their capital!</p>

<p>And the best part is, once you get good at it, you can start making money teaching others!</p>

<p>Interested in checking out <a href="{{ env('APP_URL') }">{{ env('APP_NAME') }}</a> for yourself? Click on the button below!</p>

@component('mail::button', ['url' => config('app.url')])
    Check out {{ env('APP_NAME') }}
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
 