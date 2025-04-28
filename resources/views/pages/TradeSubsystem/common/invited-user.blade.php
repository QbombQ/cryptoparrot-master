<div class="pb-2 portfolio-item d-flex">
    <img src="{{$invitedUser['avatar']}}" class="rounded-circle mr-3" style="width: 50px;">
    <h6 class="mb-0 flex-grow align-self-center w-100">{{$invitedUser['username']}}
        <span class="float-right font-weight-bold">
            @if($invitedUser['verified'])
                <i class="fas fa-check text-success mr-2"></i> Verified 
            @else
                <i class="fas fa-times text-danger  mr-2"></i> Verified 
            @endif
            @if($invitedUser['hasTrades'])
                <i class="fas fa-check text-success ml-3 mr-2"></i> 1st trade
            @else
                <i class="fas fa-times text-danger  ml-3 mr-2"></i> 1st trade 
            @endif            
        </span>
    </h6>
</div>   