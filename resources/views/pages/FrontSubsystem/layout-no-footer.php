@extends('pages.page-layout', [$title, $classes, $poster, $html_class])

@section('head-scripts')
    @parent
@endsection

@section('styles')
    @parent

@endsection

@section('content')

@endsection

@section('body-scripts')
    @parent

    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.0.12/css/all.css" integrity="sha384-HX5QvHXoIsrUAY0tE/wG8+Wt1MwvaY28d9Zciqcj6Ob7Tw99tFPo4YUXcZw9l930" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script> 
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    
@endsection