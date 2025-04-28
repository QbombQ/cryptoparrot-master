
@extends('pages.TradeSubsystem.layout', 
[
    'title' => 'Feed',
    'classes' => 'h-100',
    'html_class' => '',
    'description' => '',
	'poster' => ''
])

@section('main')

    @parent

    @section('content')

        <style>
            .thumbnail-stocklytics {
                background-size: cover;
                background-position: center;
                aspect-ratio: 5 / 3;
            }
        </style>
        
        <div id="replacable-main-content" class="feed-wrapper">
            @php
                $socket = false;
            @endphp

            @if(count($trades['data']) > 0)
                @foreach($trades['data'] as $trade)


                  @if($loop->iteration == 2 || $loop->iteration == 6)
                  
                  <div class="trade-item mb-3 card overflow-hidden">
                  <div class="card-body p-0 card-stocklytics">

                  <a onclick="gtag('event', 'generate_lead_ref_feed', {'event_label' : 'stocklytics'} );" target="_blank" href="https://stocklytics.com?ref=cryptoparrot" target="_blank" class="news-feed d-block">


                      <div class="thumbnail-stocklytics" style="background-size: cover;background-position: center;aspect-ratio: 5 / 3;background-image: url(https://cryptoparrot.com/assets/images/stocklytics.jpg);">
                    
                      </div>

                  </a>

                  </div>
                  </div>

                  @endif 


{{--                  @if($loop->iteration == 3 && $article)--}}
{{--                  @include('pages.TradeSubsystem.common.article-in-feed')--}}
{{--                  @endif --}}


{{--                  @if($loop->iteration == 6 && $secondaryArticle)--}}
{{--                --}}
{{--                    @php--}}
{{--                        $article = $secondaryArticle;--}}
{{--                    @endphp --}}

{{--                    @include('pages.TradeSubsystem.common.article-in-feed')--}}

{{--                  @endif--}}

                  @include('pages.TradeSubsystem.common.trade')
                  
                @endforeach            
            @endif

 
        </div>       

    @endsection

@endsection
 