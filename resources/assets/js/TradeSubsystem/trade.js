$ = jQuery;

import * as Ladda from 'ladda';

$.extend($.expr[':'], {
  'containsi': function(elem, i, match, array) {
    return (elem.textContent || elem.innerText || '').toLowerCase()
        .indexOf((match[3] || "").toLowerCase()) >= 0;
  }
});

var currentRate;
var currentBuyAcronym;
var currentSellAcronym;
var currentType;
var currentMarket;
var currentSellLimit;
var currentBuyLimit;
var currentSellLimitLeft;
var currentBuyLimitLeft;
var currentBuyLimitPercent;
var currentSellLimitPercent;
var currentSymbol;
var currentPairId;
var currentLimitSymbol;
var quickBalance;
var quickChange;

Ladda.bind( 'button[type=submit]' );

$(document).ready(function() { 

    recalculateLimits();
    postTradeOnSubmit();
    calculateNumbers();
    updateTradeView(); 
    openFileSelectOnUploadImageIconClick();
    changeMarketOnSelect();
    openLeverageOnAdvancedCheck();  
    calculateTotal();
    changeTradeType();
    changeSourceType();
    showImageAfterSelect();  
    filterPairs();   
    toggleMarketSelect();   
    tradeModalControls();   
    tradeModalResize();   
    setMarketViaCard();  

    $('.trade-modal').on('open',function(){

        updateTradeView();

    }); 

    $.getJSON( "/data/mention.json", function( data ) {
        mentionData = data;
        $('textarea').mentionsInput({
            onDataRequest:function (mode, query, callback) {
              data = _.filter(mentionData, function(item) { return item.name ? item.name.toLowerCase().indexOf(query.toLowerCase()) > -1 : false});
              callback.call(this, data);
            }
          });              
    });  

    $(".alert-dismissible").fadeTo(2000, 500).slideUp(500, function(){
        $(".alert-dismissible").alert('close');
    });  

    $('#leverage-select').select2({
        minimumResultsForSearch: -1,
        closeOnSelect: true,
        width:'100%',
        containerCssClass:'select-2-lg', 
        placeholder: "None",
    });  

  
}); 

function tradeModalControls(){

    $('.shade,.main-navbar-shade,#close-trade').on('click',function(e){

        e.preventDefault();
        dismissNewTrade();
 
    });

    if(window.location.hash) {
        
        var hash = window.location.hash.substring(1);

        if(hash == 'trade'){
            
            $('.trade-modal').addClass('open');
            $('body').addClass('shade-active');

            if ("replaceState" in history) history.replaceState(null, null, ' ');

        }

    }  

}

function dismissNewTrade(){

    $('.trade-modal').removeClass('open'); 
    $('body').removeClass('shade-active shade-active modal-open');
    //$("html, body").animate({ scrollTop: 0 }, 0);

    const scrollY = document.body.style.top;
    document.body.style.position = '';
    document.body.style.top = '';
    document.body.style.bottom = '';
    document.body.style.right = '';
    document.body.style.left = '';
    window.scrollTo(0, parseInt(scrollY || '0') * -1);

}

function setMarketViaCard(){

    $('.card-widget').on('click',function(e){

        e.preventDefault();
        $('input[data-trade-pair-id="'+$(this).data('pair-id')+'"]').attr('checked', true).trigger('change');
        $('.trade-modal').addClass('open');
        $('body').addClass('shade-active');

    });  
 
}

function tradeModalResize(){

    new ResizeSensor($('.trade-modal'), function(){ 
        
        var windowHeight = $(window).outerHeight();
        var modalHeight = $('.trade-modal').outerHeight();

        if(modalHeight >= windowHeight ||  (windowHeight - modalHeight) < 2) $('.trade-modal').addClass('no-radius');
        else $('.trade-modal').removeClass('no-radius');
   
    }); 

}
function toggleMarketSelect(){

    $('.market-select').on('click',function(e){

        e.preventDefault();

        if($('#make-trade').hasClass('d-none')){
            $('#make-trade').removeClass('d-none');
            $('#change-market').addClass('d-none');
        }else{
            $('#make-trade').addClass('d-none');
            $('#change-market').removeClass('d-none');
        }
 
    });

}

