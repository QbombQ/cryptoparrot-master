@extends('pages.AdminSubsystem.layout', 
[
    'title' => 'Edit Pair'
])

@section('content')
    
    @include('pages.AdminSubsystem.common.header') 

    <div class="row">
        <div class="col-lg-10">
            <h2 class="font-weight-bold mb-4">Edit {{$pair['from_acronym']}}/{{$pair['to_acronym']}}</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="/admin">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="/admin/pairs">Trade Pairs</a>
                </li>                
                <li class="breadcrumb-item active">
                    <strong>Edit</strong>
                </li>
                
            </ol>
        </div>
        <div class="col-lg-2">

        </div>
    </div>
    <form method="post" action="" class="form-horizontal">

        <div class="row">
            <div class="col-lg-8">
         
                        
                        @csrf
                        @php
                            $buy_volume_limit = $pair['buy_volume_limit'];
                            $sell_volume_limit = $pair['sell_volume_limit'];
                            $show_on_currencies_page = $pair['show_on_currencies_page'];
                            $disabled = $pair['disabled'];
                            $priority = $pair['priority'];
                        @endphp          
                        <input type="hidden" name="pair_id" value="{{$pair['id']}}">    


                        <label class="control-label">Buy volume limit</label>
                        <input value="{{$buy_volume_limit}}" name="buy_volume_limit" type="number" class="form-control mb-3">
                   
                        <label class="control-label">Sell volume limit</label>
                        <input value="{{$sell_volume_limit}}" name="sell_volume_limit" type="number" class="form-control mb-3">

                        <input type="hidden" name="show_on_currencies_page" value="off"/>
                        <label class="mr-3"> <input type="checkbox" name="show_on_currencies_page" @if($show_on_currencies_page) checked @endif /> Show on currencies page</label>
                        
                        <input type="hidden" name="disabled" value="off"/>
                        <lablel><input type="checkbox" name="disabled" @if($disabled) checked @endif />  Disabled</label>
                

                        <div class="mt-3 mb-3">
                            <label class="control-label">Priority</label>
                            <input value="{{$priority}}" name="priority" type="number" class="form-control">
                        </div>


                        <div class="input-group m-b">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>

           
                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                <div class="alert alert-danger alert-dismissible fade show mb-0 border-top" role="alert">
                                    <i class="fa fa-exclamation-circle"></i> 
                                    {{ $error }}
                                </div>
                            @endforeach
                        @endif  
                                     

                        </div> 
                    
            </div>

     </form>

    @include('pages.AdminSubsystem.common.footer') 

@endsection