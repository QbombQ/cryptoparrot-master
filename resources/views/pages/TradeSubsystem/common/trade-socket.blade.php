
<div class="trade-item">
<div class="card card-small mb-3">
    <div class="card-body"> 

        <div class="feed-header">

            <a href="/{{$trade['handle']}}" class="feed-avatar">
            <img src="{{$trade['avatar']}}" alt="User Avatar">
            </a> 

            <div class="d-none d-lg-block float-lg-right text-right">
                <h4 class="mb-0 feed-trade-primary text-{{$trade['class']}}">
                {{$trade['amount']}} 
                @if($trade['status'] == 'Buy' || $trade['status'] == 'Sell')
                    <i data-toggle="tooltip" data-placement="top" title="" data-original-title="Order is awaiting to be filled" class="far fa-stopwatch text-muted"></i>
                @endif
                </h4>
                <span class="d-block feed-trade-secondary">{{$trade['status']}} @ {{$trade['target_price']}}</span>

                @if($trade['profit'] != '0.00')
                <small class="text-grey d-block feed-trade-tertiary">Profit/Loss: {{$trade['profit']}}</small>
                @else
                <small class="text-grey d-block feed-trade-tertiary">Total value: {{$trade['totalTradeValue']}}</small>
                @endif
            </div>

            <a href="/{{$trade['handle']}}">{{$trade['username']}}</a> 
            <small class="{{$trade['totalBalanceClass']}}">{{$trade['totalBalance']}}</small><br />

        
            <span class="text-light"> 


                    @if($trade['ownTrade'])

                        @if($trade['isPublic'] == 1)
                        <span data-toggle="tooltip" data-placement="top" title="" data-original-title="This trade is visibe to your paid followers only.">
                           <i class="far fa-lock-alt"></i>
                        </span>
                        @endif

                    @else

                        @if($trade['userCanSee']) 
                        <span data-toggle="tooltip" data-placement="top" title="" data-original-title="As a patron of this trader, their trades are visible to you ">
                            <i class="far fa-lock-open-alt"></i>
                        </span>
                        @else
                        <span data-toggle="tooltip" data-placement="top" title="" data-original-title="In order to see full details of this trade, become a patron of this trader">
                            <i class="far fa-lock-alt"></i>  
                        </span>
                        @endif

                    @endif 

                @if($trade['ownTrade'])

                    <form style="display: inline;" class="update-trade-visibility" action="/app/trades/update-visibility" method="post">
                        <input name="trade_id" type="hidden" value="{{$trade['id']}}">
                        <input name="public" type="hidden" value="{{$trade['isPublic']}}"> 
                                   
                        @if($trade['isPublic'] == 1)
                        <i class="far toggleTradeVisibility fa-eye"></i> 
                        @else
                        <i class="far toggleTradeVisibility fa-eye-slash"></i> 
                        @endif 
                    </form>

                @endif

                {{ $trade['date'] }}
            </span>



        </div> 

        <div class="d-lg-none mt-3">

                <div class="row">
                    <div class="col-sm-5 text-center text-sm-right feed-trade-bg d-flex pt-3 py-sm-3">
                        <h4 class="align-self-center w-100 mb-0 feed-trade-primary text-{{$trade['class']}}">{{$trade['amount']}} 
                        @if($trade['status'] == 'Buy' || $trade['status'] == 'Sell')
                        <i data-toggle="tooltip" data-placement="top" title="" data-original-title="Order is awaiting to be filled" class="far fa-stopwatch text-muted"></i>
                        @endif
                        </h4>  
                    </div>
                    <div class="col-sm-7 text-center text-sm-left feed-trade-bg pb-3 py-sm-3">
                        <span class="d-block feed-trade-secondary">{{$trade['status']}} @ {{$trade['target_price']}}</span>
                        @if($trade['profit'] != '0.00')
                        <small class="text-grey d-block feed-trade-tertiary">Profit/Loss: {{$trade['profit']}}</small>
                        @else
                        <small class="text-grey d-block feed-trade-tertiary">Total value: {{$trade['totalTradeValue']}}</small>
                        @endif
                    </div>
                </div>
 
        </div>


        @if($trade['userCanSee']) 

            @if($trade['isPublic'] == 0 && !$trade['ownTrade'])
                @if(!(Request::segment(1) == 'app'))
                <div class="p-5 text-center">
                    <p class="lead mb-0">The details of this trade are private.</p>
                </div>
                @endif
            @else 

                @if($trade['description'])
                    <!--<p class="lead mt-4 mb-0">{!! nl2br(e($trade['description'])) !!}</p>-->
                    <p class="lead trade-description mt-4 mb-0">{!! $trade['description'] !!}</p>
                @else
                    <div class="p-5 text-center">
                        <p class="lead mb-0">You have made this trade private.</p>
                    </div>
                @endif
 
            @endif


        @else


            @if($trade['isPublic'] == 0)
                @if(!(Request::segment(1) == 'app'))
                <div class="p-5 text-center">
                    <p class="lead">The details of this trade are private.</p>
                </div> 
                @endif 
            @endif


        @endif
  
    </div>


    @if($trade['userCanSee'] && ($trade['isPublic'] == 1 || $trade['ownTrade']))

        @if($trade['source_type'] == 'link')
            <a target="_blank" rel="nofollow noopener" href="{{$trade['source']['link']}}" class="">
            <img src="{{$trade['source']['og_image']}}" class="w-100" alt=""/>
            <div class="source-link p-3"> 
                 @if($trade['source']['meta_title']) <h6 class="mb-2">{{$trade['source']['meta_title']}}</h6> @endif
                <p class="mb-0 elipsis">{{$trade['source']['meta_description']}}</p>
            </div> 
            </a> 
        @elseif($trade['source_type'] == 'video')
            <div class="videoWrapper">{!! $trade['videoIframe'] !!}</div>
        @elseif($trade['source_type'] == 'trading_view')
            @if($trade['source']['trading_view_code'])
            
            <div id="trading_view_{{$trade['source']['trading_view_code']}}" data-trading-view="{{$trade['source']['trading_view_code']}}" class=""></div>

            @endif

        @elseif($trade['source_type'] == 'image')
            <img class="w-100" src="{{Storage::disk('public')->url('images/analysis/'.$trade['id'].'/'.$trade['source']['analysis_link'])}}">
        @else  
        @endif  

    @else


    @endif 

    <?php //print_r($trade);?>


    @if($trade['isPublic'])
    <div class="feed-actions p-3">

        <div class="row justify-content-center text-center">

            <div class="col-3 col-sm-4 px-0 text-right">
                <a href="" data-id="{{$trade['id']}}" class="d-block show-comments-button"><i class="far fa-comment-alt"></i> <span class="d-none d-sm-inline-block">Comment</span> ({{$trade['totalComments']}})</a>
            </div>
            <div class="col-3 col-sm-4 px-0">

                <a tabindex="0" data-placement="top" class="d-block popover-dismiss" role="button" data-toggle="popover" data-trigger="focus" data-comment="@if(!$trade['paidOnly']) {{ $trade['description'] }} @endif" data-link="{{url($trade['handle'].'/trade/'.$trade['id'])}}"><i class="far fa-share"></i> <span class="d-none d-sm-inline-block">Share</span></a>

            </div>  
            <div class="col-5 col-sm-4 px-0 text-left">
 
                @if(!$trade['voted'])
                    <a class="btn voteUp" data-current-votes="{{$trade['votes']}}" data-user-id="{{$trade['viewerId']}}" data-trade-id="{{$trade['id']}}">
                        <i class="fal fa-thumbs-up"></i>
                    </a>
                @endif
                <span class="votes votes-{{$trade['id']}}">@if($trade['votes']) {{ $trade['votes'] }} @else 0 @endif</span>
                @if(!$trade['voted'])
                    <a class="btn voteDown"  data-current-votes="{{$trade['votes']}}" data-user-id="{{$trade['viewerId']}}" data-trade-id="{{$trade['id']}}">
                       <i class="fal fa-thumbs-down"></i>
                    </a>
                @endif
            </div>
        </div> 


    </div> 
    @endif

    </div> 

    @if($trade['isPublic'])
    <div  class="ml-xl-5 mb-3">
            <form @if(count($trade['comments']) > 0 && (!Request::segment(2) || Request::segment(2) !== 'trade')) style="display: none" @endif method="post" class="commentForm" data-trade-id="{{$trade['id']}}" action="/app/post/trade-comment">
                @csrf
                <input type="hidden" name="trade_id" value="{{$trade['id']}}"/>
                <textarea name="comment" class="form-control" placeholder="Write a comment..."></textarea>
                <small style="font-weight: 700; color:#007bff;" class="comment-post-error"></small>
                <small>Press Enter to post.</small>
            </form>
    </div>
     
    
    <div class="ml-xl-5">
        <div @if(!Request::segment(2) || Request::segment(2) !== 'trade') style="display: none" @endif  id="comments-{{$trade['id']}}">

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
   