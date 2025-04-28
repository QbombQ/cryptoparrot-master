<div class="comment">

    <div class="mb-3">

       
        <div class="comment-container comment-container-parent"> 

             <div class="comment-avatar d-none d-sm-block">                            
                <img class="user-avatar rounded-circle w-100" src="{{$comment['avatar']}}" alt="User Avatar">
            </div>


            <div class="comment-box p-3 mb-1">

                <a href="/{{$comment['authorHandle']}}"><img class="d-inline-block d-sm-none user-avatar-sm rounded-circle mr-1" src="{{$comment['avatar']}}" alt="User Avatar"> <strong class="pr-2">{{$comment['authorUsername']}}</strong></a>  <span class="comment-text font-weight-medium">{!!$comment['comment']!!}</span>


                @if(isset($comment['gif']))


                    <div class="gif-image-comment mt-3">
                        <img src="https://media.giphy.com/media/{{ $comment['gif'] }}/giphy.gif">
                         <div class="giphy-attribution-holder">
                        <a href="https://media.giphy.com/media/{{ $comment['gif'] }}/giphy.gif" class="giphy-attribution" target="_blank" rel="nofollow"><img src="/assets/images/giphy.png"  alt=""></a>
                    </div>
                    </div>
        

                @endif

                <div class="comment-meta text-muted mt-2 pt-2 d-flex">


                    <a href="" data-id="{{$comment['id']}}" class="comment-reply"><span class="iconify lead" data-icon="ant-design:message-outline" data-inline="false"></span></a>

                    <span class="px-2">{{$comment['date']}}</span> 
                
                    <div class="ml-auto">
                     <span class="votes-comments-{{$comment['id']}}">{{ $comment['votes'] }}</span>
                    @if(!$comment['voted'] && Auth::check())
                        <a class="voteUpComment" data-current-votes="{{$comment['votes']}}" data-user-id="{{Auth::id()}}" data-comment-id="{{$comment['id']}}" style="">
                            <span class="iconify lead" data-icon="ant-design:heart-outline" data-inline="false"></span>
                        </a>
                    @endif 
                    @if($comment['voted'] && Auth::check())
                        <a class="voteDownComment"  data-current-votes="{{$comment['votes']}}" data-user-id="{{Auth::id()}}" data-comment-id="{{$comment['id']}}" style="">
                            <span class="iconify lead" data-icon="ant-design:heart-fill" data-inline="false"></span>
                        </a>
                    @endif
                    </div>

                </div>

            </div> 

           <!--- -->

           <div class="">  
            <div id="replies-{{$comment['id']}}">
                <div id="replies-{{$comment['id']}}-wrapper">
                    @php $replies = $comment['replies']; @endphp
                    @include('pages/TradeSubsystem/common/replies')
                </div> 
                <div class="d-flex w-100 comment-container">
                    @if($comment['hasMore'])
                        <a data-comment-id="{{$comment['id']}}" class="load-all-replies mb-3 d-block">Load replies</a>
                    @endif
                    @if($replies)
                    <a href="" data-id="{{$comment['id']}}" class="text-right text-muted comment-reply mb-0 ml-auto"><span class="d-none d-md-inline-block">Reply to this thread</span> <i class="fas fa-reply"></i></a>
                    @endif
                </div>  
            </div> 
            @php
                if(isset($tradeId)) {
                    $action = '/app/post/trade-comment';
                }else{
                    $action = '/app/post/article-comment';
                }
            @endphp
            @if(Auth::check())

                @if($commonUserData)
 
                <div style="display: none" class="reply-block">

                <a href="/{{$commonUserData['handle']}}" class="reply-avatar mr-3">
                    <img src="{{ $commonUserData['avatar'] }}" class="avatar" alt="User Avatar">
                </a>   

                <form method="post" data-reply-id="{{$comment['id']}}" class="commentForm mb-2" action="{{$action}}">
                    @csrf

                    <div class="position-relative">

                    <input type="hidden" name="reply_to" value="{{$comment['id']}}"/>
                    <input type="hidden" name="gif" value=""/>
                    @if(isset($tradeId)) 
                        <input type="hidden" name="trade_id" value="{{$tradeId}}"/>
                    @else
                        <input type="hidden" name="article_id" value="{{$articleId}}"/>
                    @endif

                    <textarea name="comment" class="form-control" placeholder="Write a reply"></textarea>
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

                @endif

            @endif
     
        </div>  

        </div>   

    </div> 

         

    
</div>