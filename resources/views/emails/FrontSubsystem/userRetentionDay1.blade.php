@component('mail::message')

How to place a trade?

Making your first trade on Crypto Parrot is easy. First, you’ll need to log in to the platform. You’ll then be able to see that the “New trade” button in the top right corner on the desktop, or you can click the plus icon on the bottom right on mobile.

The trade window will appear. From there, make sure that the “Buy” option is selected (you only have play dollars at this point and nothing to sell).

By default, BTC/USD pair is selected, but you can tap the pair to prompt a window that will allow you to switch the market. Since you have play dollars, any pair ending with USD is suitable for the first trade.

After selecting the pair, enter the total amount of play dollars you want to spend, and you’ll then be able to see the estimated crypto amount you will receive. By default, it’s a simple market order and will be fulfilled immediately.

Put your rationale or note into the description and click “PLACE BUY ORDER”.

Volia — It’s as simple as that to get started!

Thanks,
Team {{ env('APP_NAME') }}

@slot('footer')
    @component('mail::footer')
        This email was sent by {{ env('APP_NAME') }}</a><br/>
        <a href="{{ env('APP_URL') }}" targt="_blank">{{ env('APP_NAME') }}</a> &copy; {{ date('Y') }} <a href="{{$url}}">Unsubscribe</a>
    @endcomponent
@endslot

@endcomponent 
