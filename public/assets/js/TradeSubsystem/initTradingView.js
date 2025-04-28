function initTradingView(){

    $("[id^=trading_view_]:not(.completed)").each(function(i,element){

        var tv_id = $(element).attr('data-trading-view');

        var tradingview_embed_options = {};
        tradingview_embed_options.width = '100%';
        tradingview_embed_options.height = '400'; 
        tradingview_embed_options.chart = tv_id;
        tradingview_embed_options.noGraph = true;
        tradingview_embed_options.container_id = 'trading_view_'+tv_id; 
        tradingview_embed_options.styleWidgetNoBorder = true;
        new TradingView.chart(tradingview_embed_options);

        $(element).addClass('completed'); 

    });  

}   