 @php

    $articleUrl = $article['url'] ? $article['url'] : '/news/' . $article['slug'];
    $noFollow = $article['url'] ? true : false;

    $source = $article['url'] ? parse_url($article['url'])['host'] : '';


@endphp 

<div class="trade-item mb-3 card overflow-hidden">
<div class="card-body p-0">

<a target="_blank" @if($noFollow) rel="nofollow" @endif href="{{$articleUrl}}" class="news-feed d-block">  

    <div class="thumbnail-xl" style="background-image: url({{$article['thumbnail']}});"> 
  
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
    <span class="iconify" data-icon="ant-design:user-outline" data-inline="false"></span> <a class="text-purple-pale" target="_blank"  href="/{{$article['authorSlug']}}">{{ $article['author'] }}</a>
    </span>
    @endif

    @endif

  
</div>

</div>
</div> 