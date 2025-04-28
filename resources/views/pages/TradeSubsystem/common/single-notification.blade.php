<a href="{{ $notification['url'] }}">
    <div class="card mb-2">
    <div class="card-body">
        <div class="d-flex">
            <div class="icon-holder pr-3"><div class="notification-icon"><i class="far {{$notification['icon']}}"></i></div></div>
            <div class="notification-holder">
                <span class="notification__category font-weight-bold">@if($notification['status'] == 'unread')<i class="far fa-circle text-success mr-1"></i>@endif {{ $notification['title'] }}</span>
                <p class="mb-0 small">{{ $notification['text'] }}</p>
                <small class="text-muted d-block"> {{$notification['date']}}</small>
            </div>
            <div class="more-holder small align-self-center"><span class="view-notification no-wrap ml-3 font-weight-bold">View</span></div>
        </div>
    </div>
    </div>

</a> 