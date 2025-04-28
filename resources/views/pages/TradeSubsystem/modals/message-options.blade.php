<div id="messagesModal" class="modal fade" role="dialog">


<div class="modal-dialog modal-dialog-centered">

    <!-- Modal content-->
    <div class="modal-content">

        <div class="modal-body p-5">

        	<button type="button" class="close" data-dismiss="modal"><i class="fal fa-times"></i></button>

        	@if(!Auth::user()->blockedUsers->contains('blocked_user_id', $data['userId']))
			<a href="/app/block-user/{{$data['userId']}}" class="dropdown-item"><i class="far fa-user-slash mr-1"></i> <span class="d-none d-lg-inline-block">Block this user</span></a>
			@else
				<a href="/app/unblock-user/{{$data['userId']}}" class="dropdown-item"><i class="far fa-user mr-1"></i> <span class="d-none d-lg-inline-block">Unblock this user</span></a>
			@endif

			<a id="addcontact" class="dropdown-item" href="/app/blocked-users"><i class="far fa-user-slash mr-1"></i> <span>Blocked Users</span></a>
			<a id="settings" class="dropdown-item" href="/app/settings"><i class="fa fa-cog fa-fw" aria-hidden="true"></i> <span>Other Settings</span></a>



        </div>

    </div>

</div>
</div>