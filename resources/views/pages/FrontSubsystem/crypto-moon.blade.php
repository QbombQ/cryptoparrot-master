@extends('pages.FrontSubsystem.layout-no-footer', 
[
    'title' => 'Crypto Moon - Find out how close Bitcoin is to the moon',
    'classes' => '',
    'html_class' => '', 
    'header' => true,
    'header_class' => 'header-white ',
    'header_outer_class' => 'bg-contact',
    'header_colour' => true,
    'description' => 'Crypto going to the moon has been a dream for many crypto hodlers since the inception. To make it easier, the team behind Crypto Parrot built a tool for tracking TOP10 cryptos\' distance to the moon.',
    'poster' => 'assets/crypto-moon/social-cm.png'
]) 

@section('styles')
    @parent
    <link rel="stylesheet" href="{{ asset('assets/crypto-moon/style.css') }}">
@endsection


@section('main') 
 
    @parent

    @section('content')


    <div class="header-crypto-moon">
    <div class="header-crypto-moon-inner">
    <div class="container">
        <div class="row justify-content-center justify-content-xl-start">
        <div class="col-11 col-xl-4 d-flex col-min">
            <div class="align-self-center">
            <a href="/" title="Cryptocurrency exchange simulator">
            <img src="{{ asset('assets/crypto-moon/cm-logo.svg') }}" alt="crypto moon logo" class="logo">
            </a>
            </div>
        </div>
        </div>
    </div>
    </div> 
    </div>

    <div class="mt-5">
        <div class="container">
            <div class="row justify-content-center justify-content-lg-between">
            <div class="col-11 col-lg-6">
                <h1 class="font-weight-bold h3">Track TOP 10 cryptos'<br/> distance to the moon</h1>
                <p class="lead">Crypto going to the moon has been a dream for many crypto hodlers since the inception. To make it easier, the team behind Crypto Parrot built a tool for tracking TOP10 cryptos' distance to the moon.</p><p>Each dollar is equal to <span class="font-weight-bold">1 km</span> or <span class="font-weight-bold">0.62 mi</span></p>

                <a href="#" class="mr-3 font-weight-bold" data-toggle="modal" data-target="#share-modal">
