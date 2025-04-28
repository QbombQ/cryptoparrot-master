import * as Ladda from 'ladda';

$(document).ready(function() {

    var datepicker_args = {
        endDate: "-4745d",
        startView: 2,
        maxViewMode: 2 
    };  

    $('#verification-dob').datepicker(datepicker_args);  
  
    $('#submitVerificationInformation, #createStripeAccount').submit(function(e) {
        e.preventDefault();
        $('#success-alert, #error-alert').hide();

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
            console.log(response.data);
            if(response.data.success === true) {  

                $('[data-step="'+response.data.step+'"]').removeClass('not-complete'); 

                $('#submitVerificationInformation').html(response.data.html); 
                if($('#createStripeAccount:visible').length > 0) {
                    $('#createStripeAccount').hide();
                    $('#submitVerificationInformation').show();
                }

                if(response.data.step == 'type') $('#verification-dob').datepicker(datepicker_args); 

            } else {
                $('#error-alert-text').html(response.data.message);
                $('#error-alert').show();
            }
            $('html, body').animate({
                scrollTop: $("main").offset().top
            }, 1000);            
        });
    });

    
});