function filterPairs(){

    $('#filterPairs').keyup(function() {
    var query = $(this).val();
    $(".col-market")
        .hide()
        .filter(':containsi("' + query + '")')
        .show();
    });

    $('#clearfilterPairs').on('click',function(){

        $('#filterPairs').val('').trigger('keyup');   

    });
 
}

function recalculateLimits()
{

    window.Echo.channel('price-updated')
    .listen('CurrencyUpdated', (e) => {
        $('a[data-pair-id="'+e.pairId+'"]').each(function() {
            $(this).attr('data-rate', e.price.replace(',',''));
            if($('span.current-price .buy-acronym').text().trim().indexOf($(this).attr('data-buy-acronym')) > -1 && $('.sell-acronym').text().trim().indexOf($(this).attr('data-sell-acronym')) > -1) {
                $('.rate').html($(this).attr('data-rate'));
                updateTradeView();
            }
        });
        
    });  

}

function updateTradeView() {

    $('#limit-amount-tooltip').attr('data-original-title','Amount of '+currentBuyAcronym+' to '+currentType);
    
    if(parseFloat(quickChange) > 0) $('#quick-pct-change span').addClass('pct-up').removeClass('pct-down');
    else if(parseFloat(quickChange) < 0) $('#quick-pct-change span').addClass('pct-down').removeClass('pct-up');
    else $('#quick-pct-change span').removeClass('pct-up pct-down');

    $('#quick-pct-change span').html((parseFloat(quickChange)).toFixed(2)+'%');

    if(currentType == 'buy') {

        $('.action-limit').html(currentBuyLimit);
        $('.left-limit').html(currentBuyLimitLeft);
        $('.current-limit-left-symbol').html(currentLimitSymbol);
        $('#limit-progress').attr('style', 'width: '+currentBuyLimitPercent+'%');
        $('#limit-progress').attr('aria-valuenow', currentBuyLimitPercent);
        $('#market-tooltip').attr('data-original-title','Amount of '+currentSellAcronym+'</span> to be spent to buy '+currentBuyAcronym+' at market price');
        $('#limit-price-tooltip').attr('data-original-title','Buy at fixed price per '+currentBuyAcronym);
 
        $('.market-field-label').html('Total');
        $('#market-field-acronym').attr('src','/assets/images/crypto-icons/color/'+currentSellAcronym.toLowerCase()+'.svg');
        
        $('.quick-view-acronym').attr('src','/assets/images/crypto-icons/color/'+currentSellAcronym.toLowerCase()+'.svg');
        
        quickBalance = $('[data-balance="'+currentSellAcronym+'"]').data('amount');
        if(!quickBalance) quickBalance = '0.00';
        $('#quick-portfolio-view').html(quickBalance);

        quickChange = $('#quick-pairs .col-card-'+currentBuyAcronym+currentSellAcronym).data('change');

        $('#calculations .sell-acronym-img').attr('src','/assets/images/crypto-icons/color/'+currentBuyAcronym.toLowerCase()+'.svg');
        $('.currentField').html('Total');
        $('#below_limit').html('SL');
        $('#above_limit').html('TP');
        $('#below_limit_tooltip').attr('data-original-title','Enter the '+currentBuyAcronym+' price in USD at which your order will close to prevent further losses. Please ensure that price is lower than the limit or market price.');
        $('#above_limit_tooltip').attr('data-original-title','Enter the '+currentBuyAcronym+' price in USD at which your order will close at to take profit. Please ensure that price is higher than the limit or market price.');
    
    }else{ 

        $('.action-limit').html(currentSellLimit);
        $('.left-limit').html(currentSellLimitLeft);
        $('.current-limit-left-symbol').html(currentLimitSymbol);
        $('#limit-progress').attr('style', 'width: '+currentSellLimitPercent+'%');
        $('#limit-progress').attr('aria-valuenow', currentSellLimitPercent);
        $('#market-tooltip').attr('data-original-title','Amount of '+currentBuyAcronym+'</span> to be sold at market price');
        $('#limit-price-tooltip').attr('data-original-title','Sell at fixed price per '+currentBuyAcronym);

        $('.market-field-label').html('Amount:');
        $('#market-field-acronym').attr('src','/assets/images/crypto-icons/color/'+currentBuyAcronym.toLowerCase()+'.svg');
        $('.quick-view-acronym').attr('src','/assets/images/crypto-icons/color/'+currentBuyAcronym.toLowerCase()+'.svg');
        
        quickBalance = $('[data-balance="'+currentBuyAcronym+'"]').data('amount');
        if(!quickBalance) quickBalance = '0.00'; 

        $('#quick-portfolio-view').html(quickBalance); 
        

        quickChange = $('#quick-pairs .col-card-'+currentBuyAcronym+currentSellAcronym).data('change');

        $('#calculations .sell-acronym-img').attr('src','/assets/images/crypto-icons/color/'+currentSellAcronym.toLowerCase()+'.svg');;
        $('.currentField').html('Total'); 
        $('#below_limit').html('TP');
        $('#above_limit').html('SL'); 
        $('#below_limit_tooltip').attr('data-original-title','Enter the '+currentBuyAcronym+' price in USD at which your order will close at to take profit. Please ensure that price is higher than the limit or market price.');
        $('#above_limit_tooltip').attr('data-original-title','Enter the '+currentBuyAcronym+' price in USD at which your order will close to prevent further losses. Please ensure that price is lower than the limit or market price.');
    }      

    if(currentMarket == 'off')
    {

        $('.group-limit').removeClass('d-none');
        $('.group-market').addClass('d-none');
        $('#calculations .sell-acronym-img').attr('src','/assets/images/crypto-icons/color/'+currentSellAcronym.toLowerCase()+'.svg');
        $('.currentField').html('Total');

    }else{

        $('.group-limit').addClass('d-none');
        $('.group-market').removeClass('d-none');
        if(currentType == 'buy') {
            $('#calculations .sell-acronym-img').attr('src','/assets/images/crypto-icons/color/'+currentBuyAcronym.toLowerCase()+'.svg');;
            $('.currentField').html('Amount');
        }

    }

    $('.trade-type').html(currentType);

    calculateTotal();

}

