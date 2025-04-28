$ = jQuery;

import * as Ladda from 'ladda';

$(document).ready(function() {


    $('#trade-filter-select').select2({
         minimumResultsForSearch: -1,
    }); 

    if(hasTrades){

    $('#active-orders-table').DataTable( {
        scrollX:        true,
        paging:         false,
        fixedColumns:   {
            rightColumns: 1
        },
        order: [[0, 'desc']]
    }); 

    }else{

 

    }

    new ScrollHint('.js-scrollable');

    $('#trade-filter-select').on('change', function(e) {
 
        var filter = $('#trade-filter-select').val();
        window.location = '/app/my-trades?status='+filter;

    });  
 
    $('body').on('click', '.manage-trade', function(e) {

        var tradeId = $(this).attr('data-id');
        var stopLoss = $(this).attr('data-sl').slice(1).replace(',', '');
        var takeProfit = $(this).attr('data-tp').slice(1).replace(',', '');
 
        $('#manage-trade-form').each(function() {
            $(this).attr('action', '/app/trades/edit/'+tradeId);
            $(this).find('input[name="stop_loss"]').val(stopLoss);
            $(this).find('input[name="take_profit"]').val(takeProfit);
        });

    });

    $('#manage-trade-form').on('submit', function(e){

        e.preventDefault();
        $('.manage-trade-errors').html('');
        $('.manage-trade-errors').hide();
        var laddaButton = Ladda.create($(this).find('button[type="submit"]')[0]);
        laddaButton.toggle();
        var data = new FormData($(this)[0]);
        axios({
            method: 'post',
            url: $('#manage-trade-form').attr('action'),
            responseType: 'json',
            data: data
        }).then(function (response) {
            laddaButton.stop();
            if(response.data.success) {
                $('.manage-trade-errors').html(response.data.message);
                $('.manage-trade-errors').show();
                setTimeout(function() {
                    location.reload();
                }, 2000);
            }else{
                $('.manage-trade-errors').html(response.data.message);
                $('.manage-trade-errors').show();
            }
        });
        
    });

});