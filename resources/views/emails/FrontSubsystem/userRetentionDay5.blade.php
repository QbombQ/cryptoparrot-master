@component('mail::message')

Hello {{$username}},

We hope that your trading journey is going well; even if it doesn’t don’t worry, that’s why we have play dollars after all!

However, if you feel that you are ready to poke around the world of real trading, we have comprehensive guides and reviews ready for you to learn more about trading.

Thanks,
Team {{ env('APP_NAME') }}

@slot('footer')
    @component('mail::footer')
        This email was sent by {{ env('APP_NAME') }}</a><br/>
        <a href="{{ env('APP_URL') }}" targt="_blank">{{ env('APP_NAME') }}</a> &copy; {{ date('Y') }} <a href="{{$url}}">Unsubscribe</a>
    @endcomponent
@endslot

@endcomponent 
