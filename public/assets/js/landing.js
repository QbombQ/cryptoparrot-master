$.fn.isInViewport = function() {

  var elementTop = $(this).offset().top;
  var elementBottom = elementTop + $(this).outerHeight();

  var viewportTop = $(window).scrollTop();
  var viewportBottom = viewportTop + $(window).height();

  return elementBottom > viewportTop && elementTop < viewportBottom;
};

const numberWithCommas = (x) => {
  var parts = x.toString().split(".");
  parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
  return parts.join(".");
}

function listenForEvents(){

    window.Echo.channel('price-updated')
    .listen('CurrencyUpdated', (e) => {
        updatePair(e);
    }); 
    
} 

function updatePair(e){
    
    console.log(e);
    $('.card-' + e.pairId).removeClass('up down');
 
    if (e.direction == 'up') {
        $('.card-' + e.pairId).addClass("up");
        $('.card-' + e.pairId+' .pct').addClass("pct-up");
    }else if (e.direction == 'down') {
        $('.card-' + e.pairId).addClass("down");
        $('.card-' + e.pairId+' .pct').addClass("pct-down");
    } 

    $('.card-' + e.pairId+' .pct').removeClass("pct-up pct-down");
    $('.col-card-' + e.pairId).data('change',e.change); 

    if(parseFloat(e.change) > 0) $('.card-' + e.pairId+' .pct').addClass("pct-up");
    if(parseFloat(e.change) < 0) $('.card-' + e.pairId+' .pct').addClass("pct-down");
 
    $('.card-' + e.pairId +' .pct').html((parseFloat(e.change)).toFixed(2)+'%');
    $('.pair-price-'+e.pairId).html(e.price);  

}  


$(document).ready(function() { 


    listenForEvents();
 
    $('#how-it-works,#learn-more-button').on('click',function(e){
        e.preventDefault();
        $('html,body').animate({scrollTop: $('#how-it-works-section').offset().top},'slow');
    });

	$('.customer-logos').slick({
        slidesToShow: 5,
        slidesToScroll: 5,
        autoplay: true,
        infinite: true,
        autoplaySpeed: 3000,
        centerMode: true,
        arrows: false,
        variableWidth: false, 
        dots: false,
        pauseOnHover: false,
        responsive: [{
            breakpoint: 1200,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 3,
            }
        },{
            breakpoint: 768,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 2,
            }
        }, {
            breakpoint: 360,
            settings: {
                slidesToShow: 1
            } 
        }]
    });


    /*if($("#register").length > 0) {
    $('#register').formValidation({
        framework: 'bootstrap4', 
        icon: {
            valid: 'far fa-check',
            invalid: 'far fa-times',
            validating: 'glyphicon glyphicon-refresh'
        }, 
        err: {
            // You can set it to popover
            // The message then will be shown in Bootstrap popover
            container: 'tooltip'
        },
        fields: { 
            email: {
            	row: '.input-group',
                validators: {
                    notEmpty: {
                        message: 'The email address is required'
                    },
                    emailAddress: {
                        message: 'The input is not a valid email address'
                    },
                    regexp: {
                        regexp: '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
                        message: 'The value is not a valid email address'
                    }
                }
            },
            agree: {
            	row: '.custom-control',
                validators: {
                    notEmpty: {
                        message: 'You must agree to TOS & Privacy Policy'
                    },
                }
            },
            username: { 
            	row: '.input-group',
                validators: {
                    notEmpty: {
                        message: 'The username is required'
                    },
                    stringLength: {
                        min: 2,
                        max: 30,
                        message: 'The username must be more than 1 and less than 30 characters long'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9_\.]+$/,
                        message: 'The username can only consist of alphabetical, number, dot and underscore'
                    }
                } 
            },
            password: { 
            	row: '.input-group',
                validators: {
                    notEmpty: {
                        message: 'The password is required'
                    },
                    stringLength: {
                        min: 6,
                        message: 'The username must be more than 5 characters long'
                    },
                    different: {
                        field: 'username',
                        message: 'The password cannot be the same as username'
                    } 
                }
            },
        }
    });
    }*/



});