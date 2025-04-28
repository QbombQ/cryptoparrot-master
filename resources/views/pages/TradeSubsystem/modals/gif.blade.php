@if(Auth::check())
<div id="gif-modal" class="modal fade" role="dialog">

   
    <div class="modal-dialog modal-dialog-centered modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body p-4 p-lg-5">


        		<button type="button" class="close" data-dismiss="modal"><i class="fal fa-times"></i></button>

        		<input type="" class="form-control " id="search-giphy" placeholder="Search Giphy" name="">
        		<div class="mb-3 text-right"><a href="https://giphy.com/" class="giphy-attribution" target="_blank" rel="nofollow"><img src="/assets/images/giphy.png"  alt=""></a></div>

            	<div class="gif-grid"></div>

            </div>
        </div> 

    </div>
</div> 
@endif  