<i class="far fa-share"></i> Share
</a>
                <a href="javascript:void(0)" onClick="return rudr_favorite(this);" class="font-weight-bold"><i class="far fa-bookmark mr-1"></i> Bookmark</a>
            </div>
            <div class="col-11 col-lg-4 d-flex">
                <div class="align-self-center w-100 mt-4 mt-lg-0">
                <p class="lead mb-0">Distance to the Moon</p>
                <p class="h1 font-weight-bold" data-km="384400">384,400 km</p>
                <a href="/" class="btn btn-outline-primary px-4 active btn-lg font-weight-bold km">km</a>
                <a href="/" class="btn btn-outline-primary  px-4 font-weight-bold mi">mi</a>
                </div>
            </div> 
            </div>
        </div>
    </div>
    <div class="mt-5 mb-5">

        @foreach($currencies as $currency)

        @if($loop->index < 10)

        @php

            

            $dtm = 384400;

            if($currency['price'] < 100) $precision = 2;
            else $precision = 0;

            $dt = number_format($currency['price'],$precision,'.','');
            $dtf = number_format($currency['price'],$precision,'.',',');

            $dtr = number_format($dtm - $currency['price'],0,'.','');
            $dtrf = number_format($dtm - $currency['price'],0,'.',',');

            $percent = number_format(($currency['price'] * 100 / $dtm),0,'.','');

            $l24 = number_format($currency['price'] * $currency['percentChange24h'] / 100,$precision,'.','');
            $l24f = $currency['price'] * $currency['percentChange24h'] / 100;

        @endphp

        <div class="container mt-3">
            <div class="row justify-content-center">
            <div class="col-11 col-xl-12">

                <h1 class="font-weight-bold h3"><img src="{{ asset('assets/images/crypto-icons/color/'.strtolower($currency['symbol']).'.svg') }}" alt="{{$currency['name']}}" class="crypto-icon"> {{$currency['name']}}</h1>
                
                <div class="card border mt-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-sm-6 col-xl-3 @if($percent > 5) mb-3  @else mb-3 mb-lg-0 @endif">
                            <p class="mb-0">Distance travelled</p>
                            <p class="lead font-weight-bold mb-0" data-km="{{ $dt }}">{{ $dtf }} km</p>
                        </div>
                        <div class="col-12 col-sm-6 col-xl-3 @if($percent > 5) mb-3  @else mb-3 mb-lg-0 @endif">
                            <p class="mb-0">Distance remaining</p>
                            <p class="lead font-weight-bold mb-0" data-km="{{ $dtr }}">{{ $dtrf }} km</p>
                        </div>
                        <div class="col-12 col-sm-6 col-xl-3 @if($percent > 5) mb-3  @else mb-3 mb-lg-0 @endif">
                            <p class="mb-0">Traveled in last 24h</p>
                            <p class="lead font-weight-bold mb-0 font-weight-bold @if($l24 > 0) text-success @else text-danger @endif" data-km="{{ $l24 }}" >{{ $l24 }} km</p>
                        </div>
                        <div class="col-12 col-sm-6 col-xl-3 @if($percent > 5) mb-3  @else mb-3 mb-lg-0 @endif">
                            <p class="mb-0">Fuel required <small>(market cap)</small></p>
                            <p class="lead font-weight-bold mb-0 font-weight-bold">~${{ $currency['mkt'] }}</p>
                        </div>
                        @if($percent > 5)
                        <div class="col-12 col-sm-12">
                            <div class="progress">
                              <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: {{ $percent }}%;">{{ $percent }}%</div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                </div>

            </div>
         
            </div>
        </div>

          @endif

        @endforeach




     

    </div>


    <div class="header-crypto-moon">
        <div class="mt-5">
        <div class="container py-5">
            <div class="row justify-content-center justify-content-lg-between">
            <div class="col-11 col-lg-12">
                <h1 class="font-weight-bold h3 text-white">Methodology & Sources</h1>
                <p class="lead"></p> 

               
            </div>
            <div class="col-11 col-lg-6">
                
                <p class="text-white">Circulating supply, 24h change and crypto quotes are provided by Coinpaprika.com API and updated every 10 minutes.</p>
                
                <p class="text-white">Traveled in last 24h is calculated by calculating nominal price change based on percentage change in last 24 hours.</p>


                
            </div>

            <div class="col-11 col-lg-6">
                
                <p class="text-white">Average distance to the moon is 384,400KM according to Space.com</p>
                <p class="text-white">Estimated marketcap is calculated by multiplying circulating supply by 384,400 which is desired price point.</p>


            </div>
            </div>
        </div>
        </div>

        <div class="">
        <div class="container py-5 border-top">
            <div class="row justify-content-center justify-content-lg-between">
            <div class="col-11 col-lg-12">
                <h1 class="font-weight-bold h3 text-white">Recommendations</h1>
                <p class="lead"></p> 

               
            </div>
            <div class="col-11 col-lg-6 mb-3">
                
                <p class="text-white lead font-weight-bold">Become a Cryptonaut</p>
                <p class="text-white">Do not have any crypto, but want to buy some?<br/> We recommend using <a href="/binance" class="font-weight-bold text-white">Binance</a>. Please note, cryptocurrencies are highly speculative and you shoud never invest more than you can afford to lose.</p>
                <a href="/binance" class="btn btn-light px-4">Buy crypto on Binance</a>
                
            </div>

            <div class="col-11 col-lg-6 mb-3">
                
                <p class="text-white lead font-weight-bold">Learn to trade</p>
                <p class="text-white">Not feeling comfortable with crypto? Learn how to trade using our cryptocurrency exchange simulator. Buy and sell fantasy crypto using play dollars, exchange your profits for real Bitcoin over Ligthing Network.</p>
                <a href="/" class="btn btn-light px-4">Trading simulator</a>


            </div>

             <div class="col-11 col-lg-11 mt-5">

                <p class="text-white mb-2">Brought to you by <a href="/" class="text-white font-weight-bold">Crypto Parrot - Cryptocurrency simulator</a></p>
                <a href="/" class="text-white">
                <img src="https://cryptoparrot.com/assets/images/logo-white.svg" class="" alt="" style="max-width: 200px;">
                </a>

            </div>

            </div>
        </div>
        </div>

    </div>


    </div>

    <div class="modal fade" id="share-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
    <div class="modal-content">
    <div class="modal-body">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <i class="fal fa-times"></i>
    </button>
    <h5 class="modal-title mb-3">Share on social media</h5>
    <div class="meta">
    <a rel="nofollow" target="_blank" href="https://twitter.com/intent/tweet?text={{ urlencode('Crypto Moon - Find out how close Bitcoin is to the moon') }}&url=https://cryptoparrot.com/crypto-moon" class="align-self-center ssk ssk-twitter mr-1"><span class="fa-stack fa-2x"><i class="fas fa-square-full fa-stack-2x" style="color:#1da1f2"></i><i class="fab fa-twitter fa-stack-1x fa-inverse"></i></span></a>
    <a rel="nofollow" target="_blank" href="https://cryptoparrot.com/crypto-moon" class="align-self-center ssk ssk-facebook mr-1"><span class="fa-stack fa-2x "><i class="fas fa-square-full fa-stack-2x" style="color:#2D88FF"></i><i class="fab fa-facebook-f fa-stack-1x fa-inverse"></i></span></a>
    <a rel="nofollow" target="_blank" href="https://www.reddit.com/submit?url=https://cryptoparrot.com/crypto-moon" class="align-self-center ssk ssk-facebook  mr-1"><span class="fa-stack fa-2x"><i class="fas fa-square-full fa-stack-2x" style="color:#ff4500"></i><i class="fab fa-reddit-alien fa-stack-1x fa-inverse"></i></span></a>
    <a rel="nofollow" target="_blank" href="linkedin.com/sharing/share-offsite/?url={{ urlencode('https://cryptoparrot.com/crypto-moon') }}" class="align-self-center ssk ssk-facebook  mr-1"><span class="fa-stack fa-2x"><i class="fas fa-square-full fa-stack-2x" style="color:#0c66c2"></i><i class="fab fa-linkedin-in fa-stack-1x fa-inverse"></i></span></a>
    <a rel="nofollow" target="_blank" href="tg:msg?text=https://cryptoparrot.com/crypto-moon" class="align-self-center ssk ssk-facebook  mr-1"><span class="fa-stack fa-2x"><i class="fas fa-square-full fa-stack-2x" style="color:#169cde"></i><i class="fab fa-telegram-plane fa-stack-1x fa-inverse"></i></span></a>
    <a rel="nofollow" target="_blank" href="whatsapp://send?text=https://cryptoparrot.com/crypto-moon" class="align-self-center ssk ssk-facebook  mr-1"><span class="fa-stack fa-2x"><i class="fas fa-square-full fa-stack-2x" style="color:#00e676"></i><i class="fab fa-whatsapp fa-stack-1x fa-inverse"></i></span></a>
    </div>
    <p class="text-muted mb-2 mt-3">Or copy link</p>
    <div class="embed-container">
    <textarea class="form-control" readonly="">https://cryptoparrot.com/crypto-moon</textarea>
    <button class=" text-uppercase btn btn-secondary mb-0 btn-sm font-weight-bold mt-3">Copy permalink <i class="far fa-copy text-white ml-2" aria-hidden="true"></i></button>
    </div>
    </div>
    </div>
    </div>
    </div>



  
    @endsection


