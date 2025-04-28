@extends('pages.AdminSubsystem.layout', 
[
    'title' => 'New Currency'
])

@section('content')

    @include('pages.AdminSubsystem.common.header') 

    <div class="row">
        <div class="col-lg-10">
            <h2 class="font-weight-bold mb-4">Create new pair</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="/admin">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="/admin/pairs">Trade pairs</a>
                </li>                
                <li class="breadcrumb-item active">
                    <strong>New</strong>
                </li>
                
            </ol>
        </div>
        <div class="col-lg-2">

        </div>
    </div>

        <div class="row">
            <div class="col-lg-8">
               
                   
     
                <form method="post" action="" class="form-horizontal">
                    @csrf
                    <label class="control-label">Currency From</label>
                        
                    <select class="form-control mb-3" name="from_currency_id">
                        @foreach($currencies as $value => $name)
                            <option value="{{$value}}">{{$name}}</option>
                        @endforeach
                    </select>
              
                    <label class="control-label">Currency To</label>
                        
                    <select class="form-control mb-3" name="to_currency_id">
                        @foreach($currencies as $value => $name)
                            <option value="{{$value}}">{{$name}}</option>
                        @endforeach
                    </select>
                
                      
                    <label class="control-label">Rate</label>
                    <input type="text" value="{{ old('rate') }}" name="rate" placeholder="1000" class="form-control mb-3">

                    <label class="control-label">Rate Sell</label>
                    <input type="text" value="{{ old('rate_sell') }}" name="rate_sell" placeholder="1000" class="form-control mb-3">

                     <label class="control-label">Buy volume limit</label>
                        <input value="{{ old('buy_volume_limit') }}" name="buy_volume_limit" type="number" class="form-control mb-3">
                   
                        <label class="control-label">Sell volume limit</label>
                        <input value="{{ old('sell_volume_limit') }}" name="sell_volume_limit" type="number" class="form-control mb-3">

                    <input type="hidden" name="show_on_currencies_page" value="off"/>
                    <label class="mr-3"><input type="checkbox" name="show_on_currencies_page"/> Show on currencies page</label>
                    
                    <input type="hidden" name="disabled" value="off"/>
                    <label><input type="checkbox" name="disabled"  /> Disabled</label>
                    
                    <div class="mt-3">
                    <label class="control-label">Priority</label>
                    <input value="0" name="priority" type="number" class="form-control">
                    </div>
                       
                    <button class="btn btn-primary mt-4" type="submit">Create</button>
                     
             
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger alert-dismissible fade show mb-0 border-top" role="alert">
                                <i class="fa fa-exclamation-circle"></i> 
                                {{ $error }}
                            </div>
                        @endforeach
                    @endif                            
                </form>
                    
             
            </div>
        </div>


    @include('pages.AdminSubsystem.common.footer') 

@endsection