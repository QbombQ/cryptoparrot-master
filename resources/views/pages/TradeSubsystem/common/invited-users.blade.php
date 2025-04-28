@if(count($invitedUsers) > 0)

	@php

		$total_eligible = 0;

		foreach($invitedUsers as $invitedUser){

			if($invitedUser['verified'] && $invitedUser['hasTrades']) $total_eligible++;

		}

	@endphp



	@if($total_eligible >= 5)

		<div class="pb-2 alert alert-success">
		     Congrats! You have qualified for $10 OspreyFX reward. Register on <a target="_blank" class="font-weight-bold text-success" href="/ospreyfx">OspreyFX</a> and email us your OspreyFX email address to <a class="font-weight-bold text-success"  href="rewards@cryptoparrot.com">rewards@cryptoparrot.com</a> and we will issue your reward.
		</div> 

	@else 

    @foreach($invitedUsers as $invitedUser)
        @include('pages/TradeSubsystem/common/invited-user')
    @endforeach

    @endif

@else
    <div class="pb-2 portfolio-item">
        You haven't invited any users yet
    </div> 
@endif