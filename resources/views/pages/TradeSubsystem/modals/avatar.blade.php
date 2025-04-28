@if(Request::segment(2) == 'settings')
<div id="avatar-crop-modal" class="modal fade" role="dialog">

    <button type="button" class="close" data-dismiss="modal"><i class="fal fa-times"></i></button>
    <div class="modal-dialog">


        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body">
                <h5 class="mb-4 font-weight-bold">Adjust image</h5>
                <div style="width: 100%;"> 
                    <img style="max-width: 100%;" id="avatar-image-cropping" src="{{ $settingsData['avatar'] }}">
                </div>
                <small class="d-block mt-3 text-grey">Use mouse wheel or pinch to zoom in or out.</small>
                <button type="button" class="btn btn-primary rotate-avatar mt-3"><i class="far fa-undo fa-flip-horizontal mr-2"></i> Rotate</button>   
            </div>
            <div class="modal-footer"> 
                
                <button type="button" class="btn btn-lg btn-white" data-dismiss="modal">Close</button>
                <button type="button" id="crop-avatar" class="btn btn-lg btn-primary">Save</button>
            </div>
        </div> 

    </div>
</div> 
@endif 