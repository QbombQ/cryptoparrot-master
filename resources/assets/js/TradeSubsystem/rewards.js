$ = jQuery;

import * as Ladda from 'ladda';

$(document).ready(function() {

    $('body').on('click', '.claim-reward', function(e) {

        var rewardId = $(this).attr('data-id');
        var info = $(this).attr('data-info');
        var reward = $(this).attr('data-reward');
 
        $('#reward-order-form').each(function() {
            $(this).attr('action', '/app/rewards/buy/'+rewardId);
            $('#additional-reward-info-popup').html(info);
            $('#reward-popup-title').html(reward);
        });

    });

    $('.exchange-form').on('submit', function(e) {

        e.preventDefault();
        $('.exchange-order-errors').html('');
        $('.exchange-order-errors').hide();
        var laddaButton = Ladda.create($(this).find('button[type="submit"]')[0]);
        laddaButton.toggle();
        var data = new FormData($(this)[0]);
        var form = $(this)[0];
        axios({
            method: 'post',
            url: $(this).attr('action'),
            responseType: 'json',
            data: data
        }).then(function (response) {
            laddaButton.stop();
            if(response.data.success) {
                $('.exchange-order-errors').html(response.data.message);
                $('.exchange-order-errors').show();
                $(form).trigger('reset');
                setTimeout(function() {
                    location.reload();
                }, 2000);
            }else{
                $('.exchange-order-errors').html(response.data.message);
                $('.exchange-order-errors').show();
            }
        });
        

    });

    $('#reward-order-form').on('submit', function(e){

        e.preventDefault();
        $('.reward-order-errors').html('');
        $('.reward-order-errors').hide();
        var laddaButton = Ladda.create($(this).find('button[type="submit"]')[0]);
        laddaButton.toggle();
        var data = new FormData($(this)[0]);
        axios({
            method: 'post',
            url: $('#reward-order-form').attr('action'),
            responseType: 'json',
            data: data
        }).then(function (response) {
            laddaButton.stop();
            if(response.data.success) {
                $('.reward-order-errors').html(response.data.message);
                $('.reward-order-errors').show();
                $("#reward-order-form").trigger('reset');
                setTimeout(function() {
                    location.reload();
                }, 2000);
            }else{
                $('.reward-order-errors').html(response.data.message);
                $('.reward-order-errors').show();
            }
        });
        
    });

});