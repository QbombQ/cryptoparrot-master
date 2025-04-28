@component('mail::message')

Hello {{$username}},

Once in a while we arrange sponsored trading competitions on Crypto Parrot, and we want you to know how they work.

There are few types of competitions that might take place on the platform. Some of them might be private or passphrase protected, but we’ll always email you when there is a competition you are eligible for — just another reason why it’s always worth ensuring you’re receiving email updates from us.

Usually there is a time period in which eligible users can join the competition before it starts. Once a competition commences, new participants are no longer accepted. Each participant gets a custom portfolio created with fresh 100K in play dollars so that everyone starts at the same point.

Users who are participating in the competition then are able to see the competition leaderboard to track their progress. Once competition ends, we reach out with each of the winners to arrange the prize delivery.


Thanks,
Team {{ env('APP_NAME') }}

@slot('footer')
    @component('mail::footer')
        This email was sent by {{ env('APP_NAME') }}</a><br/>
        <a href="{{ env('APP_URL') }}" targt="_blank">{{ env('APP_NAME') }}</a> &copy; {{ date('Y') }} <a href="{{$url}}">Unsubscribe</a>
    @endcomponent
@endslot

@endcomponent 