function calculateTotal() {

    var market = $('#post-trade-form input[name="market"]:checked').val();
    var amount =  $('#post-trade-form input[name="amount"]').val();
    var price =  $('#post-trade-form input[name="price"]').val();
    var total =  $('#post-trade-form input[name="total"]').val();
    var market_rate = parseFloat($('#market-rate').html().replace(',', ''));

    if(market == 'off'){

        if(amount && price) var est_total = (amount * price).toFixed(2);
        else var est_total = 0;

        calculateFee(est_total, $('input[name="trade_pair_id"]').val());

    }else{


        if(currentType == 'buy') {

            var est_total = (total / market_rate).toFixed(4);
            calculateFee(total, $('input[name="trade_pair_id"]').val());

        }else{

            var est_total = (total * market_rate).toFixed(4);
            calculateFee(est_total, $('input[name="trade_pair_id"]').val());

        }

    }
 
    $('.estimated-total').val(est_total);
    

}

function calculateFee(amount, tradePairId)
{

    var market = $('#post-trade-form input[name="market"]:checked').val();
    var leverage = $('#leverage-select').val();
    var market_rate = parseFloat($('#market-rate').html().replace(',', ''));
    var action = $('input[name="type"]:checked').val();
    
    var type = 'market';

    if(market == 'off')
    {

        type = 'limit';

    }
 
    axios({	
        method: 'post',
        url: '/api/price-in-usd',
        responseType: 'json',
        data: {
            amount: amount, 
            trade_pair_id: tradePairId, 
            trade_type: type, 
            market_rate: market_rate,
            leverage: leverage,
            action: action
        }
    }).then(function (response) { 

        var fee = response.data.symbol + response.data.fee.toFixed(response.data.precision);
        $('#fee-calculated').html(fee);

        //var currentTotal = parseFloat($('.estimated-total').val());
        //currentTotal -= response.data.fee;
        //if(currentTotal < 0) currentTotal = 0;
        //$('.estimated-total').val(currentTotal.toFixed(response.data.precision));

    });  

}

