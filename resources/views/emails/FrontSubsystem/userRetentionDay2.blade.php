@component('mail::message')

Good day, {{$username}},

It’s your second day on Crypto Parrot, and it’s time for another revelation.

How do Crypto Parrot rewards work?

Yes, if you haven’t figured this one out yet, each play dollar on our platform has an assigned value of real Bitcoin, and you can redeem it with the lightning network.

Here is a quick video that shows how to redeem your profits.

Important things to note:


Each user starts with 100K in play dollars. You can redeem anything that you make over that amount.

For example, if you make trades and your overall portfolio value subsequently reaches 120K, you can redeem 20K play dollars.

It’s best to redeem your profits as soon as you make them, as play dollar exchange value drops the more profits you hoard.

Do not use multiple accounts to circumvent the reward system, as that will result in ban of all accounts.It’s also important to note that only your main portfolio is eligible for rewards; we’ll explain more about the additional portfolio options in our next email.


Thanks,
Team {{ env('APP_NAME') }}

@slot('footer')
    @component('mail::footer')
        This email was sent by {{ env('APP_NAME') }}</a><br/>
        <a href="{{ env('APP_URL') }}" targt="_blank">{{ env('APP_NAME') }}</a> &copy; {{ date('Y') }} <a href="{{$url}}">Unsubscribe</a>
    @endcomponent
@endslot

@endcomponent 
