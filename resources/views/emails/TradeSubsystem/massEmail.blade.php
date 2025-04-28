@component('mail::message')

{!! $content !!}

@slot('footer')
@component('mail::footer') 
This email was sent by {{ env('APP_NAME') }}. <a href="{{$url}}" style="color:#ccc;">Unsubscribe</a> <br/>
<a href="{{ env('APP_URL') }}" targt="_blank">{{ env('APP_NAME') }}</a> &copy; 2020

@endcomponent 
@endslot 

@endcomponent  

