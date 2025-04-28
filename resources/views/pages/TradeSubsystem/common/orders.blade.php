@if(count($orders) > 0)
    @foreach($orders as $order)
        @include('pages/TradeSubsystem/common/order')
    @endforeach
@else
    <div class="card card-small">
        <div class="card-body text-center p-xl-5">
            <div class="p-4 p-lg-5">
                <h3 class="text-grey-light font-weight-bold">You have no active orders</h3>
                <p class="lead text-grey-light px-xl-5">Post a trade to see your active orders</p> 
                <a href="/app/trade" class="btn btn-primary btn-lg">Post a trade</a>
            </div>
        </div>
    </div>
@endif