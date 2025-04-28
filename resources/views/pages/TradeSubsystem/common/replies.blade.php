@foreach($replies as $reply)
	@if($loop->first)<div class="mt-3"></div>@endif
    @include('pages/TradeSubsystem/common/single-reply')
@endforeach