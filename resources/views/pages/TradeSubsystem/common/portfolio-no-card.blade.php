
<!-- Users by device -->


  	<h6 class="mt-5">{{$username}} Portfolio</h6>

    <div class="">
        <p class="mb-4 text-muted">Your holdings <span class="float-right">Amount</span></p>
        @foreach($balances as $balance)
            @include('pages.TradeSubsystem.common.portfolio')
        @endforeach
    </div>


