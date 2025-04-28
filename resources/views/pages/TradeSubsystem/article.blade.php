@extends('pages.TradeSubsystem.layout', 
[
    'title' => $article['meta_title'],
    'classes' => '',
     'html_class' => '',
    'description' => $article['meta_description'],
    'nofollow'=>false,
	'poster' => ($article['thumbnail']) ? $article['thumbnail'] : 'assets/images/niffler-og.jpg'
])
 
@section('main')

    @parent

    @section('styles')
        @parent  
        <link rel="stylesheet" href="{{ asset('assets/css/TradeSubsystem/feed.css') }}"> 
        <link rel="stylesheet" href="{{ asset('assets/css/TradeSubsystem/article.css') }}"> 
    @endsection  

    @section('content')

        @if(isset($currentFilters))
            <script>var currentFilter = @json($currentFilters);</script>
        @endif


        <div class="wrapper">

            <div class="sidebar">
                @include('pages.TradeSubsystem.common.sidebar') 
            </div>
            <div class="main main-article">

                <div class="shade"></div>
                
                @include('pages.TradeSubsystem.common.header') 

                <main class="main-content pt-3 pt-lg-5 pb-5">
                  <div class="px-3 px-lg-5 single-post-wrap">

                    <div id="messages-col">
                    </div> 
                    @if (session('message'))
                        <div class="alert alert-danger mb-3">
                            {{ session('message') }}
                        </div>
                    @endif 

                    @php
                        $articleUrl = $article['url'] ? $article['url'] : '/news/' . $article['slug'];
                        $articleUrlShare = $article['url'] ? $article['url'] : asset('').'news/' . $article['slug'];
                        $noFollow = $article['url'] ? true : false;
                    @endphp

                    <div class="row justify-content-center">
                    <div class="col-lg-1 text-center order-2 order-lg-1">
                        
                        <div class="ssk-group">
                            

                            <div class="row pb-5 pb-lg-0">

                            <div class="col col-lg-12 d-flex">

                            <a rel="nofollow" target="_blank" href="https://twitter.com/intent/tweet?text={{$article['title']}}&url={{$articleUrlShare}}" class="align-self-center text-purple ssk ssk-twitter d-block mb-sm-2 mx-auto"><i class="fab fa-twitter"></i></a>

                            </div>

                            <div class="col col-lg-12 d-flex">
                            <a rel="nofollow" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{$articleUrl}}" class="align-self-center text-purple ssk ssk-facebook d-block mb-sm-2 mx-auto"><i class="fab fa-facebook"></i></a>
                            </div>

                            <div class="col col-lg-12 d-flex">
                            <a rel="nofollow" target="_blank" href="https://www.linkedin.com/sharing/share-offsite/?url={{$articleUrl}}" class="align-self-center text-purple ssk ssk-facebook d-block mb-sm-2 mx-auto"><i class="fab fa-linkedin"></i></a>
                            </div>


                            <div class="col col-lg-12 d-flex">
                            <a rel="nofollow" target="_blank" href="whatsapp://send?text={{$articleUrl}}" class="align-self-center ssk text-purple ssk-facebook d-block mb-sm-2 mx-auto"><i class="fab fa-whatsapp"></i></a>
                            </div> 

                            </div>

                        </div>

                    </div>
                    <div class="order-1 order-lg-2 col-12 col-xl-8 col-lg-8 col-md-12 col-sm-12 mb-4">

                    <div class="bg-white post-inner mb-4">  

                    <div class="row mb-4 ">
                        <div class="col-md-12 relative order-1 order-md-1">

                        

                        <a class="text-fiord-blue text-black" @if($noFollow) target="_blank" rel="nofollow" @endif href="{{$articleUrl}}">
                        <img src="{{$article['thumbnail']}}" class="w-100 article-hero" />
                        </a>


                        <h1 class="font-weight-bold h2 mt-5 text-center text-lg-left">
                           {{$article['title']}}
                        </h1>

                        <p><span class="text-purple-pale d-inline-block mr-3 small"> <span class="iconify" data-icon="ant-design:calendar-outline" data-inline="false"></span> {{$article['date']}} </span>

                         @if($article['author'])
                                <span class="text-purple-pale d-inline-block mr-3 small">
                                <span class="iconify" data-icon="ant-design:user-outline" data-inline="false"></span> <a class="text-purple-pale" href="/{{$article['authorSlug']}}">{{ $article['author'] }}</a>
                                </span>
                                @endif


                        </p>

                        <div class="news-content">
 
                        {!! $article['content'] !!}</div>

                        </div>
                        
                    </div>
                    </div>

                <div class="bg-white py-5 author-box">

                <div class="inner-wrapper mt-auto mb-auto container">
                <div class="row justify-content-center">
                    <div class="col-2 d-flex">
                        <div class="align-self-center w-100">
                        <img class="blog-author-avatar mw-100" src="{{$article['authorAvatar']}}" alt="User Avatar">
                        </div>
                    </div>
                    <div class="col-8">
                        <span class="text-muted">WRITTEN BY</span>
                        <h3>{{$article['author']}}</h3>
                        <p class="mb-0">{{$article['authorDescription']}}</p>
                    </div>
                </div> 
                </div>
                </div>

                <h4 class="font-weight-bold mt-4 mb-0">Related articles</h4>
                            
                                    @if(count($relatedArticles['data']) > 0)

                                        <div class="row">
                                        @foreach($relatedArticles['data'] as $communityArticle)
                                            @php
                                                $articleUrl = $communityArticle['url'] ? $communityArticle['url'] : '/news/' . $communityArticle['slug'];
                                                $noFollow = $communityArticle['url'] ? true : false;
                                            @endphp

                                                <div class="col-lg-6 mt-4"> 
                                            
                                                <div class="card overflow-hidden h-100">
                                                <div class="card-body p-0">

                                                <a @if($noFollow) rel="nofollow" @endif href="{{$articleUrl}}" class="news-feed d-block">  

                                                    <div class="thumbnail-lg" style="background-image: url({{$communityArticle['thumbnail']}});"> 
                                                  
                                                    </div>

                                                </a> 
                     
                                                <div class="p-4">
                                                <h6 class="mb-3 font-weight-bold">{{$communityArticle['title']}}</h6>

                                                <p class="card-text mb-3">{{$communityArticle['excerpt']}}…</p>
                                                    
                                                    <span class="text-purple-pale d-inline-block mr-3">
                                                    <span class="iconify" data-icon="ant-design:clock-circle-outline" data-inline="false"></span> 2mins
                                                    </span>

                                                    <span class="text-purple-pale d-inline-block mr-3"> <span class="iconify" data-icon="ant-design:calendar-outline" data-inline="false"></span> {{$communityArticle['date']}} </span>
                                                      

                                                    @if($communityArticle['author'])
                                                    <span class="text-purple-pale d-inline-block mr-3">
                                                    <span class="iconify" data-icon="ant-design:user-outline" data-inline="false"></span> <a class="text-purple-pale" href="/{{$communityArticle['authorSlug']}}">{{ $communityArticle['author'] }}</a>
                                                    </span>
                                                    @endif

                                                  

                                                  
                                                </div>

                                                </div>
                                                </div>

                                                </div>


                                        @endforeach
                                        </div>

                                    @endif

                <h5 class="mt-4 mb-3 font-weight-bold">Start trading</h5>

                        <div class="card mt-3">
                            <div class="card-body text-center">

                                <p class="font-weight-medium">
                                    Recommended crypto exchange

                                </p>

                                <div class="row align-self-center">
                                    <div class="col-md-12 d-flex px-lg-4">
                                        <div class="align-self-center w-100 text-center py-3">
                                            <a onclick="gtag('event', 'generate_lead_ref', {'event_label' : 'coinbase'} );" href="https://coinbase-consumer.sjv.io/BXAnKB" Target="_Top">


                                                <svg version="1.1" style="width: 200px;"  id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                     viewBox="0 0 1101.64 196.79" style="enable-background:new 0 0 1101.64 196.79;" xml:space="preserve">
