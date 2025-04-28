
<form id="updateNotificationsForm" method="post" action="/app/settings/notifications">
    
    


    <div class="row">
        <div class="col-xl-12">
            <h4 class="form-text m-0 font-weight-bold">Notifications</h4>
            <p class="form-text text-muted mb-4">{{ $settingsData['username'] }} you’re the boss of your account. Choose which notifications you want to receive.</p>
        </div>
        <div class="col-xl-6 d-flex">

            <label for="tradeOrdersToggle" class="align-self-center lead font-weight-medium pr-4"> Trade Orders
            <small class="form-text text-muted"> Receive a notification once your active order has been executed. </small>
            </label> 

            <div class="custom-control no-offset custom-toggle ml-auto align-self-center">
                <input type="hidden" name="notifications[trade_orders]" value="off"/>
                <input type="checkbox" id="tradeOrdersToggle" name="notifications[trade_orders]" class="custom-control-input" @if($settingsData['notifications'] && $settingsData['notifications']->trade_orders) checked @endif>
                <label class="custom-control-label" for="tradeOrdersToggle"></label>
            </div>

        </div>

        <div class="col-xl-6 d-flex">

            <label for="commentsToggle" class="align-self-center lead font-weight-medium pr-4"> Comments
            <small class="form-text text-muted"> Receive a notification when a comment is made on your trade.</small>
            </label>

            <div class="custom-control no-offset custom-toggle ml-auto align-self-center">
                <input type="hidden" name="notifications[comments]" value="off"/>
                <input type="checkbox" id="commentsToggle" name="notifications[comments]" class="custom-control-input" @if($settingsData['notifications'] && $settingsData['notifications']->comments) checked @endif>
                <label class="custom-control-label" for="commentsToggle"></label>
            </div>

        </div>
        <div class="col-xl-6 d-flex">

            <label for="newslettersToggle" class="align-self-center lead font-weight-medium pr-4"> Newsletters
            <small class="form-text text-muted"> Receive occasional newsletters about {{ env('APP_NAME') }} updates, changes and other exciting news.</small>
            </label>

            <div class="custom-control no-offset custom-toggle ml-auto align-self-center">
                <input type="hidden" name="notifications[newsletters]" value="off"/>
                <input type="checkbox" id="newslettersToggle" name="notifications[newsletters]" class="custom-control-input" @if($settingsData['notifications'] && $settingsData['notifications']->newsletters) checked @endif>
                <label class="custom-control-label" for="newslettersToggle"></label>
            </div>

        </div>
        <div class="col-xl-6 d-flex">

            <label for="votesToggle" class="align-self-center lead font-weight-medium pr-4"> Votes
            <small class="form-text text-muted"> Receive a notification when someone votes up/down your trade</small>
            </label>

            <div class="custom-control no-offset custom-toggle ml-auto align-self-center">
                <input type="hidden" name="notifications[votes]" value="off"/>
                <input type="checkbox" id="votesToggle" name="notifications[votes]" class="custom-control-input" @if($settingsData['notifications'] && $settingsData['notifications']->votes) checked @endif>
                <label class="custom-control-label" for="votesToggle"></label>
            </div>

        </div>
        <div class="col-xl-6 d-flex">

            <label for="signalsToggle" class="align-self-center lead font-weight-medium pr-4"> Signals
            <small class="form-text text-muted"> Receive important information that can help you with your trading actions Trust us when we say... these notifications are worth it.</small>
            </label>

            <div class="custom-control no-offset custom-toggle ml-auto align-self-center">
                <input type="hidden" name="notifications[signals]" value="off"/>
                <input type="checkbox" id="signalsToggle" name="notifications[signals]" class="custom-control-input" @if($settingsData['notifications'] && $settingsData['notifications']->signals) checked @endif>
                <label class="custom-control-label" for="signalsToggle"></label>
            </div>

        </div>
        <div class="col-xl-6 d-flex">

            <label for="newFollowsToggle" class="align-self-center lead font-weight-medium pr-4"> New Follows
            <small class="form-text text-muted">Receive a notification when someone follows you.</small>
            </label>

            <div class="custom-control no-offset custom-toggle ml-auto align-self-center">
                <input type="hidden" name="notifications[new_follows]" value="off"/>
                <input type="checkbox" id="newFollowsToggle" name="notifications[new_follows]" class="custom-control-input" @if($settingsData['notifications'] && $settingsData['notifications']->new_follows) checked @endif>
                <label class="custom-control-label" for="newFollowsToggle"></label>
            </div>

        </div> 
        <div class="col-xl-12 text-lg-right pt-0">
            <button type="submit" class="btn btn-primary btn-lg mt-4">Save Changes</button>
        </div>
    </div> 

                                
    
    
</form>