function calculateNumbers()
{

    $('.numbers-input').keyup(function(){
        var val = $(this).val();
        if(isNaN(val)){
             val = val.replace(/[^0-9\.]/g,'');
             if(val.split('.').length>2) 
                 val =val.replace(/\.+$/,"");
        }
        $(this).val(val); 
    }).on('paste', function(event) {
        $(this).keyup();
    });

    $("#customFile").change(function() {
        readURL(this);
    });    

    currentBuyAcronym = $('#current-pair-span .buy-acronym').text();
    currentSellAcronym = $('#current-pair-span .sell-acronym').text();
    currentType = $('input[name="type"]:checked').val();
    currentMarket =  $('input[name="market"]:checked').val();
    currentSellLimit = $('#select-market .portfolio-buttons label.active input').attr('data-sell-volume-limit');
    currentBuyLimit = $('#select-market .portfolio-buttons label.active input').attr('data-buy-volume-limit');
    currentSellLimitLeft = $('#select-market .portfolio-buttons label.active input').attr('data-sell-limit-left');
    currentBuyLimitLeft = $('#select-market .portfolio-buttons label.active input').attr('data-buy-limit-left');
    currentLimitSymbol = $('#select-market .portfolio-buttons label.active input').attr('data-limit-symbol');
    currentBuyLimitPercent = $('#select-market .portfolio-buttons label.active input').attr('data-buy-limit-percent');
    currentSellLimitPercent = $('#select-market .portfolio-buttons label.active input').attr('data-sell-limit-percent');
    currentSymbol = $('#select-market .portfolio-buttons label.active input').attr('data-symbol');

    $('input[name="amount"],input[name="price"],input[name="total"]').on('keyup',function(){

        calculateTotal();
        $('.limit-exceeded-warning').hide();
        var data = $('#tradeForm').serializeArray().reduce(function(obj, item) {
           obj[item.name] = item.value;
           return obj;
       }, {});
       limitExceeded();

    });

}

function limitExceeded()
{

    var form = $('#post-trade-form')[0];
    var data = new FormData(form);

    $.ajax({
        url: '/app/trade/limit',
        dataType: 'text',
        type: 'post',
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        success: function( data, textStatus, jQxhr ){

            var parsedData = JSON.parse(data);

            if(parsedData.success != true) {

                $('.limit-exceeded-warning').show();

            }

        }
    });

}

