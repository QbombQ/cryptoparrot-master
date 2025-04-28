<div class="@if(isset($inline)) px-4 @else px-5 @endif py-4">


<div id="portfolio-card">

<h6 class="m-0 lead font-weight-bold">
<span class="text-capitalize">
    @if(isset($inline)) Main Portfolio
    @else {{Auth::user()->currentPortfolio->title}} Portfolio
    @endif 
</span>
</h6> 

<div class="mt-3">
 
    <div class="row">
    <div class="col-6 text-light">Holdings</div>
    <div class="col-6 text-light">Amount</div>
    </div>
    @foreach($balances as $balance)
        @include('pages.TradeSubsystem.common.portfolio')
    @endforeach
</div>

</div>

<div id="new-card" class="d-none">

    <h5 class="mb-3 font-weight-bold">Create new portfolio</h5>

    <p class="">You can now create additional portfolios to use for experiments (like a high risk portfolio) & competitions. Your default portfolio will always keep its original performance metrics.</p>

    <form action="/app/portfolios/create" method="post" id="portfolio-create-form">
        @csrf
        <input type="text" class="form-control form-control-lg" name="title" placeholder="New portfolio name"/>
        <button id="portfolio-create-form-button" class="btn btn-primary btn-lg btn-block mt-2" type="submit">Create</button>
        <div id="error-alert-portfolio">
            <p id="error-alert-text-portfolio" class="mb-0"></p>
        </div>
    </form>

</div>

<div id="switch-card" class="d-none">
@if(!isset($doNotShowPortfolioControls) && Auth::check())

    <h5 class="mb-3 font-weight-bold">Switch Portfolio</h5>
    <p class="">Additional portfolios are used for experimenting and competitions. Only profits from the main portfolio are eligible for the Rewards Program.</p>

    <form class="" method="post" action="/app/portfolios/change-current-portfolio">
        @csrf

            @php
                $currentPortfolioId = Auth::user()->current_portfolio_id;
            @endphp
            
            <div class="btn-group btn-group-toggle portfolio-buttons" data-toggle="buttons">
              @forelse($commonUserData['portfolios'] as $portfolioId => $portfolioLabel)
              <label class="portfolio-item btn @if($currentPortfolioId === $portfolioId) active @endif">
                <input type="radio" value="{{$portfolioId}}" name="portfolio_id" autocomplete="off" @if($currentPortfolioId === $portfolioId) checked @endif > 

                @if($currentPortfolioId === $portfolioId)
                <i class="fad text-success fa-check-circle mr-1"></i> 
                @else
                <i class="fal text-muted fa-circle mr-1"></i>
                @endif

                {{$portfolioLabel}}
              </label> 
              @empty

              @endforelse
            </div>

    </form>    
       
@endif
</div>



@if(!isset($doNotShowPortfolioControls))
<div class="portfolio-controls text-left border-top mt-4 pt-3">

    <a href="" id="show-portfolio" class="d-none simulate-link pr-3 font-weight-medium lead text-purple-pale">
        <span class="iconify mr-1" data-icon="ant-design:arrow-left-outline" data-inline="false"></span> Back
    </a> 
 
    <a href="" id="show-new" class="simulate-link pr-2 font-weight-medium lead text-success">
        <span class="iconify mr-1" data-icon="ant-design:plus-circle-outline" data-inline="false"></span> New
    </a> 

    <a href="" id="show-switch" class="simulate-link font-weight-medium lead text-purple-pale px-2">
        <span class="iconify mr-1" data-icon="ant-design:swap-outline" data-inline="false"></span> Switch
    </a>

    @if(Auth::check() && Auth::user()->current_portfolio_id !== Auth::user()->main_portfolio_id)
        <a class="simulate-link font-weight-medium px-2 lead text-danger" href="/app/portfolios/close/{{Auth::user()->current_portfolio_id}}" onclick="return confirm('Are you sure you want to delete this portfolio?');">
            <span >
                <span class="iconify mr-1" data-icon="ant-design:delete-outline" data-inline="false"></span> Delete
            </span> 
        </a>
    @endif 

</div>
@endif

</div> 





