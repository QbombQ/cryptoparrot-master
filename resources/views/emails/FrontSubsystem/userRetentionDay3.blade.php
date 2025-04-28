@component('mail::message')

Hello {{$username}},

It’s your third day on Crypto Parrot, and we hope you are already getting familiar with how things work. If not, be sure to join our community telegram to get some extra help from our community.

As your journey commences, you will quickly see that making bad calls is not that difficult in trading, and your portfolio can tip negative fairly quickly. To meet the needs of users who would prefer to experiment with multiple strategies all at once, we have created a multiple portfolio feature.

Click on a little arrow next to your portfolio overview, to prompt portfolio modal:

![portfolio modal screenshot.png]({{asset('assets/images/crypto-modal.png')}} "Portfolio Modal Screenshot")

From here you can click the “New” button, to create a new portfolio, the “Switch” button to change active portfolio and the “Delete ” button to remove additional portfolios.

One important thing to note is that additional portfolios are not eligible for rewards, so you should always treat your main portfolio with the utmost care.


Thanks,
Team {{ env('APP_NAME') }}

@slot('footer')
    @component('mail::footer')
        This email was sent by {{ env('APP_NAME') }}</a><br/>
        <a href="{{ env('APP_URL') }}" targt="_blank">{{ env('APP_NAME') }}</a> &copy; {{ date('Y') }} <a href="{{$url}}">Unsubscribe</a>
    @endcomponent
@endslot

@endcomponent 
