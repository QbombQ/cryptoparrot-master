@extends('pages.AdminSubsystem.layout', 
[
    'title' => 'Edit Currency'
])

@section('content')

    @include('pages.AdminSubsystem.common.header') 

    @php
        $name = old('name') ? old('name') : $currency['name'];
        $acronym = old('acronym') ? old('acronym') : $currency['acronym'];
        $symbol = old('symbol') ? old('symbol') : $currency['symbol'];
        $usd_value = old('usd_value') ? old('usd_value') : $currency['usd_value'];
        $description = old('description') ? old('description') : $currency['description'];
        $full_description = old('full_description') ? old('full_description') : $currency['full_description'];
        $meta_title = old('meta_title') ? old('meta_title') : $currency['meta_title'];
        $meta_description = old('meta_description') ? old('meta_description') : $currency['meta_description'];
        $seo_description = old('seo_description') ? old('seo_description') : $currency['seo_description'];
        $seo_title = old('seo_title') ? old('seo_title') : $currency['seo_title'];
        $asset_description = old('asset_description') ? old('asset_description') : $currency['asset_description'];
        $links = $currency['links'];
    @endphp          

    <div class="row">
        <div class="col-lg-10">
            <h2 class="font-weight-bold mb-4">Edit {{ $name }}</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="/admin">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="/admin/currencies">Currencies</a>
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
    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-lg-8">
 
                            @csrf
                          
                            <input type="hidden" name="currency_id" value="{{$currency['id']}}">    


                            <div class="row">

                                <div class="col-lg-6">

                              
                                    <label class="control-label">Title</label>
                                    <input value="{{$name}}" name="name" class="form-control mb-3">

                                    <label class="control-label">Acronym</label>
                                    <input value="{{$acronym}}" name="acronym" class="form-control  mb-3">
                          

                                </div>
                               
                                <div class="col-lg-6">

                                  
                                        <label class="control-label">Symbol</label>
                                        <input value="{{$symbol}}" name="symbol" class="form-control  mb-3">
                                    
                                    
                                        <label class="control-label">USD Value</label>
                                        <input value="{{$usd_value}}" name="usd_value" class="form-control  mb-3">
                                   

                                </div>


                            </div>
                    
                   

                            <h4 class="font-weight-bold">Descriptions</h4>
                            
                      

                            <label class="control-label">Description</label>
                            <textarea style="min-height: 100px;" name="description" class="form-control mb-3">{{$description}}</textarea>

                         
                            <label class="control-label">Full Description</label>
                            <textarea style="min-height: 300px;" name="full_description" class="form-control mb-3">{{$full_description}}</textarea>
                           

       
                            <label class="control-label">Asset Description</label>
                            <textarea name="asset_description" class="form-control">{{ $asset_description }}</textarea> 
                           

                     
        

            </div>
            <div class="col-lg-4">
                
                        <h4 class="font-weight-bold">Links</h4>
                      

                        @if($cryptoCurrenciesLinkTypes)
                            @foreach($cryptoCurrenciesLinkTypes as $key => $label) 
                 
                          
                                        <label class="control-label">{{$label}}</label>
                                   
                                        @if($links && array_key_exists($key, $links))
                                            <input name="links[{{$key}}]" value="{{$links[$key]}}" class="form-control mb-3">
                                        @else
                                            <input name="links[{{$key}}]" class="form-control mb-3">
                                        @endif
                                                                                                                     
                            @endforeach 
                        @endif                                                                     
                                        

             
                        <h5 class="font-weight-bold mt-4">SEO</h5>
                       
            
                        <label class="control-label">Meta title</label>
                        <input type="text" value="{{$meta_title}}" name="meta_title" class="form-control">
                   
                        <label class="control-label">Meta Description</label>
                        <textarea name="meta_description" class="form-control">{{$meta_description}}</textarea>
                        
                        <label class="control-label">Seo title</label>
                        <input type="text" value="{{ $seo_title }}" name="seo_title" class="form-control">
                        
                        <label class="control-label">Seo Description</label>
                        <textarea name="seo_description" class="form-control">{{ $seo_description }}</textarea>
                   

                          
                        <button class="btn btn-primary mt-4" type="submit">Update</button>
                           
                    
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
    </div>
     </form>

    @include('pages.AdminSubsystem.common.footer') 

@endsection