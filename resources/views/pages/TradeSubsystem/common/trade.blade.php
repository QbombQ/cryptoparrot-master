@php

$card_class = 'mb-3'; 

@endphp 
 
<div class="trade-item mb-3" id="trade-item-{{$trade['id']}}">
<div class="card card-small {{$card_class}}">
    <div class="card-body pt-4 px-4 pb-2 p-sm-4">

        <div class="feed-header">

            <div class="row">
                <div class="col-sm-7">   

                    <div class="position-relative feed-summary">

                    <a href="/{{$trade['handle']}}" class="feed-avatar mr-3">
                        <img src="{{$trade['avatar']}}" class="avatar" alt="User Avatar">
                        @if($trade['hasTraderBadge']) 
                        <!--<img class="feed-trader-badge" src="{{ asset('assets/images/badges/bg-trader.png') }}">-->
                        @endif
                    </a> 

                    <a href="/{{$trade['handle']}}" class="username">{{$trade['username']}}</a> 

                    <span data-toggle="tooltip" data-placement="top" title="" data-original-title="@if($trade['isMainPortfolio']) Main portfolio @else Alternative portfolio: {{$trade['portfolioName']}} @endif" class="alt-portfolio {{$trade['totalBalanceClass']}}">@if($trade['isMainPortfolio']) @else <i class="fas fa-dot-circle"></i> @endif {{$trade['portfolioValue']}}</span> <br/>

                    <span class="text-muted"> 



                    @if($trade['ownTrade'])

                        <form style="display: inline;" class="update-trade-visibility" action="/app/trades/update-visibility" method="post">
                            <input name="trade_id" type="hidden" value="{{$trade['id']}}">
                            <input name="public" type="hidden" value="{{$trade['isPublic']}}"> 
                        
                            @if($trade['isPublic'] == 1)
                            <i class="far toggleTradeVisibility fa-eye" data-toggle="tooltip" data-placement="top" title="This trade is public"></i> 
                            @else
                            <i class="far toggleTradeVisibility fa-eye-slash" data-toggle="tooltip" data-placement="top" title="This trade is private"></i> 
                            @endif 
                        </form>

                    @endif

                    {{ $trade['date'] }}

                    </span>

                    </div>

                   
                </div>
                <div class="col-sm-5 pt-3 pt-sm-0"> 
                    <div class="text-sm-right trade-info trade-text-{{$trade['class']}}">
                        <h4 class="mb-0 feed-trade-primary text-{{$trade['class']}}">
                        {!! $trade['amount'] !!}
                        @if($trade['status'] == 'Buy' || $trade['status'] == 'Sell')
                        <i data-toggle="tooltip" data-placement="top" title="" data-original-title="Order is awaiting to be filled" class="far fa-stopwatch text-muted"></i>
                        @endif
                        </h4>


                        <span class="d-block feed-trade-secondary">{{$trade['status']}} @ {{$trade['target_price']}}</span>

                        <!--
                        @if($trade['profit'] != '0.00')
                        <small class="text-grey d-block feed-trade-tertiary">Profit/Loss: {{$trade['profit']}}</small>
                        @else
                        <small class="text-grey d-block feed-trade-tertiary">Total value: {{$trade['totalTradeValue']}}</small>
                        @endif
                        --> 

                    </div>   
                </div>

                <div class="col-12">

                    <!-- description -->
                     @if($trade['userCanSee']) 

                        @if($trade['isPublic'] == 0 && !$trade['ownTrade'])
                            @if(!(Request::segment(1) == 'app') && !$socket)
                            <p class="lead text-light trade-description mt-4 mb-3">The details of this trade are private.</p>
                           
                            @endif 
                        @else 

                            @if($trade['description'])
                                <!--<p class="lead mt-4 mb-0">{!! nl2br(e($trade['description'])) !!}</p>-->
                                <p class="lead trade-description mt-4 mb-4">{!! $trade['description'] !!}</p>
                            @else  
                                <p class="lead trade-description text-light mt-4 mb-0">This trade has no description</p>
                    
                            @endif
             
                        @endif

                    @else 

                
                        @if($trade['isPublic'] == 0 && !(Request::segment(1) == 'app') && !$socket)

                            <p class="lead text-light trade-description mt-4 mb-0">The details of this trade are private.</p>

                        @endif 


                    @endif 

                    @if($trade['userCanSee'] && ($trade['isPublic'] == 1 || $trade['ownTrade']))

                        @if($trade['source_type'] == 'link')

                            <a target="_blank" rel="nofollow noopener" href="{{$trade['source']['link']}}" class="">
                            @if($trade['source']['og_image'])
                                <img src="{{$trade['source']['og_image']}}" class="w-100" alt=""/>
                            @endif
                            <div class="source-link p-3"> 
                                @if($trade['source']['meta_title']) <h6 class="mb-2">{{$trade['source']['meta_title']}}</h6> @endif
                                <p class="mb-0 elipsis">{!!html_entity_decode($trade['source']['meta_description'], ENT_QUOTES)!!}</p>
                            </div>
                            </a> 

                        @elseif($trade['source_type'] == 'video')
                            <div class="videoWrapper">{!! $trade['videoIframe'] !!}</div>
                        @elseif($trade['source_type'] == 'trading_view')
                            @if($trade['source']['trading_view_code'])
                            
                            <div id="trading_view_{{$trade['source']['trading_view_code']}}" data-trading-view="{{$trade['source']['trading_view_code']}}" class=""></div>

                            @endif

                        @elseif($trade['source_type'] == 'image')
                            <a target="_blank" rel="nofollow" href="{{Storage::disk('public')->url('images/analysis/'.$trade['id'].'/'.$trade['source']['analysis_link'])}}"><img class="w-100" src="{{Storage::disk('public')->url('images/analysis/'.$trade['id'].'/'.$trade['source']['analysis_link'])}}"></a>
                        @else   
                        @endif  

                    @else


                    @endif    

    

                </div>

            </div>
 
            <hr class="mb-0 mt-2 mt-sm-4">

            <?php //print_r($trade);?>

            


        </div> 

   
  
    </div> 
    
    <?php //print_r($trade);?>

    <div class="px-4 pb-4">   

    @if($trade['userCanSee'])
        <div class="feed-actions d-flex">

               
                    <a href="" data-id="{{$trade['id']}}" class="d-block show-comments-button lead pr-2"><span class="iconify" data-icon="ant-design:message-outline" data-inline="false"></span> {{$trade['totalComments']}}</a>
           
                    <a tabindex="0" data-placement="top" class="d-block popover-dismiss lead" role="button" data-toggle="popover" data-trigger="focus" data-comment="{{ strip_tags($trade['description']) }}" data-link="{{url($trade['handle'].'/trade/'.$trade['id'])}}"><span class="iconify" data-icon="ant-design:share-alt-outline" data-inline="false"></span></a> 

        
                    <div class="ml-auto lead">
                    @if((!$trade['voted'] && Auth::check()) || (!$trade['voted'] && $socket))
                        <a class="p-0 btn voteUp lead" data-current-votes="{{$trade['votes']}}" data-user-id="{{Auth::id()}}" data-trade-id="{{$trade['id']}}">
                            <span class="iconify" data-icon="ant-design:heart-outline" data-inline="false"></span>
                        </a>
                    @endif
                    @if(($trade['voted'] && Auth::check()) || ($trade['voted'] && $socket))
                        <a class="p-0 btn voteDown lead"  data-current-votes="{{$trade['votes']}}" data-user-id="{{Auth::id()}}" data-trade-id="{{$trade['id']}}">
                            <span class="iconify" data-icon="ant-design:heart-outline" data-inline="false"></span>
                        </a>
                    @endif                
                    <span class="votes votes-{{$trade['id']}}">{{ $trade['votes'] }} </span>
                    Likes
                    </div>



           
        </div> 
    @endif

    </div>


