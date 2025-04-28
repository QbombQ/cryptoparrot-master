<!DOCTYPE html>
<html lang="en-US" @if($html_class) class="{{$html_class}}" @endif> 
    @php
        $image = strlen($poster) > 0 ? asset($poster) : asset('assets/images/niffler-og.jpg?v2');
    @endphp
    <head> 
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>{{ $title }}</title>
        <meta name="google-site-verification" content="5jw3zQKU-mssfkSHMt3CVLrGa0tPKidN5inLAVtGK3Y" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        @section('head-other')
        @show
        @section('head-scripts')  
        @show
        @section('styles')

        <meta name='impact-site-verification' value='0bd81d3e-fabe-4676-91c3-8687e959df01'>

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

        <link href="https://fonts.googleapis.com/css?family=Red+Hat+Display:400,500,700,900&display=swap" rel="stylesheet">
         
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.11/dist/css/select2.min.css">   

        <link rel="stylesheet" href="{{ asset('assets/css/plugins/formvalidation/formValidation.min.css') }}">
        <link rel="stylesheet" href="https://spin.js.org/spin.css">
            
        <link rel="stylesheet" href="{{ asset('assets/css/style.css?v=7') }}">
        @show 
 
        <link rel="icon" id="favicon" type="image/png" href="{{ asset('assets/images/favicon.png') }}">
        <link rel="apple-touch-icon" href="{{ asset('assets/images/homeicon.png?v=2') }}"> 

        @if (!empty($nofollow))
          <meta name="robots" content="noindex,nofollow"/>
        @endif
 
        @if(isset($canonical))
          <link rel="canonical" href="{{$canonical}}" />
        @endif
  
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:site" content="Niffler_co"> 
        <meta name="twitter:title" content="{{ $title }}">
        <meta name="twitter:description" content="{{ $description }}">
        <meta property="twitter:image:src" content="{{ $image }}">
        <meta name="google-signin-client_id" content="362458400650-vadn6n1f61qa70kia16qcn2nvuqc1ef3.apps.googleusercontent.com">

        <meta name="description" content="{{ $description }}">

        <meta property="og:title" content="{{ $title }}">
        <meta property="og:type" content="website">
        <meta property="og:image" content="{{ $image }}" />
        <meta property="og:url" content="{{ Request::url() }}">
        <meta property="og:description" content="{{ $description }}">

        <script>
          var siteUrl = "{{URL::to('/')}}";
        </script>
 
        <!-- Google Tag Manager -->
        <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-PHTQNLD');</script>
        <!-- End Google Tag Manager -->

        <!-- DO NOT MODIFY -->
        <!-- Quora Pixel Code (JS Helper) -->
        <script>
        !function(q,e,v,n,t,s){if(q.qp) return; n=q.qp=function(){n.qp?n.qp.apply(n,arguments):n.queue.push(arguments);}; n.queue=[];t=document.createElement(e);t.async=!0;t.src=v; s=document.getElementsByTagName(e)[0]; s.parentNode.insertBefore(t,s);}(window, 'script', 'https://a.quora.com/qevents.js');
        qp('init', '7f299aca2ca546058ee7e333e8077e44');
        qp('track', 'ViewContent');
        </script>
        <noscript><img height="1" width="1" style="display:none" src="https://q.quora.com/_/ad/7f299aca2ca546058ee7e333e8077e44/pixel?tag=ViewContent&noscript=1"/></noscript>
        <!-- End of Quora Pixel Code -->

    </head> 

    <body class="{{ $classes }}">

        <!-- Google Tag Manager (noscript) -->
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PHTQNLD"
        height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
        <!-- End Google Tag Manager (noscript) -->

        <div id="app">
        @yield('before-content')
        @yield('content')
        
        @section('body-scripts')
        @show

        @show
        
        <div id="fb-root"></div>
        <script>(function(d, s, id) {
          var js, fjs = d.getElementsByTagName(s)[0];
          if (d.getElementById(id)) return;
          js = d.createElement(s); js.id = id;
          js.src = 'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0&appId=767643093432690&autoLogAppEvents=1';
          fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>

        <script src="https://code.iconify.design/1/1.0.3/iconify.min.js"></script>

        @section('footer')
        @section('footer-scripts')
        @show
        </div>
    </body> 

</html> 
