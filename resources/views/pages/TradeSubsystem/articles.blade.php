<?php
    $array = [
        'title' =>  $category['meta_title'],
        'classes' => 'h-100',
        'html_class' => '',
        'description' => $category['meta_description'],
        'nofollow'=>false,
        'poster' => 'assets/images/poster.jpg'
    ];
    if(isset($canonical)) 
    {
        $array['canonical'] = $canonical;
    }
?>

@extends('pages.TradeSubsystem.layout', $array)
 
@section('main')

    @parent

    @section('styles')
        @parent 
    @endsection  

    @section('content')

        @if(isset($currentFilters))
            <script>var currentFilter = @json($currentFilters);</script>
        @endif

        <div class="wrapper">

            <div class="sidebar">
                @include('pages.TradeSubsystem.common.sidebar') 
            </div>
            <div class="main">

                <div class="shade"></div>
                
                @include('pages.TradeSubsystem.common.header') 

                <main class="main-content main-content-md pt-3 pt-lg-5 pb-5">
                  <div class="px-3 px-lg-5">

                    <div id="messages-col">
                    </div> 
                    @if (session('message'))
                        <div class="alert alert-danger mb-3">
                            {{ session('message') }}
                        </div>
                    @endif 

                 
                    <h5 class="mb-4">
                        <span class="pr-4">{{ $category['title'] }}</span> 
                        <select id="tags-filter" class="select-2 d-none">
                            <option value="">View all tags</option> 
                            <option @if($articles['tag'] == 'bitcoin') selected @endif value="bitcoin">Bitcoin</option>
                            <option @if($articles['tag'] == 'cryptocurrency') selected @endif value="cryptocurrency">Cryptocurrency</option>
                            <option @if($articles['tag'] == 'community') selected @endif value="community">Community</option>
                            <option @if($articles['tag'] == 'markets') selected @endif value="markets">Markets</option>
                            <option @if($articles['tag'] == 'guide') selected @endif value="guide">Guide</option>
                            <option @if($articles['tag'] == 'exchange') selected @endif value="exchange">Exchange</option>
                        </select> 
                    </h5> 

                    <div class="row">

                        @if(array_key_exists('data', $articles))
                            
                            @forelse($articles['data'] as $article)


                                @php
                                    $articleUrl = $article['url'] ? $article['url'] : '/article/' . $article['slug'];
                                    $noFollow = $article['url'] ? true : false;
                                    $source = $article['url'] ? parse_url($article['url'])['host'] : '';
                                @endphp

                                <div class="col-xl-4 pb-4">
                                <div class="card overflow-hidden h-100">
                                <div class="card-body p-0">

                                    <a @if($noFollow) rel="nofollow" @endif href="{{$articleUrl}}" class="news-feed d-block">  

                                        <div class="thumbnail-md" style="background-image: url({{$article['thumbnail']}});"> 
                                      
                                        </div>

                                    </a> 

                                    <div class="p-4">
                                    <h6 class="mb-3 font-weight-bold">{{$article['title']}}</h6>
                                    <p class="card-text mb-3">{{$article['excerpt']}}…</p>
                                        
                                    <span class="text-purple-pale d-inline-block mr-3">
                                    <span class="iconify" data-icon="ant-design:clock-circle-outline" data-inline="false"></span> 2mins
                                    </span>

                                    <span class="text-purple-pale d-inline-block mr-3"> <span class="iconify" data-icon="ant-design:calendar-outline" data-inline="false"></span> {{$article['date']}} </span>
                                      

                                    @if($source) 

                                    <span data-toggle="tooltip" title="{{$source}}" class="text-purple-pale d-inline-block mr-3">
                                <span  class="iconify" data-icon="ant-design:link-outline" data-inline="false"></span> 
                                </span>

                                    @else 
                                    @if($article['author'])
                                    <span class="text-purple-pale d-inline-block mr-3">
                                    <span class="iconify" data-icon="ant-design:user-outline" data-inline="false"></span> <a class="text-purple-pale" href="/{{$article['authorSlug']}}">{{ $article['author'] }}</a>
                                    </span>
                                    @endif
 
                                    @endif


                                    </div>

                                </div>
                                </div>
                                </div>
 
                            @empty
                                <div class="col-xl-12 pb-4">
                                <div class="card overflow-hidden h-100">
                                <div class="card-body p-5">
                                    <h4 class="text-center h5 mb-0">No articles found</h4>
                                </div> 
                                </div> 
                                </div> 
                            @endforelse
                    
        
                        @endif

                    </div>

                    <div class="row">
             
                   
                    <div class="col-12">
                            {!! $articles['pagination'] !!}
                    </div>
               
    
                    </div>

                  </div>  
                </main>
            </div>

        </div>
                

    @endsection

    @section('body-scripts')
        @parent
        <script src="{{ asset('assets/js/TradeSubsystem/feed.js') }}"></script>
        <script src="{{ asset('assets/js/TradeSubsystem/articles.js') }}"></script>               
    @endsection    


@endsection