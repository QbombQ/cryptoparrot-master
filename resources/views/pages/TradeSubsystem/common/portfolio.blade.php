@if($balance['amount'])

<div class="row mt-3">
<div class="col-6 ellipsis"><img class="portfolio-icon mr-2" src="/assets/images/crypto-icons/color/{{ strtolower($balance['acronym']) }}.svg"> {{ $balance['name'] }} </div>
<div class="col-6" data-balance="{{ $balance['acronym'] }}" data-amount="{{$balance['amount']}}">
    @if($balance['reserved']) <span data-toggle="tooltip" data-placement="top" title="Reserved on open orders/positions: {{ $balance['symbol'] }}{{ $balance['reserved'] }}"> @else <span> @endif
    @if($balance['acronym'] == 'USD') <strong> @endif
    {{ $balance['symbol'] }}{!! $balance['amount'] !!}
	@if($balance['acronym'] == 'USD') </strong> @endif
    </span>
</div>
</div>


@endif  