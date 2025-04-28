<div class="profile-header mb-3 mt-1 mb-lg-5">
<div class="py-3">
 
<div id="avatar-drop-area">        
    <div class="edit-user-details__avatar">
        <img src="{{ $settingsData['avatar'] }}" id="current-avatar" alt="User Avatar">
        <label class="edit-user-details__avatar__change">
        <i class="fas fa-cloud-upload-alt"></i>
        <input accept="image/jpeg, image/png" class="d-none" type="file" name="avatar" id="userProfilePicture" >  
        </label>
    </div> 
</div> 

<h1 class="h3 mb-1">{{ $settingsData['username'] }} 
</h1>

<p class="mb-0">

<span class="text-muted mr-2">{{ $settingsData['joined'] }}</span>

@if(count($settingsData['badges']) > 0)
    @foreach($settingsData['badges'] as $badge) 
     
        <span data-toggle="tooltip" data-placement="top" title="{{$badge['description']}}" class="mr-2">
            <span class="iconify lead" data-icon="ant-design:rocket-outline" data-inline="false" data-rotate="20deg"></span>
        </span>
    
    @endforeach   
@endif 


</p>  

</div>  
</div> 

<form id="updateProfileForm" method="post" action="/app/settings/profile">
<div class="row">
    <div class="col-md-4 mt-3 mt-lg-0">
        <p class="text-purple-pale font-weight-medium mb-2">Username</p>
        <input type="text" placeholder="Username" class="form-control form-control-lg" name="username" id="username" value="{{ $settingsData['username'] }}"> 
    </div>
    <div class="col-md-4 mt-3 mt-lg-0">
        <p class="text-purple-pale font-weight-medium mb-2">Location</p>
        <input type="text" placeholder="Location" class="form-control form-control-lg" name="location" value="{{ $settingsData['location'] }}">
    </div>
    <div class="col-md-4 mt-3 mt-lg-0">
         <p class="text-purple-pale font-weight-medium mb-2">Email</p>
        <input type="email" placeholder="Email" class="form-control form-control-lg" name="email" value="{{ $settingsData['email'] }}" id="emailAddress"> 
    </div>
    <div class="col-12 mt-3 mb-lg-4">
         <p class="text-purple-pale font-weight-medium mb-2">Bio</p>
        <textarea placeholder="Bio" style="min-height: 87px;" id="userBio" name="description" class="mb-3 form-control form-control-lg">{{ $settingsData['description'] }}</textarea>
    </div> 
    <div class="col-xl-7 d-flex">


        <label for="directMessagesToggle" class="d-lg-flex"> 
            <span class="lead no-wrap align-self-center pr-4 font-weight-medium">Direct messages</span>
            <small class="form-text text-muted align-self-center pr-4"> If selected, you will be able to receive messages from any {{ env('APP_NAME') }} user even if you do not follow them.</small> 
        </label>
        <div class="custom-control no-offset custom-toggle ml-auto my-auto">
            <input type="hidden" name="notifications[direct_messages]" value="off"/>
            <input type="checkbox" id="directMessagesToggle" name="notifications[direct_messages]" class="custom-control-input" @if($settingsData['notifications'] && $settingsData['notifications']->direct_messages) checked @endif>
            <label class="custom-control-label" for="directMessagesToggle"></label>
        </div>
 
    </div> 
    <div class="col-xl-5 text-lg-right pt-3">
        <button type="submit" class="btn btn-primary btn-lg mb-2">Save Changes</button>
        @if(Auth::user()->status == 'unconfirmed')
            <button id="resend" class="btn btn-primary btn-lg mb-2">Resend confirmation link</button>
        @endif
    </div>
</div>
</form> 


  