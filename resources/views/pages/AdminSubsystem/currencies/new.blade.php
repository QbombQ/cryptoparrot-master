@extends('pages.AdminSubsystem.layout', 
[
    'title' => 'New Currency'
])

@section('content')

    @include('pages.AdminSubsystem.common.header') 

    <div class="row">
        <div class="col-lg-10">
            <h2 class="font-weight-bold mb-3">Add new currency</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="/admin">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="/admin/currencies">Currencies</a>
                </li>                
                <li class="breadcrumb-item active">
                    <strong>New</strong>
                </li>
                
            </ol>
        </div>
        <div class="col-lg-2">

        </div>
    </div>
    <div class="wrapper wrapper-content">
        <form method="post" action="" class="form-horizontal">
        <div class="row">
            <div class="col-lg-8">

                       
                            @csrf
                            <h4 class="font-weight-bold">Main</h4>
                          
                            <div class="row">
                            <div class="col-lg-6">

                            <label class="control-label">Title</label>
                            <input id="article-title"  type="text" value="{{ old('name') }}" name="name" placeholder="Bitcoin" class="form-control mb-3">

                            <label class="control-label">Acronym</label>
                            <input type="text" value="{{ old('acronym') }}" name="acronym" placeholder="BTC" class="form-control mb-3">
                        
                            </div>
                            <div class="col-lg-6">

                            <label class="control-label">Symbol</label>
                            <input type="text" value="{{ old('symbol') }}" name="symbol" placeholder="B" class="form-control mb-3">

                            
                            <label class="control-label">USD Value</label>
                            <input type="text" value="{{ old('usd_value') }}" name="usd_value" placeholder="1000" class="form-control mb-3">

                            </div>
                            </div>

                            <h4 class="font-weight-bold">Descriptions</h4>

                             
                            <label class="control-label">Description</label>
                            <textarea name="description" class="form-control mb-3">{{ old('description') }}</textarea>
                    
                             
                            <label class="control-label">Full Description</label>
                            <textarea name="full_description" class="form-control mb-3">{{ old('full_description') }}</textarea>
                      
                            
                             
                            <label class="control-label">Asset Description</label>
                            <textarea name="asset_description" class="form-control mb-3">{{ old('asset_description') }}</textarea>
                   
                             
                        
                                                     
                        
               
            </div>
            <div class="col-lg-4">

                            <h4 class="font-weight-bold ">Links</h4>

                            @if($cryptoCurrenciesLinkTypes)
                                @foreach($cryptoCurrenciesLinkTypes as $key => $label) 

                                    <label class="control-label">{{$label}}</label>
                                    <input name="links[{{$key}}]" class="form-control mb-3">                                                                         
                                    
                                @endforeach
                            @endif 

                            <h4 class="font-weight-bold mt-4">SEO</h4>

                                <label class="control-label">Meta title</label>
                            <input type="text" value="{{ old('meta_title') }}" name="meta_title" class="form-control mb-3">
                            
                                                       
                            <label class="control-label">Meta Description</label>
                            <textarea name="meta_description" class="form-control">{{ old('meta_description') }}</textarea>
                           
                             
                            <label class="control-label">Seo title</label>
                            <input type="text" value="{{ old('seo_title') }}" name="seo_title" class="form-control mb-3">
                           
                                                       
                            <label class="control-label">Seo Description</label>
                            <textarea name="seo_description" class="form-control">{{ old('seo_description') }}</textarea>
                                                                                               
                            
                          
                                    <button class="btn btn-primary mt-4" type="submit">Create</button>
                           
                        
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
    </div>

     @include('pages.AdminSubsystem.common.footer') 

@endsection