@endsection


@section('body-scripts')
    @parent

        <script type="text/javascript">
        function rudr_favorite(a) {
            pageTitle=document.title;
            pageURL=document.location;
            try {
                // Internet Explorer solution
                eval("window.external.AddFa-vorite(pageURL, pageTitle)".replace(/-/g,''));
            }
            catch (e) {
                try {
                    // Mozilla Firefox solution
                    window.sidebar.addPanel(pageTitle, pageURL, "");
                }
                catch (e) {
                    // Opera solution
                    if (typeof(opera)=="object") {
                        a.rel="sidebar";
                        a.title=pageTitle;
                        a.url=pageURL;
                        return true;
                    } else {
                        // The rest browsers (i.e Chrome, Safari)
                        alert('Press ' + (navigator.userAgent.toLowerCase().indexOf('mac') != -1 ? 'Cmd' : 'Ctrl') + '+D to bookmark this page.');
                    }
                }
            }
            return false;
        }

        $(document).ready(function(){

            $('.mi').on('click', function (e) {

                e.preventDefault();

                $('.km').removeClass('active');
                $('.mi').addClass('active');

                $('[data-km]').each(function(i,el){

                    var km = $(el).data('km');
                    var miles = km / 1.60934;
                    $(el).html(numberWithCommas(miles.toFixed(0)) + ' mi');

                });
            });

            $('.km').on('click', function (e) {

                e.preventDefault();

                $('.mi').removeClass('active');
                $('.km').addClass('active');

                $('[data-km]').each(function(i,el){

                    var km = $(el).data('km');
                    $(el).html(numberWithCommas(km.toFixed(0)) + ' km');

                });

            });

            function numberWithCommas(x) {
                return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            }

            $('.embed-container button').on('click', function (e) {

             /* Get the text field */
              var copyText = $(this).closest('.embed-container').find('textarea')[0]; 

              console.log(copyText);
     
              /* Select the text field */
              copyText.select();
              copyText.setSelectionRange(0, 99999); /*For mobile devices*/

              /* Copy the text inside the text field */
              document.execCommand("copy");

             $(this).html('Copied!') 

            }); 

            $('.embed-container textarea').on('click', function (e) {
                 $(this).select();
            });

        });

    </script>

@endsection