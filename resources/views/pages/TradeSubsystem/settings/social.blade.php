<form id="updateSocialLinksForm" method="post" action="/app/settings/social">
  
    <div class="row">
    <div class="col-xl-12">
        <h4 class="form-text m-0 font-weight-bold">Social links</h4>
        <p class="form-text text-muted mb-4">Allow others to find you on social media.</p>
    </div>
    <div class="col-md-6 ">
        <p class="text-purple-pale font-weight-medium mb-2">Facebook</p>
        <input type="text" class="form-control form-control-lg" name="social[facebook]" id="socialFacebook" value="@if($settingsData['facebook']) {{ $settingsData['facebook'] }} @endif">
    </div>
    <div class="col-md-6 mt-3 mt-md-0">
        <p class="text-purple-pale font-weight-medium mb-2">Twitter</p>
        <input type="text" class="form-control form-control-lg" name="social[twitter]" id="socialTwitter" value="@if($settingsData['twitter']) {{ $settingsData['twitter'] }} @endif">
    </div>
    <div class="col-xl-12 text-md-right pt-3">
        <button type="submit" class="btn btn-primary btn-lg mt-2 mt-lg-4">Save Changes</button>
    </div>
    </div>
    
</form>    
