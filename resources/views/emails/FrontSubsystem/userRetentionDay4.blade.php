@component('mail::message')

Hello {{$username}},

The most risky, but at the same time the most rewarding, trade you can do is a leverage trade. Today we are going to show you how you can increase your stakes and tame this beast of a trade on Crypto Parrot.

On Crypto Parrot you can leverage trade up to 5x, which essentially means that you can increase your risk/reward up to five times.

In order to place a leverage trade, you’ll find need to make sure that you have some play dollars in your portfolio. You can then start new trade with any USD pair and in trade modal, click on “Advanced Options” button to see leverage configurations.

From there you can select desired leverage. Selecting “Buy” trade will result in opening a long position and opting for “Sell” trade will result in opening a short position.

Place your order and you are set!

Just remember to keep in mind the fact that the leverage trade is a position, so you won’t see the amount you longed for in your portfolio. You will only see that a certain play dollar amount is reserved to cover your position.


Thanks,
Team {{ env('APP_NAME') }}

@slot('footer')
    @component('mail::footer')
        This email was sent by {{ env('APP_NAME') }}</a><br/>
        <a href="{{ env('APP_URL') }}" targt="_blank">{{ env('APP_NAME') }}</a> &copy; {{ date('Y') }} <a href="{{$url}}">Unsubscribe</a>
    @endcomponent
@endslot

@endcomponent 
