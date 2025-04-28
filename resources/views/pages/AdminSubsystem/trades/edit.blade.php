@extends('pages.AdminSubsystem.layout', 
    [
    'html_class' => 'homepage', 
    'title' => 'Edit Trade - CryptoParrot',
    ]
)
 
@section('content')

    @include('pages.AdminSubsystem.common.header') 
 
        <div class="row">

          @if(Session::has('alert'))
          <div class="col-xl-12 pb-2 mt-4">
              <div class="alert alert-warning">{!! session('alert') !!}</div>
          </div>
          @endif

    
        </div>

        <h2 class="mb-4 font-weight-bold">Edit Trade</h2>


        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif


        <div class="row">
        <div class="col-xl-9">


         <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="/admin">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="/admin/trades">Trades</a>
                </li>                
                <li class="breadcrumb-item active">
                    <strong>Edit</strong>
                </li>
                
            </ol>

    
    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-lg-8">
          
                            <form method="post" enctype="multipart/form-data" action="" class="form-horizontal">                    
                            @csrf
                            <input type="hidden" name="trade_id" value="{{$trade['id']}}">


                            <div class="row">
                                <div class="col-xl-6">
                                      <div class="form-group">
                                <div class="">
                                    <input type="hidden" name="public" value="off"/>
                                    <input type="checkbox" name="public" @if($trade['public']) checked @endif />
                                    <label class="control-label">Public</label>
                                </div>
                            </div>
                                </div>
                                <div class="col-xl-6">
                                       <div class="form-group">
                                <div class="">
                                    <input type="hidden" name="follow" value="off"/>
                                    <input type="checkbox" name="follow" @if($trade['follow']) checked @endif />
                                    <label class="control-label">Follow</label>
                                </div>
                            </div>  
                                </div>
                            </div>

                          
                          
                            
                            <div class="trade-description-holder" data-step="8" data-intro="The description box is where you can add notes or thoughts on your trade, upload images, add links to articles and news, your TradingView charts and Youtube videos etc."> 

                            <textarea placeholder="Let others know more about your trade..."  name="description" class="form-control" spellcheck="true">{{$trade['description']}}</textarea> 

                            <div class="mt-4">
                            <input disabled name="source_type" value="{{$trade['source_type']}}"/>
                            <div class="trade-description-options">
                                
                                <a data-toggle="tooltip" data-placement="top" title="" data-original-title="Click to add/upload image or photo" id="upload-image-analysis-button" class="btn-upload-photo"><i class="far fa-image text-muted"></i></a>
            
                            </div>

                            </div>
                            </div>

                            <div class="full-preview-block mb-4">

                            <div id="analysis-field-wrapper">
                            <input id="analysis-field" style="position: absolute; top: -999px;" type="file" name="analysis" class="form-control"/>
                            <button class="btn btn-outline-primary" type="button" id="delete-analysis-image">Remove</button>
                            </div>

                            <div class="spinner-holder">
                            <div id="spinner"></div>
                            <div class="link-meta-info mt-2"></div>
                            </div>

</div> 
                            <div class="form-group">
                                <div class="">
                                    <button class="btn btn-primary btn-lg" type="submit">Update</button>
                                </div>
                            </div>
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
            <div class="col-lg-4">

                        <div class="form-group">
                            <div class="">
                                <input type="hidden" name="market" value="off"/>
                                <input type="checkbox" name="market" @if($trade['market']) checked @endif disabled="disabled" />
                                <label class=" control-label">Market</label>
                            </div>
                        </div>

                        <div class="form-group ">
                            <div class="">
                                <input type="hidden" name="stop" value="off"/>
                                <input type="checkbox" name="stop" @if($trade['stop']) checked @endif disabled="disabled" />
                                <label class=" control-label">Stop</label>
                            </div>
                        </div>           

                        <div class="form-group "><label class=" control-label">Amount</label>
                            <div class="">
                                <input class="form-control" type="text" name="amount" value="{{$trade['amount']}}" disabled="disabled" />
                            </div>
                        </div>    

                        <div class="form-group "><label class=" control-label">Status</label>
                            <div class="">
                                <input class="form-control" type="text" name="status" value="{{$trade['status']}}" disabled="disabled" />
                            </div>
                        </div>      

                        <div class="form-group "><label class=" control-label">Profit</label>
                            <div class="">
                                <input class="form-control" type="text" name="profit" value="{{$trade['profit']}}" disabled="disabled" />
                            </div>
                        </div>    

                        <div class="form-group "><label class=" control-label">Reserved sum</label>
                            <div class="">
                                <input class="form-control" type="text" name="reserved_sum" value="{{$trade['reserved_sum']}}" disabled="disabled" />
                            </div>
                        </div>        

                        <div class="form-group "><label class=" control-label">Portfolio</label>
                            <div class="">
                                <input class="form-control" type="text" name="portfolio" value="{{$trade['portfolio']}}" disabled="disabled" />
                            </div>
                        </div>        

                        <div class="form-group "><label class=" control-label">Below limit</label>
                            <div class="">
                                <input class="form-control" type="text" name="below_limit" value="{{$trade['below_limit']}}" disabled="disabled" />
                            </div>
                        </div>        

                        <div class="form-group "><label class=" control-label">Above limit</label>
                            <div class="">
                                <input class="form-control" type="text" name="above_limit" value="{{$trade['above_limit']}}" disabled="disabled" />
                            </div>
                        </div>        

                        <div class="form-group "><label class=" control-label">Fee</label>
                            <div class="">
                                <input class="form-control" type="text" name="fee" value="{{$trade['fee']}}" disabled="disabled" />
                            </div>
                        </div>      

                        <div class="form-group "><label class=" control-label">Total trade value</label>
                            <div class="">
                                <input class="form-control" type="text" name="total_trade_value" value="{{$trade['total_trade_value']}}" disabled="disabled" />
                            </div>
                        </div>   

                        <div class="form-group "><label class=" control-label">Type</label>
                            <div class="">
                                <input class="form-control" type="text" name="type" value="{{$trade['type']}}" disabled="disabled" />
                            </div>
                        </div>   

                        <div class="form-group "><label class=" control-label">Target price</label>
                            <div class="">
                                <input class="form-control" type="text" name="target_price" value="{{$trade['target_price']}}" disabled="disabled" />
                            </div>
                        </div>           

                        <div class="form-group "><label class=" control-label">Start price</label>
                            <div class="">
                                <input class="form-control" type="text" name="start_price" value="{{$trade['start_price']}}" disabled="disabled" />
                            </div>
                        </div>     

                        <div class="form-group "><label class=" control-label">Leverage</label>
                            <div class="">
                                <input class="form-control" type="text" name="leverage" value="{{$trade['leverage']}}" disabled="disabled" />
                            </div>
                        </div>        

                        <div class="form-group "><label class=" control-label">Votes</label>
                            <div class="">
                                <input class="form-control" type="text" name="votes" value="{{$trade['votes']}}" disabled="disabled" />
                            </div>
                        </div>       

                        <div class="form-group "><label class=" control-label">Pair</label>
                            <div class="">
                                <input class="form-control" type="text" name="pair" value="{{$trade['pair']}}" disabled="disabled" />
                            </div>
                        </div>                 

             
                   
            </div>
        </div>
    </div>


        </div>
        </div>



        @include('pages.AdminSubsystem.common.footer') 

@endsection  
  
@section('footer')

@endsection  




