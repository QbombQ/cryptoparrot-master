@php
    $socket = false;
@endphp
@if(count($trades['data']) > 0)
    @foreach($trades['data'] as $trade)
        @include('pages/TradeSubsystem/common/trade')
    @endforeach
@else
    <div class="trade-item">
        <p>No trades to show</p>
    </div>
@endif