</div> 




    @if($trade['userCanSee'])
    <div class="@if(Request::segment(2) && Request::segment(2) == 'trade') modal-comments @else  @endif px-0 px-lg-0 @if(!count($trade['comments'])) mb-3 @endif mt-1">
        @if(Auth::check() || $socket)
            <div class="reply-block" @if(!count($trade['comments'])) style="display: none;" @endif >

            <a href="/{{$commonUserData['handle']}}" class="reply-avatar mr-3">
                <img src="{{ $commonUserData['avatar'] }}" class="avatar" alt="User Avatar">
            </a>  

            <form @if(count($trade['comments']) > 0 && (!Request::segment(2) || Request::segment(2) !== 'trade')) style="display: block" @endif method="post" class="commentForm" data-trade-id="{{$trade['id']}}" action="/app/post/trade-comment">
                @csrf

                <div class="position-relative">
                <input type="hidden" name="trade_id" value="{{$trade['id']}}"/>
                <input type="hidden" name="gif" value=""/>      
                <textarea name="comment" class="form-control" placeholder="Write a comment..."></textarea>
                <div class="d-flex">
                <small style="font-weight: 700; color:#007bff;" class="comment-post-error"></small>
                <a href="" class="gif-modal gif-modal-comments" data-toggle="modal" data-target="#gif-modal"><span class="iconify" data-icon="ant-design:gif-outlined" data-inline="false"></span></a>
                <span class="ml-auto small font-weight-bold text-light">Press Enter to post.</span>
                </div>
                </div>  

                <div class="gif-holder mt-3 d-none">
                <div class="gif-image">
                </div> 
                <div class="align-self-start">
                <a href="" class="remove-gif lead ml-2 link">
                <i class="fad fa-times-circle"></i>
                </a> 
                </div>
                </div>

            </form> 
            </div>
        @else 

           

        @endif
    </div>
     
    
    <div class="@if(Request::segment(2) && Request::segment(2) == 'trade') modal-comments @elseif(!count($trade['comments']))  @else  @endif">
        <div @if(!Request::segment(2) && Request::segment(2) !== 'trade' && !count($trade['comments'])) style="display: none" @endif  id="comments-{{$trade['id']}}">
 
            @if(!Auth::check() && !$socket)

                <div class="card card-small mt-3">
                    <div class="card-body pt-4 px-4 pb-2 p-sm-4">
                        <div class="p-3 text-center">
                            <p class="lead">In order to post comments please login or register.</p>
                            <a href="/login" class="btn btn-lg btn-outline-dark mr-2">Login</a>
                            <a href="/signup" class="btn btn-primary btn-lg mr-2">Signup</a>
                        </div>
                    </div>
                </div>

            @endif 

            @if(count($trade['comments']) > 0)
                @php $comments = $trade['comments']; $tradeId = $trade['id']; @endphp
                <div id="comments-{{$trade['id']}}-wrapper">
                    @include('pages/TradeSubsystem/common/comments')
                </div>
                @if($trade['hasMoreComments'])
                    <a data-page="2" data-trade-id="{{$trade['id']}}" class="pl-5 load-more-comments d-block mb-3">Load more comments...</a>
                @endif
            @endif
        </div>
    </div>
    @endif
    
</div>
   