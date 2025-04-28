$ = jQuery;
import * as Ladda from 'ladda';

$(document).ready(function() {

    $('#portfolio-create-form').on('submit', function(e) {

        e.preventDefault();
        $('#error-alert-portfolio').hide();
        var data = new FormData($(this)[0]);
        var laddaButton = Ladda.create($(this).find('button[type="submit"]')[0]);
        laddaButton.toggle();

        axios({
				
            method: $(this).attr('method'),
            url: $(this).attr('action'),
            responseType: 'json',
            data: data
            
        }).then(function (response) {
            laddaButton.stop();
            if(response.data.success === true) {
                location.reload();
                return;
            } else {
                $('#error-alert-text-portfolio').html(response.data.message);
                $('#error-alert-portfolio').show();
            }
        });   

    });

    $('input[type=radio][name=portfolio_id]').on('change', function(e) {

        e.preventDefault(); 
        $(this).parents('form').submit(); 

    });  

});