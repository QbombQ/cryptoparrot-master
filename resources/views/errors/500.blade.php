@extends('pages.FrontSubsystem.layout', 
[
    'title' => 'Crypto Parrot experiences technical difficulties | CryptoParrot.com',
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
        <h1 class="display-4 text-purple font-weight-bold">Server error</h1>
        <a href="/" class="btn btn-secondary btn-lg"><i class="fas fa-redo-alt mr-2"></i> Try again</a>
        </div>
        </div>
        </div>
        </div> 


    @endsection

@endsection