function postTradeOnSubmit()
{

    $('#post-trade').on('click',function(e){

        e.preventDefault();

        var fileRemoved = false;

        $('#messages-col-trade').html('');

        $('#post-trade-form').find("input[type='file']").each(function(){
           if ($(this).get(0).files.length === 0) {
               $(this).remove();
               fileRemoved = true;
            }
        });

        var form = $('#post-trade-form')[0];
        var data = new FormData(form);
        var laddaButton = Ladda.create($(this)[0]);
        laddaButton.toggle();

        $.ajax({
            url: $(form).attr('action'),
            dataType: 'text',
            type: 'post',
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            success: function( data, textStatus, jQxhr ){

                if(fileRemoved)
                {

                    $('#analysis-field-wrapper').prepend(
                        '<input id="analysis-field" style="position: absolute; top: -999px;" type="file" name="analysis" class="form-control"/>'
                    );

                }

                laddaButton.stop();
                var parsedData = JSON.parse(data);

                if(parsedData.success == true) {

                    $('#messages-col').html(`
                      
                        <div class="toast-block">
                         
                          <div class="toast success" role="alert" aria-live="assertive" aria-atomic="true">
                          
                            <div class="toast-body"> 
                            
                            <div class="text-white">
                                <i class="fa fa-check-circle mr-1"></i> 
                                ${parsedData.message}
                            </div>
 
                            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                                <span class="iconify" data-icon="ant-design:close-circle-outlined" data-inline="false"></span>
                              </button>

                            </div>
                          </div>
                          
                        </div>

                    `); 

                    $('.toast.success').toast({'delay':5000,'autohide':true}); 
                    $('.toast.success').toast('show'); 
 
                    dismissNewTrade();
 
                    //$('#post-trade-form')[0].reset();
                    $('input[name="total"], textarea[name="description"], input[name="above_limit"], input[name="below_limit"], input[name="amount"]').val('');
                
                    $('#leverage-select').val('0').trigger('change');
                  
                    $('.link-meta-info').html('').removeClass('image-preview video-preview tradingview-preview link-meta-preview');
                    $('input[name="link"]').val("");
                    $('input[name="source_type"]').val("");
                    $('#analysis-field-wrapper').hide(); 

                    $("html, body").animate({ scrollTop: 0 }, "slow");

                    axios({
                    
                        method: 'get',
                        url: '/app/current-portfolio-html',
                        responseType: 'json'
                        
                    }).then(function (response) {

                        //TBA
                        $('#portfolio-card-wrapper').html(response.data.html);
                    
                    });

                } else {

                    var errorHtml = '';

                    $.each( parsedData.errors, function( key, value ) {
                        errorHtml += `<div class="text-danger">
                                <i class="fa fa-exclamation-circle mr-1"></i> 
                                ${value}
                            </div>
                        `; 
                    });

                    $('#messages-col-trade').html(`

                        <div style="position: fixed;bottom: 2rem;right: 2rem;z-index: 99999;">
                         
                          <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                          
                            <div class="toast-body"> 
                            
                             ${errorHtml}
 
                            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                                <span class="iconify" data-icon="ant-design:close-circle-outlined" data-inline="false"></span>
                              </button>

                            </div>
                          </div>
                          
                        </div>

                    `);  

                    $('.toast').toast({'delay':5000,'autohide':false}); 
                    $('.toast').toast('show'); 
 
                }
            },
            error: function( jqXhr, textStatus, errorThrown ){
                
                if(fileRemoved)
                {

                    $('#analysis-field-wrapper').prepend(
                        '<input id="analysis-field" style="position: absolute; top: -999px;" type="file" name="analysis" class="form-control"/>'
                    );

                }
                console.log( errorThrown );
            }
        });

    });

}

function openFileSelectOnUploadImageIconClick()
{

    $('body').on('click', '#upload-image-analysis-button', function(e) {

        e.preventDefault();
        $('#analysis-field').focus().trigger('click');

    });

}

function changeMarketOnSelect()
{

    $('.portfolio-buttons input[name="market"]').on('change', function() {

        var optionSelected = $(this);

        axios({	
            method: 'post',
            url: '/app/save-pair/'+optionSelected.attr('data-trade-pair-id'),
            responseType: 'json' 
        }).then(function (response) { 

        }); 

        currentRate = optionSelected.attr('data-rate');
        currentBuyAcronym = optionSelected.attr('data-buy-acronym');
        currentSellAcronym = optionSelected.attr('data-sell-acronym');
        currentSellLimit = optionSelected.attr('data-sell-volume-limit');
        currentBuyLimit = optionSelected.attr('data-buy-volume-limit');
        currentSellLimitLeft = optionSelected.attr('data-sell-limit-left');
        currentBuyLimitLeft = optionSelected.attr('data-buy-limit-left');
        currentLimitSymbol = optionSelected.attr('data-limit-symbol');
        currentSellLimitPercent = optionSelected.attr('data-sell-limit-percent');
        currentBuyLimitPercent = optionSelected.attr('data-buy-limit-percent');
        currentSymbol = optionSelected.attr('data-symbol');
        currentPairId = optionSelected.attr('data-trade-pair-id');

        $('.btn-market').removeClass('active');
        $(this).closest('.btn-market').addClass('active');

        $('#market-rate').removeClass().addClass('pair-price-'+currentBuyAcronym+currentSellAcronym).html(numberWithCommas(currentRate));
        $('#quick-pct-change span').removeClass().addClass('pair-pct-'+currentBuyAcronym+currentSellAcronym).html(numberWithCommas(currentRate));
        
        $('#market-rate-symbol').html(currentSymbol); 

        $('.buy-acronym').html(currentBuyAcronym);
        $('.sell-acronym').html(currentSellAcronym);

        $('.buy-acronym-img').attr('src','/assets/images/crypto-icons/color/'+currentBuyAcronym.toLowerCase()+'.svg');;
        $('.sell-acronym-img').attr('src','/assets/images/crypto-icons/color/'+currentSellAcronym.toLowerCase()+'.svg');;
 
        $('.current-limit-left-symbol').html(currentLimitSymbol);
        $('.symbol').html(optionSelected.attr('data-symbol'));
        $('.rate').html(optionSelected.attr('data-rate'));
        $('input[name="price"]').val(optionSelected.attr('data-rate'));
        $('input[name="trade_pair_id"]').val(currentPairId);

        updateTradeView();

        $('#make-trade').trigger('marketSelected'); 

        $('#make-trade').removeClass('d-none');
        $('#change-market').addClass('d-none');

        calculateTotal();

    }); 

    $('input[name="market"]').on('change',function(){
        currentMarket = $(this).val();
        updateTradeView();

    });

}

