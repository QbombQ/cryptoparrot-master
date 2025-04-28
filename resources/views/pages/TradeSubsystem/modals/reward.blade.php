<div id="rewardModal" class="modal fade" role="dialog">

    <div class="modal-dialog modal-dialog-centered">

        <!-- Modal content-->
        <div class="modal-content">

            <div class="modal-body p-5">

    			<button type="button" class="close" data-dismiss="modal"><i class="fal fa-times"></i></button>

                <h5 class="mb-4 font-weight-bold">Order Summary</h5>
                
                <div style="background: #f7f7f7;" class="card mb-4">
                    <div class="card-body">

                        <p><strong>Reward:</strong> <span id="reward-popup-title">Nano Ledger X</span></p>

                        <p class="mb-0"><strong>Instructions:</strong> <span id="additional-reward-info-popup">3 sizes are available - M, L, XL. Please provide your size in additional information input.</span></p> 

                    </div>
                </div>   

                <h5 class="mb-4 font-weight-bold">Shipping Address</h5>

                <div class="row">

                    <div class="col-12">

                        <form action="/app/rewards/buy/" method="post" id="reward-order-form">
                            @csrf
                            <div class="form-group">
                                <input class="form-control" name="full_name" placeholder="Full name" required/>
                            </div>
                            <div class="form-group">
                                <input class="form-control" name="address_line_1" placeholder="Address line 1" required/>
                            </div>
                            <div class="form-group">
                                <input class="form-control" name="address_line_2" placeholder="Address line 2"/>
                            </div>

                            <div class="row">

                            <div class="form-group col-md-6">
                                <input class="form-control" name="city" placeholder="City" required/>
                            </div>
                            <div class="form-group col-md-6">
                                <input class="form-control" name="state" placeholder="County/State" required/>
                            </div>

                            </div>

                            <div class="row">

                            <div class="form-group col-md-6">
                                <input class="form-control" name="country" placeholder="Country" required/>
                            </div>
                            <div class="form-group col-md-6">
                                <input class="form-control" name="postcode" placeholder="Postcode" required/>
                            </div>

                            </div>

                            <div class="form-group">
                                <textarea class="form-control" name="additional_info" placeholder="Additional Information"></textarea>    
                            </div>

                            <div class="form-group">
                                <input type="checkbox" class="" name="accept" required/>
                                Accept <a target="_blank" href="/tos#rewards">terms and conditions</a>
                            </div>
                            <button id="complete-reward-order" class="btn btn-primary btn-lg btn-block mt-2" type="submit">
                                Claim Reward
                            </button>
                        </form>

                        <p class="reward-order-errors mt-4 mb-0"></p>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div> 