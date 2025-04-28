@extends('pages.FrontSubsystem.layout', 
[
    'title' => 'Page not found | CryptoParrot.com',
    'classes' => '',
    'html_class' => 'error-404',
    'header' => true,
    'header_class' => 'header-white',
    'header_colour' => true,
    'description' => 'Page not found',
    'poster' => 'assets/images/niffler-og.jpg'
]) 
 
@section('main')

    @parent

    @section('header-landing')

    @endsection

    @section('content')

        <div class="py-5 bg-404 mb-5">
        <div class="py-5">
        <div class="py-5">
        <div class="py-5 text-center">
        <h1 class="display-1 text-purple font-weight-bold">404</h1>
        <a href="/" class="btn btn-secondary btn-lg">Go Back Home</a>
        </div>
        </div>
        </div>
        </div> 


    @endsection

@endsection