<style type="text/css">
    .st0{fill:#0052FF;}
</style>
                                                    <path class="st0" d="M222.34,54.94c-40.02,0-71.29,30.38-71.29,71.05s30.48,70.79,71.29,70.79c40.81,0,71.82-30.64,71.82-71.05
	C294.16,85.58,263.68,54.94,222.34,54.94z M222.61,167.47c-22.79,0-39.49-17.7-39.49-41.47c0-24.04,16.43-41.73,39.22-41.73
	c23.06,0,39.75,17.96,39.75,41.73S245.4,167.47,222.61,167.47z M302.9,85.85h19.88v108.3h31.8V57.58H302.9V85.85z M71.02,84.26
	c16.7,0,29.95,10.3,34.98,25.62h33.66c-6.1-32.75-33.13-54.94-68.37-54.94C31.27,54.94,0,85.32,0,126s30.48,70.79,71.29,70.79
	c34.45,0,62.01-22.19,68.11-55.21H106c-4.77,15.32-18.02,25.89-34.72,25.89c-23.06,0-39.22-17.7-39.22-41.47
	C32.07,101.96,47.97,84.26,71.02,84.26z M907.12,112.79l-23.32-3.43c-11.13-1.58-19.08-5.28-19.08-14
	c0-9.51,10.34-14.26,24.38-14.26c15.37,0,25.18,6.6,27.3,17.43h30.74c-3.45-27.47-24.65-43.58-57.24-43.58
	c-33.66,0-55.92,17.17-55.92,41.47c0,23.24,14.58,36.72,43.99,40.94l23.32,3.43c11.4,1.58,17.76,6.08,17.76,14.53
	c0,10.83-11.13,15.32-26.5,15.32c-18.82,0-29.42-7.66-31.01-19.28h-31.27c2.92,26.68,23.85,45.43,62.01,45.43
	c34.72,0,57.77-15.85,57.77-43.06C950.05,129.43,933.36,116.75,907.12,112.79z M338.68,1.32c-11.66,0-20.41,8.45-20.41,20.07
	s8.74,20.07,20.41,20.07c11.66,0,20.41-8.45,20.41-20.07S350.34,1.32,338.68,1.32z M805.36,104.34c0-29.58-18.02-49.39-56.18-49.39
	c-36.04,0-56.18,18.23-60.16,46.23h31.54c1.59-10.83,10.07-19.81,28.09-19.81c16.17,0,24.12,7.13,24.12,15.85
	c0,11.36-14.58,14.26-32.6,16.11c-24.38,2.64-54.59,11.09-54.59,42.79c0,24.57,18.29,40.41,47.44,40.41
	c22.79,0,37.1-9.51,44.26-24.57c1.06,13.47,11.13,22.19,25.18,22.19h18.55v-28.26h-15.64V104.34z M774.09,138.68
	c0,18.23-15.9,31.7-35.25,31.7c-11.93,0-22-5.02-22-15.58c0-13.47,16.17-17.17,31.01-18.75c14.31-1.32,22.26-4.49,26.24-10.57
	V138.68z M605.28,54.94c-17.76,0-32.6,7.4-43.2,19.81V0h-31.8v194.15h31.27v-17.96c10.6,12.94,25.71,20.6,43.73,20.6
	c38.16,0,67.05-30.11,67.05-70.79S642.91,54.94,605.28,54.94z M600.51,167.47c-22.79,0-39.49-17.7-39.49-41.47
	s16.96-41.73,39.75-41.73c23.06,0,39.22,17.7,39.22,41.73C639.99,149.77,623.3,167.47,600.51,167.47z M454.22,54.94
	c-20.67,0-34.19,8.45-42.14,20.34v-17.7h-31.54v136.56h31.8v-74.22c0-20.87,13.25-35.66,32.86-35.66c18.29,0,29.68,12.94,29.68,31.7
	v78.19h31.8v-80.56C506.69,79.24,488.94,54.94,454.22,54.94z M1101.64,121.51c0-39.09-28.62-66.56-67.05-66.56
	c-40.81,0-70.76,30.64-70.76,71.05c0,42.53,32.07,70.79,71.29,70.79c33.13,0,59.1-19.55,65.72-47.28h-33.13
	c-4.77,12.15-16.43,19.02-32.07,19.02c-20.41,0-35.78-12.68-39.22-34.87h105.21V121.51z M998.28,110.94
	c5.04-19.02,19.35-28.26,35.78-28.26c18.02,0,31.8,10.3,34.98,28.26H998.28z"/>
</svg>


                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-md-12">

                                        <p>Buy & sell Crypto in minutes</p>

                                        <a onclick="gtag('event', 'generate_lead_ref', {'event_label' : 'coinbase'} );" href="https://coinbase-consumer.sjv.io/BXAnKB" Target="_Top" class="btn btn-primary btn-sm">Learn more</a>


                                    </div>
                                </div>
                            </div>
                        </div>

                        <iframe class="w-100 border-0 mb-5 mt-5" id="recommendations-iframe" src="https://cryptoparrot.com/guide/comparison-iframe-lp/"></iframe>
                        <script>
                            // Selecting the iframe element
                            var iframe = document.getElementById("recommendations-iframe");

                            // Adjusting the iframe height onload event
                            iframe.onload = function(){
                                iframe.style.height = iframe.contentWindow.document.body.scrollHeight + 'px';
                            }
                        </script>



                <div class="row">
                    <div class="col-12 text-left pt-4">

                        <h3 class="font-weight-bold">Comments</h3>

                        @if(Auth::check())
                            <form method="post" class="articleCommentForm mb-3" data-article-id="{{$article['id']}}" action="/app/post/article-comment">
                                @csrf
                                <input type="hidden" name="article_id" value="{{$article['id']}}"/>
                                <textarea name="comment" class="form-control" placeholder="Write a comment..."></textarea>
                                <small style="font-weight: 700; color:#007bff;" id="comment-post-error"></small>
                                <small>Press Enter to post.</small>
                            </form>
                        @else
                            <div id="login-to-comment">Login to comment</div>
                        @endif

                        <div id="comments-{{$article['id']}}"></div>
                        @if($comments['success'])
                            @php $articleId = $article['id']; @endphp
                            <div id="comments-{{$article['id']}}-wrapper">
                                {!!$comments['html']!!}
                            </div>
                            @if($comments['hasMore'])
                                <a data-page="2" data-article-id="{{$article['id']}}" class="pl-5 load-more-comments d-block mb-3">Load more comments...</a>
                            @endif
                        @endif
                    </div>
                </div>
              
                </div>  
                <div class="order-1 order-lg-3 col-1"></div>

    
            </div>

                  </div>  
                </main>
            </div>

        </div>
                

    @endsection

    @section('body-scripts')
        @parent
        <script src="https://cdnjs.cloudflare.com/ajax/libs/intro.js/2.9.3/intro.min.js"></script>      
        <script src="{{ asset('assets/js/plugins/sticky-sidebar/ResizeSensor.js') }}"></script>      
        <script src="{{ asset('assets/js/plugins/sticky-sidebar/sticky-sidebar.js') }}"></script> 

         <script src="{{ asset('assets/js/TradeSubsystem/feed.js') }}"></script>
        <script src="{{ asset('assets/js/FrontSubsystem/article.js') }}"></script>
        <script src="{{ asset('assets/js/TradeSubsystem/guide.js') }}"></script> 
    @endsection    


@endsection