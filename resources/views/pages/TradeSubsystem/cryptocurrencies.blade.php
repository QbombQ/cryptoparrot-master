@extends('pages.TradeSubsystem.layout', 
[
    'title' => 'Learn more about the coins/tokens listed on Crypto Parrot',
    'classes' => 'h-100',
    'html_class' => '',
    'description' => 'Come see why on Crypto Parrot our cryptocurrency community is the best place to trade and learn about crypto like Bitcoin, Ethereum, Ripple and many more.', 
	'poster' => 'assets/images/poster.jpg'
])

@section('main')

    @parent

     @section('styles') 
        @parent
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chartist/0.11.0/chartist.min.css">
        <link rel="stylesheet" href="{{ asset('assets/css/TradeSubsystem/cryptocurrencies.css') }}"> 
    @endsection  


    @section('content')

        <div class="wrapper">

            <div class="sidebar">
                @include('pages.TradeSubsystem.common.sidebar') 
            </div>
            <div class="main">

                <div class="shade"></div>
                  
                @include('pages.TradeSubsystem.common.header') 

                <main class="main-content main-content-md pt-3 pb-5 pt-sm-3 py-lg-5">

                    <div class="px-3 px-lg-5 pb-3 pb-lg-0">

                    @if(env('APP_FORK') != 'fxparrot')
                    <h1 class="h4 font-weight-bold mb-1">Cryptocurrencies</h1>
                    <p class="mb-3 mb-lg-5 text-muted">Learn more about the coins/tokens listed on Crypto Parrot</p> 
                    @else
                     <h1 class="h4 font-weight-bold mb-1">Markets</h1>
                    <p class="mb-3 mb-lg-5 text-muted">Learn more about the FX and stocks listed on FX Parrot</p> 
                    @endif
                       
                    <div class="">
                        <table id="table-cryptocurrencies" class="table table-no-wrap table-currencies">
                            <thead>
                              <tr> 
                                <th scope="col">#</th>
                                @if(env('APP_FORK') == 'fxparrot')
                                <th scope="col">ASSET</th>
                                @else
                                <th scope="col">CRYPTOCURRENCY</th>
                                @endif
                                <th scope="col">CURRENT PRICE</th>
                                @if(env('APP_FORK') != 'fxparrot')
                                <th scope="col">MARKET CAP</th>
                                @endif 
                                <th scope="col">CHANGE</th>
                                @if(env('APP_FORK') == 'fxparrot')
                                <th scope="col">PRICE GRAPH (Last 16 hours)</th>
                                @else
                                <th scope="col">PRICE GRAPH (7 DAYS)</th>
                                @endif 
                                <th scope="col"></th>
                              </tr>
                            </thead>
                            <tbody>
                             
                                @if(env('APP_FORK') == 'fxparrot')

                                @foreach($currencies as $key => $currency) 
                                <tr>
                                  <td scope="row"><span class="td-inner d-flex">
                                      
                                      <div class="align-self-center w-100">

                                        <div class="mx-auto currency-icon currency-icon-{{str_slug($currency['pair']->fromCurrency->name,'-')}}">
                                        </div>

                                      </div>

                                  </span></td>
                                  <td scope="row"><span class="td-inner d-flex">
                                        <span class="align-self-center">
                                        <a class="font-weight-bold" href="/app/markets/{{$currency['pair']->fromCurrency->acronym}}">{{$currency['pair']->fromCurrency->name}}</a>
                                        </span> 
                                  </span></td>
                                  <td scope="row"><span class="td-inner d-flex">
                                       <span class="align-self-center">
                                              {{$currency['pair']->toCurrency->symbol}}{{$currency['pair']->rate}}
                                        </span>
                                  </span></td>
                                  @if(env('APP_FORK') != 'fxparrot')
                                  <td scope="row"><span class="td-inner d-flex">
                                        <span class="align-self-center">
                                              -
                                        </span> 
                                  </span></td>
                                  @endif 
                                  <td scope="row"><span class="td-inner d-flex">
                                        <span class="align-self-center">

                                            <span class="font-weight-bold  @if($currency['pair']->change > 0) positive @else negative @endif ">
                                             {{$currency['pair']->change}}%  
                                            </span>
                                        
                                        </span>
                                  </span></td>
 
                                   <td scope="row"><span class="td-inner">
                                        <div id="chart_{{str_slug($key,'')}}" class="ct-chart"></div>
                                  </span></td> 

                             
                                  <td scope="row"><span class="td-inner d-flex">
                                        <span class="align-self-center">
                                         <a class="d-block p-2" href="/app/markets/{{$currency['pair']->fromCurrency->acronym}}"><span class="iconify" data-icon="ant-design:arrow-right-outlined" data-inline="false"></span></a> 
                                        </span>
                                  </span></td>
                                </tr> 
                                @endforeach



                                @else 


                                @foreach($currencies as $key => $currency) 
                                <tr>
                                  <td scope="row"><span class="td-inner d-flex">
                                      
                                      <div class="align-self-center w-100">

                                        <div class="mx-auto currency-icon currency-icon-{{str_slug($currency['currencyData']['name'],'-')}}">
                                        </div>

                                      </div>

                                  </span></td>
                                  <td scope="row"><span class="td-inner d-flex">
                                        <span class="align-self-center">
                                        <a class="font-weight-bold" href="/app/cryptocurrencies/{{$currency['currencyData']['acronym']}}">{{$currency['currencyData']['name']}}</a>
                                        </span> 
                                  </span></td>
                                  <td scope="row"><span class="td-inner d-flex">
                                       <span class="align-self-center">
                                               ${{$currency['currencyData']['usd_value']}}  
                                        </span>
                                  </span></td>
                                  <td scope="row"><span class="td-inner d-flex">
                                        <span class="align-self-center">
                                               ${{number_format($currency['pair']->getMarketCapUSD(), 0)}}  
                                        </span> 
                                  </span></td>
                                  <td scope="row"><span class="td-inner d-flex">
                                        <span class="align-self-center">

                                            <span class="font-weight-bold @if($currency['pair']->getPercentChange24h() > 0) positive @else negative @endif">
                                             {{$currency['pair']->getPercentChange24h()}}%  
                                            </span>
                                        
                                        </span>
                                  </span></td>
                                  <td scope="row"><span class="td-inner">
                                        <div id="chart_{{str_slug($key,'')}}" class="ct-chart"></div>
                                  </span></td> 
                                  <td scope="row"><span class="td-inner d-flex">
                                        <span class="align-self-center">
                                         <a class="d-block p-2" href="/app/cryptocurrencies/{{$currency['currencyData']['acronym']}}"><span class="iconify" data-icon="ant-design:arrow-right-outlined" data-inline="false"></span></a> 
                                        </span>
                                  </span></td>
                                </tr> 
                                @endforeach

                                @endif

                    
                            </tbody>
                          </table> 
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

                </main>
            </div>

        </div>


    @endsection

    @section('body-scripts')
        @parent
        <script src="https://cdnjs.cloudflare.com/ajax/libs/chartist/0.11.0/chartist.min.js"></script>   
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
        <script src="https://cdn.datatables.net/fixedcolumns/3.3.0/js/dataTables.fixedColumns.min.js"></script>
        <script src="https://unpkg.com/scroll-hint@latest/js/scroll-hint.min.js"></script> 
        <script src="{{asset('assets/js/TradeSubsystem/cryptocurrencies.js')}}"></script>
 
      

        <script type="text/javascript">
            
            var chart_options = {
              height: '50px',
              showPoint: false,
              showLine: true,
              showArea: false,
              fullWidth: true,
              showLabel: false,
              axisX: {
                showGrid: false,
                showLabel: false,
                offset: 0
              },
              axisY: {
                showGrid: false,
                showLabel: false,
                offset: 0
              },
              chartPadding: {
                top:10,
                bottom:0,
                right:0,
                left:0
              },
            }; 

        </script>
        <script type="text/javascript">

            @if(env('APP_FORK') == 'fxparrot') 

              @foreach($currencies as $key => $currency)

                  @php

                    $price_list = array();
                    foreach ($currency['candles'] as $candle): 
                      $price_list[] = $candle->Open;
                    endforeach

                  @endphp

                  var chart_<?=str_slug($key,'');?> = new Chartist.Line('#chart_<?=str_slug($key,'');?>', {
                      series: [JSON.parse('{!! json_encode($price_list) !!}')]
                  },chart_options);

                  chart_<?=str_slug($key,'');?>.on('draw', function(data) {
                  if(data.type === 'line' || data.type === 'area') {
                      data.element.animate({
                      d: {
                          begin: 2000 * data.index,
                          dur: 2000,
                          from: data.path.clone().scale(1, 0).translate(0, data.chartRect.height()).stringify(),
                          to: data.path.clone().stringify(),
                          easing: Chartist.Svg.Easing.easeOutQuint
                      }
                      });
                  }
                  });

              @endforeach

            @else

              @foreach($currencies as $key => $currency)

                var chart_<?=str_slug($key,'');?> = new Chartist.Line('#chart_<?=str_slug($key,'');?>', {
                    series: [JSON.parse('{{ json_encode($currency['chart7Days']) }}')]
                },chart_options);

                chart_<?=str_slug($key,'');?>.on('draw', function(data) {
                if(data.type === 'line' || data.type === 'area') {
                    data.element.animate({
                    d: {
                        begin: 2000 * data.index,
                        dur: 2000,
                        from: data.path.clone().scale(1, 0).translate(0, data.chartRect.height()).stringify(),
                        to: data.path.clone().stringify(),
                        easing: Chartist.Svg.Easing.easeOutQuint
                    }
                    });
                }
                });

              @endforeach 

            @endif

        </script>


       
    @endsection    


@endsection

@section('footer-scripts')
     @parent
@endsection
