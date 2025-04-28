@component('mail::message')

Hello {{$username}},

This is the 7th and final email from our welcome email series and we are proud to see you learn so much in the last 6 days.

During your time using our site, you have already come across our leaderboard page on the platform. If you were a little confused on how the positions are selected, then you’re not alone, so let’s look a little deeper into how our leaderboards work.


On CryptoParrot traders are ranked by redeemed play dollar amount redeemed. Why? Simple: we believe that measuring success by cashed out profits is the best way to go.

To start ranking, simply use our reward system, and start redeeming your profits!

Thanks,
Team {{ env('APP_NAME') }}

@slot('footer')
    @component('mail::footer')
        This email was sent by {{ env('APP_NAME') }}</a><br/>
        <a href="{{ env('APP_URL') }}" targt="_blank">{{ env('APP_NAME') }}</a> &copy; {{ date('Y') }} <a href="{{$url}}">Unsubscribe</a>
    @endcomponent
@endslot

@endcomponent 
