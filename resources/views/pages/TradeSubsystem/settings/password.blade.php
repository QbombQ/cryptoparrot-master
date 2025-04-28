@if(Auth::user()->method == 'email')

<form id="updatePasswordForm" method="post" action="/app/settings/password">

    <div class="row">
    <div class="col-xl-12 mb-4">
        <h4 class="form-text m-0 font-weight-bold">Change Password</h4>
    </div>
    <div class="col-md-4">
        <p class="text-purple-pale font-weight-medium mb-2">Current Password</p>
        <input type="password" class="form-control form-control-lg" id="old_password" name="old_password" placeholder="Current password">
    </div>
    <div class="col-md-4 mt-3 mt-md-0">
        <p class="text-purple-pale font-weight-medium mb-2">New Password</p>
        <input type="password" class="form-control form-control-lg" id="new_password" name="new_password" placeholder="New Password">
    </div>
    <div class="col-md-4 mt-3 mt-md-0">
        <p class="text-purple-pale font-weight-medium mb-2">Repeat New Password</p>
        <input type="password" class="form-control form-control-lg" id="re_new_password" name="new_password_confirmation" placeholder="Re-enter New Password">
    </div>
    <div class="col-xl-12 text-md-right pt-3">
        <button type="submit" class="btn btn-primary btn-lg">Change Password</button> 
    </div>
    </div>

</form>

@else

<div class="row">
    <div class="col-xl-12">

        <p class="mb-0"> You are using <span class="text-capitalize">{{Auth::user()->method}}</span> authentication therefore you have no password to change.</p>

    </div>
</div>

@endif
