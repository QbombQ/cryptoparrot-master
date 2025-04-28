    <div class="mb-3">

       
        <div class="comment-container reply-container">

             <div class="comment-avatar">                            
                <img class="w-100 user-avatar rounded-circle mr-2 mb-2" src="{{$reply['avatar']}}" alt="User Avatar">
            </div>
 

            <div class="comment-box p-3 mb-1">
                <a href="/{{$reply['authorHandle']}}"><strong class="pr-2">{{$reply['authorUsername']}}</strong></a>  <span class="comment-text">{!!$reply['comment']!!}</span>

                @if(isset($reply['gif']))


                    <div class="gif-image-comment mt-3">
                        <img src="https://media.giphy.com/media/{{ $reply['gif'] }}/giphy.gif">
                        <div class="giphy-attribution-holder">

                        <a href="https://media.giphy.com/media/{{ $reply['gif'] }}/giphy.gif" class="giphy-attribution" target="_blank" rel="nofollow"><img src="/assets/images/giphy.png"  alt=""></a>
                        </div>
                    </div>
        

                @endif

                <div class="comment-meta text-muted mt-2 pt-2 d-flex">

                    <span class="pr-2">{{$reply['date']}}</span> 
                
                    <div class="ml-auto">


                        <span class="votes-comments-{{$reply['id']}}">{{ $reply['votes'] }}</span>

                        @if(!$reply['voted'] && Auth::check())
                            <a class="voteUpComment" data-current-votes="{{$reply['votes']}}" data-user-id="{{Auth::id()}}" data-comment-id="{{$reply['id']}}" style="">
                                <span class="iconify lead" data-icon="ant-design:heart-outline" data-inline="false"></span>
                            </a>
                        @endif
                        @if($reply['voted'] && Auth::check())
                            <a class="voteDownComment"  data-current-votes="{{$reply['votes']}}" data-user-id="{{Auth::id()}}" data-comment-id="{{$reply['id']}}" style="">
                                <span class="iconify lead" data-icon="ant-design:heart-fill" data-inline="false"></span>
                            </a>
                        @endif 

                    </div>

                </div>

            </div>

           

        </div>   

    </div> 