function numberWithCommas(x) {
    var parts = x.toString().split(".");
    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    return parts.join(".");
}

function openLeverageOnAdvancedCheck()
{

    $("#advanceToggle:checkbox").bind('click dblclick', function(evt) {

        if ($(this).is(":checked")) {
            $('#advanced-options').show();
        } else {
            $('#advanced-options').hide();
        }
    });

}

function changeTradeType()
{

    $('#stopType').on('click', function() {
        currentMarket = 'off';
        $('input[name="stop"]').val('on');
        updateTradeView();
    });

    $('#limitType').on('click', function() {
        currentMarket = 'off';
        $('input[name="stop"]').val('off');
        updateTradeView();
    }); 
    
    $('#marketType').on('click', function() {
        currentMarket = 'on';
        $('input[name="stop"]').val('off');
        updateTradeView();
    });        

    $('input[name="type"]').on('change',function(){

        currentType = $(this).val();
        updateTradeView();

    }); 

}

function changeSourceType()
{

    $('input[name="source_type"]').on('change',function(){

        switch($(this).val()){
            case 'link':
                $('#public-link').collapse('show');
                $('#public-tradingview').collapse('hide');
                $('#public-youtube').collapse('hide');
                $('#public-image').collapse('hide'); 
                break;
            case 'image':
                $('#public-link').collapse('hide');
                $('#public-tradingview').collapse('hide');
                $('#public-youtube').collapse('hide');
                $('#public-image').collapse('show');
                break;
            case 'trading_view':
                $('#public-link').collapse('hide');
                $('#public-image').collapse('hide');
                $('#public-youtube').collapse('hide');
                $('#public-tradingview').collapse('show');
                break;
            case 'video':
                $('#public-link').collapse('hide');
                $('#public-image').collapse('hide');
                $('#public-tradingview').collapse('hide');
                $('#public-youtube').collapse('show');
                break;
            default:
                break;
        } 

    });

}

function showImageAfterSelect()
{

    $("body").on("change", "#analysis-field", function(){
        readURL(this);
    });

}

function readURL(input)
{
    
    if (input.files && input.files[0])
    {

        var reader = new FileReader();
        reader.onload = function (e) {

            $('.link-meta-info').removeClass('image-preview video-preview tradingview-preview link-meta-preview');
          
            $('.link-meta-info').html('<div class="trade-img-preview" style="background-image:url('+e.target.result+');"></div>');
            $('.link-meta-info').addClass('image-preview').show();
            $('#analysis-field-wrapper').show();
            if($('input[name="source_type"]').length > 0)
            {
                $('input[name="source_type"]').val('image');
            }else{
                $('#post-trade-form input[name="_token"]').after('<input type="hidden" name="source_type" value="image">');
            }
        }

        reader.readAsDataURL(input.files[0]);
    }

}