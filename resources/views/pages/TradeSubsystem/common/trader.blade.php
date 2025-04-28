<div class="col-6 col-sm-12 col-md-4 col-lg-3 col-xl-2 mb-4">

    <div class="card h-100 card-hover card-leader">
    <div class="card-body text-center">
    
    <a class="leader-avatar" href="/{{$trader['handle']}}">
        <div class="position-relative">
        <span class="leader-rank font-weight-medium">{{$trader['iteration']}}</span>
        <img class="rounded-circle mw-100" src="{{ $trader['avatar'] }}" alt="User Avatar">
        </div>
    </a>

    <p class="mb-0 font-weight-bold leader-info mt-3">
        <a href="/{{$trader['handle']}}" class="smaller ellipsis">
            {{ $trader['username'] }}
        </a>
    </p>  

    <div class="leader-stats">
        <p class="mb-0 text-purple-pale">{{$trader['tradesCount']}} Trades</p>
        <p class="mb-0 {{$trader['increaseClass']}}"> 
            {{$trader['increaseInPercents']}}
        </p>

        @if(Auth::check() && Auth::id() !== $trader['userId'])
        @if($trader['alreadyFollow'])
            <a href="/app/unfollow/{{$trader['userId']}}" class="btn btn-dark mx-auto follow-unfollow-button unfollow-button">
                Unfollow
            </a>
        @else  
            <a href="/app/follow/{{$trader['userId']}}" class="btn btn-secondary mx-auto follow-unfollow-button follow-button">
                Follow
            </a>
        @endif
        @else
            @if(Auth::check() && Auth::id() == $trader['userId'])
            <a href="/{{ $commonUserData['handle'] }}" class="btn btn-secondary mx-auto">
                My profile
            </a>
            @endif
        @endif  

    </div>
    </div>
    </div>
            
</div>           

   
