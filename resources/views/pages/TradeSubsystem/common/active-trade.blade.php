<li class="list-group-item d-block @if($loop->first) is-first @endif @if($loop->last) is-last @endif"> 
	<div class="d-flex justify-content-between">
		<div class="d-flex">



			<div class="align-self-center">
			@if($trade['typeNoFormat'] == 'long')

			<div>
				<img class="active-trade-icon" src="/assets/images/crypto-icons/color/{{ strtolower($trade['buyingAcronym']) }}.svg"> 
				<span class="font-weight-bold">{{$trade['amount']}}</span>
				<span class="text-purple font-weight-medium">at</span>
				<img class="active-trade-icon" src="/assets/images/crypto-icons/color/{{ strtolower($trade['payingAcronym']) }}.svg"> 
				<span class="font-weight-bold">{{$trade['targetPrice']}}</span>
				<span class="font-weight-medium text-purple">({{$trade['leverage']}})</span>
			</div> 

			<div class="small text-purple-pale">
				Current Price: <span class="text-purple">{{$trade['currentPrice']}}</span> <span class="px-2">|</span> Profit: <span class="text-purple">{{$trade['profit']}}</span></small>
			</div>

			@elseif($trade['typeNoFormat'] == 'short')

			<div>
				<img class="active-trade-icon" src="/assets/images/crypto-icons/color/{{ strtolower($trade['payingAcronym']) }}.svg"> 
				<span class="font-weight-bold">{{$trade['amount']}}</span>
				<span class="text-purple font-weight-medium">at</span>
				<img class="active-trade-icon" src="/assets/images/crypto-icons/color/{{ strtolower($trade['buyingAcronym']) }}.svg"> 
				<span class="font-weight-bold">{{$trade['targetPrice']}}</span>
				<span class="font-weight-medium text-purple">({{$trade['leverage']}})</span>
			</div> 

			<div class="small text-purple-pale">
				Current Price: <span class="text-purple">{{$trade['currentPrice']}}</span> <span class="px-2">|</span> Profit: <span class="text-purple">{{$trade['profit']}}</span></small>
			</div>

			@elseif($trade['typeNoFormat'] == 'buy')


			<div>
				<img class="active-trade-icon" src="/assets/images/crypto-icons/color/{{ strtolower($trade['buyingAcronym']) }}.svg"> 
				<span class="font-weight-bold">{{$trade['amount']}}</span>
				<span class="text-purple font-weight-medium">at</span>
				<img class="active-trade-icon" src="/assets/images/crypto-icons/color/{{ strtolower($trade['payingAcronym']) }}.svg"> 
				<span class="font-weight-bold">{{$trade['targetPrice']}}</span>
			</div> 

			<div class="small text-purple-pale">
				Current Price: <span class="text-purple">{{$trade['payingSymbol']}}{{$trade['rate']}}</span> <span class="px-2">|</span> Spread: <span class="text-purple">{{$trade['payingSymbol']}}{{$trade['spread']}}</span></small>
			</div>



			@else

			<div>
				<img class="active-trade-icon" src="/assets/images/crypto-icons/color/{{ strtolower($trade['payingAcronym']) }}.svg"> 
				<span class="font-weight-bold">{{$trade['amount']}}</span>
				<span class="text-purple font-weight-medium">at</span>
				<img class="active-trade-icon" src="/assets/images/crypto-icons/color/{{ strtolower($trade['buyingAcronym']) }}.svg"> 
				<span class="font-weight-bold">{{$trade['targetPrice']}}</span>
			</div> 

			<div class="small text-purple-pale">
				Current Price: <span class="text-purple">{{$trade['buyingSymbol']}}{{$trade['rate']}}</span> <span class="px-2">|</span> Spread: <span class="text-purple">{{$trade['buyingSymbol']}}{{$trade['spread']}}</span></small>
			</div>

			@endif

			</div>


		</div>

		@if(Auth::check())

    	@if(empty($profileData) || !empty($profileData) && $profileData['userId'] == Auth::id())

		<div class="d-flex">
			<div class="align-self-center w-100 text-center">
			@if($trade['typeNoFormat'] == 'buy' || $trade['typeNoFormat'] == 'sell')
				
				<a href="/app/trade/{{$trade['id']}}/cancel" data-success-text="Cancelled" class="cancel-trade trade-action text-purple">
					<span class="h3 d-block mb-0 line-height"><span class="iconify" data-icon="ant-design:close-circle-outlined" data-inline="false"></span></span>
					<span class="small d-block line-height">Cancel</span>
				</a>
				
			@else
				@if($trade['statusNoFormat'] == 'open')
					
					<a href="/app/trade/{{$trade['id']}}/close" data-success-text="Closed" class="close-trade trade-action text-purple">
					<span class="h3 d-block mb-0 line-height"><span class="iconify" data-icon="ant-design:issues-close-outlined" data-inline="false"></span></span>
					<span class="small d-block line-height">Close</span>
					</a>
					
				@else
		
					<a href="/app/trade/{{$trade['id']}}/cancel" data-success-text="Cancelled" class="cancel-trade trade-action text-purple">
					<span class="h3 d-block mb-0 line-height"><span class="iconify" data-icon="ant-design:close-circle-outlined" data-inline="false"></span></span>
					<span class="small d-block line-height">Cancel</span>
					</a>
					
				@endif
			@endif
			</div>
		</div>
		@endif
		@endif


	</div>
</li>