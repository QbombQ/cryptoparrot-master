$ = jQuery;
import * as Ladda from 'ladda';
import {Spinner} from 'spin.js';
import { throttle } from 'throttle-debounce';
import { renderGrid } from '@giphy/js-components';
import { GiphyFetch } from '@giphy/js-fetch-api';

const gf = new GiphyFetch('GHa0uyS4S2nMHPMACTlNr0E8FfudCaLQ');

var fetchGifs = (offset) => {
    // use whatever end point you want,
    // but be sure to pass offset to paginate correctly
    //return gf.trending({ offset, limit: 25 })
    return gf.search('bitcoin', { sort: 'relevant', lang: 'en', offset: offset, limit: 25, type: 'gifs' })
}

var innerWidth;
var gifForm;

// Creating a grid with window resizing and remove-ability
const makeGrid = (targetEl) => {
    const render = () => {
        // here is the @giphy/js-components import
        return renderGrid(
            {
                width: innerWidth,
                noResultsMessage: 'No gifs found, try different query',
                fetchGifs,
                columns: 3,
                gutter: 6,
                onGifClick: (gif, event) => {
                    event.preventDefault();

                    gifForm.find('[name="gif"]').val(gif.id)
                    gifForm.find('.gif-image').html('<img src="https://media.giphy.com/media/'+gif.id+'/giphy.gif">');
                    gifForm.find('.gif-holder').removeClass('d-none').addClass('d-flex');
                    $('#gif-modal').modal('hide');

                    console.log(gif);
                },
            }, 
            targetEl 
        ) 
    }
    const resizeRender = throttle(500, render)
    window.addEventListener('resize', resizeRender, false)
    const remove = render()
    return {
        remove: () => {
            remove()
            window.removeEventListener('resize', resizeRender, false)
        },
    } 
}

var opts = {
    lines: 11, // The number of lines to draw
    length: 23, // The length of each line
    width: 10, // The line thickness
    radius: 34, // The radius of the inner circle
    scale: 0.2, // Scales overall size of the spinner
    corners: 0.3, // Corner roundness (0..1)
    color: '#623869', // CSS color or array of colors
    fadeColor: 'transparent', // CSS color or array of colors
    speed: 1.1, // Rounds per second
    rotate: 44, // The rotation offset
    animation: 'spinner-line-fade-quick', // The CSS animation name for the lines
    direction: 1, // 1: clockwise, -1: counterclockwise
    zIndex: 2e9, // The z-index (defaults to 2000000000)
    className: 'spinner', // The CSS class to assign to the spinner
    top: '50%', // Top position relative to parent
    left: '50%',
    shadow: '0 0 1px transparent', // Box-shadow for the lines
    position: 'absolute' // Element positioning
  }; 
var unloadedTradesCache = '';

$('body').tooltip({
    html:true,
    trigger:'hover focus click',
    selector: '[data-toggle="tooltip"]'
});

var title;

function copyInviteLink() 
{

    $('#copy-invite-link').on('click',function(e){

        e.preventDefault();

        $('#invite-link').select();
        document.execCommand("copy");
        $('#copied-success').removeClass('d-none'); 

    }); 
 
} 

function loadInvitedUsers() 
{

    $('a[data-target="#invite-modal"]').click(function() {
        axios({
            method: 'get',
            url: '/app/load-invited-users',
            responseType: 'json'
        }).then(function (response) {

            if(response.data.success){

                $('#invited-users-content').html(response.data.html);
                $('#invited-users-heading').removeClass('d-none');

            }
            
            $('#invite-users-left').html(response.data.count);

        });  
    });

}

function initTradeActions()
{

    initTradeClose();
    initTradeCancel();

}

var cancelling = false;
var closing = false;

function initTradeClose()
{

    $('body').on('click', '.close-trade', function(e) {
        
        e.preventDefault();

        if(closing) return;

        closing = true;

        var parent = $(this).parent();

        axios({
            method: 'get',
            url: $(this).attr('href'),
            responseType: 'json'
        })
        .then(function (response) {

            closing = false;
            if(response.data.success == 1) {
                parent.html('<span>Closed</span>');
            }else{
                alert(response.data.message);
            }

        })
        .catch(error => {

            closing = false;
            parent.html('<span>Error</span>');

        });

    });

}

function initTradeCancel()
{

    $('body').on('click', '.cancel-trade', function(e) {
        
        e.preventDefault();
        
        if(cancelling) return;

        cancelling = true;

        var parent = $(this).parent();

        axios({
            method: 'get',
            url: $(this).attr('href'),
            responseType: 'json'
        })
        .then(function (response) {

            cancelling = false;
            parent.html('<span>Cancelled</span>');

        })
        .catch(error => {
            
            cancelling = false;
            parent.html('<span>Error</span>');

        });

    });    

}

function fetchMetadata()
{
 
    $('.link-meta-info').show();
    var spinner = new Spinner(opts).spin($('#spinner')[0]);

    var field = $('textarea[name="description"]');
    $(field).attr('disabled', 'disabled');

    axios({
        method: 'post',
        url: '/source-metadata/',
        data: {
            description: $(field).val()
        },
        responseType: 'json'
    }).then(function (response) {  

        $(field).removeAttr('disabled');
        spinner.stop();     

        if(response.data.success) {

            $('#analysis-field-wrapper').removeClass('active').hide();

            $('.link-meta-info').removeClass('image-preview video-preview tradingview-preview link-meta-preview');
         
            if(response.data.type == 'link') {

                if($('input[name="source_type"]').length > 0)
                {
                    $('input[name="source_type"]').val('link');
                }else{
                    $('input[name="paying_with_currency_id"]').after('<input type="hidden" name="source_type" value="link">');
                }
                if(response.data.meta_title !== null) {
                    var desc = response.data.meta_description;
                    var html = '<a href="'+response.data.link+'" target="_blank" rel="nofollow" class="link-thumbnail"><img src="'+response.data.og_image+'" class="" alt=""/></a><h6 class="mb-1">'+response.data.meta_title+'</h6><small>'+desc+'</small>';
                }else{
                    var desc = '';
                    var html = '';
                }  

                $('.link-meta-info').addClass('link-meta-preview');
               
            
            }else if(response.data.type == 'video'){
              
                var html = response.data.iframe;
                if($('input[name="source_type"]').length > 0)
                {
                    $('input[name="source_type"]').val('video');
                }else{
                    $('input[name="paying_with_currency_id"]').after('<input type="hidden" name="source_type" value="video">');
                }

                $('.link-meta-info').addClass('video-preview');
           
            }else{

                var html = response.data.html;
                if($('input[name="source_type"]').length > 0)
                {
                    $('input[name="source_type"]').val('trading_view');
                }else{
                    $('input[name="paying_with_currency_id"]').after('<input type="hidden" name="source_type" value="trading_view">');
                }

                  $('.link-meta-info').addClass('tradingview-preview');

            }
            
            $('.link-meta-info').removeClass('failed empty').addClass('loaded').html(html); 
            initTradingView();

        }else{

            $('.link-meta-info').html('');
            $('input[name="link"]').val("");
            $('input[name="source_type"]').val("");

            if(!sourceLink){

                $('.link-meta-info').addClass('empty').removeClass('failed loaded').html('');

            }else{

                $('.link-meta-info').removeClass('empty loaded').addClass('failed').html('<i class="fal fa-exclamation-triangle text-danger"></i> Failed to read this link:<small>'+sourceLink+'</small>');

            }
             
        } 

        var value = $(field).val();

        $(field).focus().val("").val(value);

    }).catch(function() {
        $(field).removeAttr('disabled');
        $('.link-meta-info').addClass('empty').removeClass('failed loaded').html('');
        spinner.stop();
    });

}

function findUrls( text )
{
    var source = (text || '').toString();
    var urlArray = [];
    var url;
    var matchArray;

    // Regular expression to find FTP, HTTP(S) and email URLs.
    var regexToken = /(((ftp|https?):\/\/)[\-\w@:%_\+.~#?,&\/\/=]+)|((mailto:)?[_.\w-]+@([\w][\w\-]+\.)+[a-zA-Z]{2,3})/g;

    // Iterate through any URLs in the text.
    while( (matchArray = regexToken.exec( source )) !== null )
    {
        var token = matchArray[0];
        urlArray.push( token );
    }

    return urlArray;
}

function initSourceMetadataOnFocusOut()
{

    $('#delete-analysis-image').click(function(){

        $('#analysis-field').val('');
        $('.link-meta-info').addClass('empty').removeClass('failed loaded').html('');
        $('#analysis-field-wrapper').removeClass('active').hide();

        fetchMetadata(); 

    });

    var firstUrl = null;

    
    $('textarea[name="description"]').on('keyup', function(e) {

        if($('#analysis-field').val().length == 0)
        {
        
            if(e.keyCode == 32 || e.keyCode == 8)
            {
            
                var value = $('textarea[name="description"]').val();
                var urls = findUrls(value);
    
                if(urls.length > 0) {
    
                    if(firstUrl === null || firstUrl !== urls[0])
                    {

                        firstUrl = urls[0];
                        setTimeout(fetchMetadata, 1000);

                    }
    
                }else{

                    if(firstUrl !== null)
                    {

                        setTimeout(fetchMetadata, 1000);

                    }

                }
            
            }

        }

    });

    $('textarea[name="description"]').bind('paste', function(e)
    {

        if($('#analysis-field').val().length == 0)
        {
        
            var value = $('textarea[name="description"]').val();
            value += e.originalEvent.clipboardData.getData('Text');
            
            var urls = findUrls(value);

            if(urls.length > 0)
            {

                if(firstUrl === null || firstUrl !== urls[0])
                {

                    firstUrl = urls[0];
                    setTimeout(fetchMetadata, 1000);

                }

            }
        
        }

    });
 
}

$(document).ready(function() {

    var grid;

    $('#gif-modal').on('shown.bs.modal', function (e) {

        gifForm = $(e.relatedTarget).closest('form');
     
        innerWidth = $('.gif-grid').width();
        grid = makeGrid(document.querySelector('.gif-grid'));

    });

    var typingTimer;                //timer identifier
    var doneTypingInterval = 500;  //time in ms, 5 second for example
    var $input = $('#search-giphy');


    $input.on('keyup', function () {
      clearTimeout(typingTimer);
      typingTimer = setTimeout(doneTyping, doneTypingInterval);
    });

  
    $input.on('keydown', function () {
      clearTimeout(typingTimer);
    });

    //user is "finished typing," do something
    function doneTyping () {

        var searchterm = $input.val();
        
        if(searchterm == '') searchterm = 'bitcoin'; 

        fetchGifs = (offset) => {
            // use whatever end point you want,
            // but be sure to pass offset to paginate correctly
            //return gf.trending({ offset, limit: 25 })
            return gf.search(searchterm, { sort: 'relevant', lang: 'en', offset: offset, limit: 25, type: 'gifs' })
        }

        grid.remove(); 
        makeGrid(document.querySelector('.gif-grid')); 

    }

    $('body').on('click', '.remove-gif', function (e) {

        e.preventDefault();

        gifForm = $(this).closest('form');
        gifForm.find('.gif-holder').addClass('d-none').removeClass('d-flex');
        gifForm.find('[name="gif"]').val('');
        gifForm.find('.gif-image').html('');


    }); 


    if($('#play_dollars_sats_amount').length){

    var satoshiInput = new Cleave('#play_dollars_sats_amount', {
        numeral: true,
        numericOnly: true,
        rawValueTrimPrefix: true,
        prefix: '$',
        numeralThousandsGroupStyle: 'thousand'
    });

    }


    $('.increase-redeem,#play_dollars_sats_amount').on('click',function(e){

        e.preventDefault();

        var satsVal = satoshiInput.getRawValue();
        satoshiInput.setRawValue(parseFloat(satsVal) + 1000); 
        $('#play_dollars_sats_amount').trigger('change');

    });

    $('.decrease-redeem').on('click',function(e){

        e.preventDefault();

        var satsVal = satoshiInput.getRawValue();

        if(satsVal > 1000){
            satoshiInput.setRawValue(parseFloat(satsVal) - 1000); 
            $('#play_dollars_sats_amount').trigger('change');
        }

    });

    $('.toast.success').toast({'delay':5000,'autohide':true}); 
    $('.toast.success').toast('show');  

    $('#play_dollars_sats_amount').trigger('change');
 
    $('#play_dollars_sats_amount').on('keyup keydown change',function() {

        var satoshi = Math.round(parseFloat(satoshiInput.getRawValue()) / 1000 * reward_per_thousand);
        var btc_amount = (Math.round(parseFloat(satoshiInput.getRawValue()) / 1000 * reward_per_thousand) / 100000000).toFixed(8);
        var usd_amount = (Math.round(parseFloat(satoshiInput.getRawValue()) / 1000 * reward_per_thousand) / 100000000).toFixed(8) * btc_rate;

        $('.btc-estimate').html(btc_amount+'BTC');
        $('.usd-estimate').html(usd_amount.toFixed(2));
        $('#sats').html(satoshi);

    });


    $('#redeem-sats').submit(function(e) {

        e.preventDefault();
        $('#error-alert-redeem').hide();

        var laddaButton = Ladda.create($('#redeem-sats button[type="submit"]')[0]);
        laddaButton.start(); 
 
        axios({
            method: 'post',
            //data: new FormData($(this)[0]),
            data: {
                amount: satoshiInput.getRawValue(),
                invoice_address: $('#invoice_address').val()
            },
            url: '/app/exchanges',
            responseType: 'json'
            
        }).then(function (response) {

            if(response.data.success)
            {

                $('#error-alert-redeem').hide();
                $('#redeem-sats-modal').modal('hide');

                Swal.fire({
                        title:'Processing...',
                        type:'info',
                        showConfirmButton: false,
                        showLoaderOnConfirm: true,

                });  
                Swal.showLoading();
                laddaButton.stop(); 

            }else{ 

                laddaButton.stop(); 
                $('#error-alert-text-redeem').html(response.data.message);
                $('#error-alert-redeem').show();

            }
        });     

    });

    wdtEmojiBundle.init('textarea'); 

    initTradeActions();
    initSourceMetadataOnFocusOut();

    $('.trade-description').each(function() {
        var text = $(this).html();
        var output = wdtEmojiBundle.render(text);
        $(this).html(output);
    });

    $('.user-description').each(function() {
        var text = $(this).html();
        var output = wdtEmojiBundle.render(text);
        $(this).html(output);
    });   

    $('.comment-text').each(function() {
        var text = $(this).html();
        var output = wdtEmojiBundle.render(text);
        $(this).html(output);
    }); 

    $('.messages').each(function() {
        var text = $(this).html();
        var output = wdtEmojiBundle.render(text);
        $(this).html(output);
    }); 

    loadInvitedUsers();
    copyInviteLink();
    sendChatMessage();
    initTinyMCE();
    initDropzone();
    toggleBalance();

    if($(".messages").length) $(".messages").scrollTop($(".messages")[0].scrollHeight);
 
    var popOverSettings = {
        placement: 'top',
        container: 'body',
        trigger: 'focus',
        html: true,
        selector: '[data-toggle="popover"]', //Sepcify the selector here
        content: function (e) {

            var share_link = encodeURI($(this).data('link'));
            var comment = encodeURI($(this).data('comment'));

            var tweet = comment + '' +share_link;

            var content = '<div class="share-popper"><a '+ 
                'class="px-2 py-1 btn btn-secondary mr-1 btn-smm font-weight-bold btn-sm"'+
                'target="_blank"'+
                'href="https://www.facebook.com/sharer/sharer.php?u='+share_link+'&amp;src=sdkpreparse">'+ 
                    '<i class="fab fa-facebook-f "></i>'+
                '</a>'+
                '<a target="_blank"'+ 
                'class="px-2 py-1 btn btn-secondary btn-smm font-weight-bold btn-sm"'+
                'href="https://twitter.com/intent/tweet?text='+tweet+'&hashtags=niffler">'+
                    '<i class="fab fa-twitter"></i>'+
                '</a>'+  
                '<a href="https://www.linkedin.com/shareArticle?mini=true&url='+share_link+'"'+ 
                'target="_blank"'+
                'class="px-2 py-1 ml-1 btn btn-secondary btn-sm font-weight-bold btn-smm">'+
                    '<i class="fab fa-linkedin-in" style="position: relative;top:-1px;"></i>'+
                '</a>'+
                '<a href="'+share_link+'"'+ 
                'target="_blank"'+
                'class="px-2 py-1 ml-1 btn btn-secondary btn-sm font-weight-bold btn-smm">'+
                    '<i class="far fa-link" style="position: relative;top:0px;"></i>'+
                '</a></div>';
                

            return content;
        } 
    }

    $('body').popover(popOverSettings);

    title = document.title;

    populateModalDataToBecomeAPatronModalOnClick();

    
    if((window.location.href == siteUrl+'/app' || 
        window.location.href == siteUrl+'/app#' || 
        window.location.href == siteUrl+'/app#trade' || 
        window.location.href == siteUrl+'/app/welcome#' || 
        window.location.href == siteUrl+'/app/welcome' )) {
        loadMoreFeedsOnScroll();
    }

    if(typeof(profileTimestamp) !== 'undefined') {

        if(modalTrade != true){
            loadMoreProfileTradesOnScroll();
        }

    }
    
    $('#tradeModal').modal('show');

    if(loggedIn) {
        console.log('listenForEvents');
        listenForEvents();
        changeMyFeedOnOff();
    } 
    
    loadUnreadTradesOnClick();

    showCommentsOnClick();
    markNotificationsAsReadOnBellClick();
    voteForComments();
    postComment();
    replyComment();
    loadMoreComments();
    showAllReplies();
    initTradingView();
    toggleTradeVisibility();
    followUnfollow();
    resendConfirmationLink();
    showHideTradeModal();


    if(typeof totalFollowings !== 'undefined') {
        updateFollowSomeoneHeading();
    }
});
 
function showHideTradeModal()
{

    $('#new-trade,.new-trade,#new-trade-nav').on('click',function(e){

        e.preventDefault();

        if($('.trade-modal').length){

        if(!$('.trade-modal').hasClass('open')){

            console.log('-'+String(window.scrollY)+'px');
            var css = '-'+String(window.scrollY)+'px';
            $('.trade-modal').addClass('open');
            $('body').addClass('shade-active modal-open');
            document.body.style.position = 'fixed';
            document.body.style.top = css;
            document.body.style.bottom = '0px';
            document.body.style.right = '0px';
            document.body.style.left = '0px';
            $('.trade-modal').trigger('open'); 

        }else{   

            $('.trade-modal').removeClass('open'); 
            $('body').removeClass('shade-active modal-open');
            const scrollY = document.body.style.top;
            document.body.style.top = '';
            document.body.style.bottom = '';
            document.body.style.right = '';
            document.body.style.left = '';
            window.scrollTo(0, parseInt(scrollY || '0') * -1);

        }

        }else{ 

          window.location = '/app#trade'

        } 

    });

}

function initTinyMCE()
{

    tinymce.init({
        selector: '#contentfield',
        plugins: "image",
        menubar: "",
        image_caption: true
    });

} 

function toggleBalance(){

    $('#toggle-balance').on('click',function(e){

        e.preventDefault(); 
        $('#balance-dropdown-item').dropdown('toggle');
        console.log('balance-dropdown-item');
        e.stopPropagation(); 

    });  
     
}

function initDropzone()
{

    if($('div#attachment').length == 0) return; 
    
    var myDropzone = new Dropzone("div#attachment", { 
        url: "/app/lessons/attachment",
        renameFile: function(file) {
            var dt = new Date();
            var time = dt.getTime();
            return time+file.name.replace(/[^\w.]+/g, "");
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        acceptedFiles: "image/jpeg,image/png,application/vnd.ms-excel,application/vnd.ms-powerpoint,application/msword,video/mpeg,video/mp4,application/pdf", 
        addRemoveLinks: true,
        removedfile: function(file) 
        {
            var name = file.upload.filename;
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                url: '/app/lessons/attachment/delete',
                data: {filename: name, lesson_id: $('input[name="lesson_id"]').val()},
                success: function (data){
                    console.log("File has been successfully removed!!");
                },
                error: function(e) {
                    console.log(e);
                }});
                var fileRef;
                return (fileRef = file.previewElement) != null ? 
                fileRef.parentNode.removeChild(file.previewElement) : void 0;
        },        
    });
    myDropzone.on('sending', function(file, xhr, formData){
        formData.append('lesson_id', $('input[name="lesson_id"]').val());
    });
    if(typeof lessonAttachments !== undefined && lessonAttachments.length > 0) {
        for (var i = 0; i < lessonAttachments.length; i++) {
            myDropzone.emit("addedfile", lessonAttachments[i]);
            //myDropzone.emit("thumbnail", lessonAttachments[i], "/image/url");
            myDropzone.emit("complete", lessonAttachments[i]);                
        }
    }

}

function changeMyFeedOnOff()
{

    $('#turn-my-feed-on').click(function(e) {
        e.preventDefault();
        axios({
            method: 'get',
            url: '/app/filters/turn-on-my-feed-mode',
            responseType: 'json'
            
        }).then(function (response) {
            window.location.reload();         
        });         
    });

    $('#turn-my-feed-off').click(function(e) {
        e.preventDefault();
        axios({
            method: 'get',
            url: '/app/filters/turn-off-my-feed-mode',
            responseType: 'json'
            
        }).then(function (response) {
            window.location.reload();         
        });         
    });    

}

function resendConfirmationLink()
{
  $('#resend').click(function (e) {
      e.preventDefault();
    axios({
				
        method: 'get',
        url: '/app/resend-confirmation-link',
        responseType: 'json'
        
    }).then(function (response) {
        if(response.data.success === true) {  
            $('#success-alert-text').html(response.data.message);
            $('.toast.success').toast({'delay':5000,'autohide':true}); 
            $('.toast.success').toast('show'); 
            $('#success-alert').show();
        } else {
            $('#error-alert-text').html(response.data.message);
            $('.toast.error').toast({'delay':5000,'autohide':true}); 
            $('.toast.error').toast('show'); 
            $('#error-alert').show(); 
        }
        $('html, body').animate({
            scrollTop: $("main").offset().top
        }, 1000);            
    });       
  });  
}


function updateFollowSomeoneHeading() {
    if(leftToFollow < 1) {
        $('#follow-someone-heading').text('Done!');
    }else{
        $('#left-to-follow').text(leftToFollow);
    }
}

function followUnfollow() {
    $('.follow-unfollow-button').click(function(e)  {
        e.preventDefault();
        if(!$(this).hasClass('disabled')) {
            var button = $(this);
            axios({
                method: 'get',
                url: $(this).attr('href'),
                responseType: 'json',
            }).then(function(response) {
                if($(button).hasClass('follow-button')) {               
                    if($(button).hasClass('follow-someone-page-button')) {
                        var id = $(button).attr('data-id');
                        $('a[data-id="'+id+'"]').removeClass('follow-button').addClass('unfollow-button').addClass('disabled');
                        $('#proceed-to-platform').removeClass('disabled');
                        leftToFollow--;
                        updateFollowSomeoneHeading();
                    }else{
                        $(button).removeClass('follow-button').addClass('unfollow-button').removeClass('btn-primary').addClass('btn-white');
                        $(button).attr('href', $(button).attr('href').replace('follow', 'unfollow'));
                        $(button).text('Unfollow');
                    }
                }else{
                    if($(button).hasClass('follow-someone-page-button')) {
                        $('a[data-id="'+id+'"]').removeClass('unfollow-button').addClass('follow-button').addClass('disabled');
                    }else{                
                        $(button).removeClass('unfollow-button').addClass('follow-button').removeClass('btn-white').addClass('btn-primary');
                        $(button).attr('href', $(button).attr('href').replace('unfollow', 'follow'));
                        $(button).text('Follow');
                    }
                }
            }).catch(function(error) {
                window.location.href = '/login';
            });          
   
        }   
    });
}

function toggleTradeVisibility() 
{

    $('body').on('click', '.toggleTradeVisibility', function() {
        if($(this).hasClass('fa-eye')) {
            $(this).parents('form').find('input[name="public"]').val('off');
            $(this).removeClass('fa-eye').addClass('fa-eye-slash');
        }else{
            $(this).parents('form').find('input[name="public"]').val('on');
            $(this).removeClass('fa-eye-slash').addClass('fa-eye');
        }
        $(this).parents('form').submit();
    });

    $('body').on('submit', '.update-trade-visibility', function(e) {
        e.preventDefault();
        var data = $(this).serialize();
        axios({
            method: 'get',
            url: $(this).attr('action')+'?'+data,
            responseType: 'json',
        }).then(function (response) {
        });        
    });

}

function populateModalDataToBecomeAPatronModalOnClick() {

    $('body').on('click', '.feed-page-open-patron-button', function(e) {

        var userId = $(this).attr('data-id');
        var avatar = $(this).attr('data-avatar');
        var username = $(this).attr('data-username');
        var price = $(this).attr('data-price');

        $('.insert-username').html(username);
        $('.insert-price').html(price);
        $('.insert-avatar').attr('src',avatar);
 
        $('#ccModal form').each(function() {
            $(this).attr('action', '/app/become-patron/'+userId);
        });

    });

}  

function loadMoreProfileTradesOnScroll()
{

    scroll = $('.feed-wrapper').infiniteScroll({
        // options
        path: '/'+profileSlug+'/trades/page/{{#}}',
        checkLastPage: '.trade-item',
        append: '.trade-item',
        history: false
    });   

    scrollEvents();

} 

function loadMoreFeedsOnScroll() {
    scroll = $('.feed-wrapper').infiniteScroll({
        // options
        path: function() {
            var pageIndex = this.loadCount + 1;
            return '/app/feed/page/'+pageIndex;
          },        
        checkLastPage: '.trade-item',
        append: '.trade-item',
        history: false
    });   
    
    scrollEvents();        
    if(currentFilter == null) {
        scroll.infiniteScroll('loadNextPage');
    }

}

function addNewTradeToFeed(e)
{

    if($('#trade-item-'+e.tradeId).length > 0) {
        return;
    }

    axios({
				
        method: 'get',
        url: '/app/trade/load/'+e.tradeId,
        responseType: 'json'
        
    }).then(function (response) {
 
        if(response.data.success)
        {

            if(myFeedOn && !response.data.myFeed)
            {

                $('#global-feed-bubble').show();

            }else if(!myFeedOn && response.data.myFeed) {

                $('#my-feed-bubble').show();

            }else{
                
                var currentCount = parseInt($('#unread-trades-count').attr('data-count'));
                var currentCountWord = 'trade';
                currentCount++;
                if(isNaN(parseFloat(currentCount)))
                {
                    currentCount = 1;
                }
                if(currentCount > 1)
                {
                    currentCountWord = 'trades';
                }
                $('#unread-trades-count-trades-word').html(currentCountWord);
                var newTitle = '(' + currentCount + ') ' + title;
                document.title = newTitle;        
                document.getElementById('favicon').href = activeFavicon;
                $('#unread-trades-count').attr('data-count', currentCount);
                $('#unread-trades-count').html(currentCount);
                unloadedTradesCache = response.data.html + unloadedTradesCache;
                $('#unread-trades-button').show();

            }

        }
       
    });     

}

function listenForEvents(){
    window.Echo.channel('price-updated')
    .listen('CurrencyUpdated', (e) => {
        updatePair(e);
    });
    window.Echo.channel('new-trade')
    .listen('NewTrade', (e) => {
        addNewTradeToFeed(e);
    });
    window.Echo.private('user.'+ownId)
    .listen('UserNotification', (e) => {
        addNotification(e);
    }); 
    window.Echo.private('user.'+ownId)
    .listen('RedeemCompleted', (e) => {

        console.log('redeemed'); 
        notifyAboutRedeem(e);
    }); 
} 

function notifyAboutRedeem(e)
{

    $('#error-alert-redeem').hide();

    if(e.status == 'completed')
    {

        $('#redeem-sats-modal').modal('hide');

        Swal.fire({
            title:'Hooray! Payout Successful!',
            html: 'Your reward was made possible by our sponsor <a href="https://cryptoparrot.com/ospreyfx" target="_blank">OspreyFX</a> - Trade Crypto and Forex (FX) on MT4 with up to 1:500 leverage. Thank them by checking out their website.',
            type:'success', 
            showCancelButton: true,
            confirmButtonColor:'#15c670',
            confirmButtonText: '<i class="far fa-external-link-square-alt"></i> Visit Sponsor\'s Site',
            cancelButtonText: 'Close',
        }).then((result) => {
 
            if(result.value){

            window.open('https://cryptoparrot.com/ospreyfx', '_blank');
           
            } else if (
                result.dismiss === Swal.DismissReason.cancel
            ) {

            
            } 

            $('#invoice_address').val(''); 

        });   
  
        axios({
            
            method: 'get',
            url: '/app/current-portfolio-html',
            responseType: 'json'
            
        }).then(function (response) {

            // TBA
            $('#portfolio-card-wrapper').html(response.data.html);
        
        });

    }else{

        $('#redeem-sats-modal').modal('hide');

        Swal.fire(
            'Redeem failed!',
            'Something went wrong. Please try again.',
            'error'
        );

    }

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
 
    $('.card-' + e.pairId +' .pct,.pair-pct-'+e.pairId).html((parseFloat(e.change)).toFixed(2)+'%');
    $('.pair-price-'+e.pairId).html(e.price);  

}  

function addNotification(e) {
    var currentCount = parseInt($('#unread-count').attr('data-count'));
    currentCount++;
    var newTitle = '(' + currentCount + ') ' + title;
    document.title = newTitle;    
    document.getElementById('favicon').href = activeFavicon;
    $('#unread-count').attr('data-count', currentCount);
    $('#unread-count').html(currentCount);
    $('#unread-count').show();
    $('#no-notifications').hide();
    //if($('a .notification__icon-wrapper').length < 5) {
        //$('#notifications').prepend('<a class="dropdown-item" href="'+e.url+'"><div class="notification__icon-wrapper"><div class="notification__icon"><i class="far '+e.icon+'"></i></div></div><div class="notification__content"><span class="notification__category"><i class="far fa-circle text-success mr-1"></i>'+e.title+'</span><p>'+e.text+'</p></div></a>');
    //}
}

function loadUnreadTradesOnClick()
{

    $('body').on('click', '#unread-trades-button', function() {
        $('.feed-wrapper').prepend(unloadedTradesCache);
        unloadedTradesCache = '';
        document.title = title;        
        document.getElementById('favicon').href = normalFavicon;        
        $('#unread-trades-count').attr('data-count', 0);
        $('#unread-trades-count').html('0');
        $('#unread-trades-button').hide();  
        $('#my-feed-bubble').hide();  
        $('#global-feed-bubble').hide(); 
        wdtEmojiBundle.init('textarea'); 
        if(mentionData === null) {
            $.getJSON( "/data/mention.json", function( data ) {
                mentionData = data;
                $('textarea').mentionsInput({
                    onDataRequest:function (mode, query, callback) {
                        data = _.filter(mentionData, function(item) { return item.name ? item.name.toLowerCase().indexOf(query.toLowerCase()) > -1 : false});
                      callback.call(this, data);
                    }
                  });              
            });              
        }else{
            $('textarea').mentionsInput({
                onDataRequest:function (mode, query, callback) {
                    data = _.filter(mentionData, function(item) { return item.name ? item.name.toLowerCase().indexOf(query.toLowerCase()) > -1 : false});
                    callback.call(this, data);
                }
            });            
        }                  
        $('.trade-description').each(function() {
            var text = $(this).html();
            var output = wdtEmojiBundle.render(text);
            $(this).html(output);
        });
        $('.comment-text').each(function() {
            var text = $(this).html();
            var output = wdtEmojiBundle.render(text);
            $(this).html(output);
        });         
        initTradingView();  
    });

}

function showCommentsOnClick() {
    $('body').on('click', '.show-comments-button', function(e) {
        e.preventDefault();
        var targetId = $(this).attr('data-id');
        $('#comments-'+targetId).show();
        $('.commentForm[data-trade-id='+targetId+']').closest('.reply-block').show();
        $('.commentForm[data-trade-id='+targetId+'] textarea').focus();
    });
}

function loadMoreComments(){
    $('body').on('click', '.load-more-comments', function() {
        var button = $(this);
        var page = parseInt(button.attr('data-page'));
        var tradeId = button.attr('data-trade-id');

        button.attr('data-page', page+1);    
        axios({
				
            method: 'get',
            url: '/load-more/trade-comments/'+tradeId+'/page/'+page,
            responseType: 'json'
            
        }).then(function (response) {
            if(response.data.success) {
                $('#comments-'+tradeId+'-wrapper').append(response.data.html);
                voteForComments();
                showAllReplies();
                if(!response.data.hasMore) {
                    $('.load-more-comments[data-trade-id="'+tradeId+'"]').hide();
                }
                wdtEmojiBundle.init('textarea'); 
                if(mentionData === null) {
                    $.getJSON( "/data/mention.json", function( data ) {
                        mentionData = data;
                        $('textarea').mentionsInput({
                            onDataRequest:function (mode, query, callback) {
                              data = _.filter(mentionData, function(item) { return item.name ? item.name.toLowerCase().indexOf(query.toLowerCase()) > -1 : false});
                              callback.call(this, data);
                            }
                          });              
                    });              
                }else{
                    $('textarea').mentionsInput({
                        onDataRequest:function (mode, query, callback) {
                            data = _.filter(mentionData, function(item) { return item.name ? item.name.toLowerCase().indexOf(query.toLowerCase()) > -1 : false});
                            callback.call(this, data);
                        }
                    });            
                }                   
                $('.trade-description').each(function() {
                    var text = $(this).html();
                    var output = wdtEmojiBundle.render(text);
                    $(this).html(output);
                });
                $('.comment-text').each(function() {
                    var text = $(this).html();
                    var output = wdtEmojiBundle.render(text);
                    $(this).html(output);
                });                
            }else{
                button.hide();
                $(button).removeClass('d-block');
            }     
        });  
    });       
}

function showAllReplies(){
    $('body').on('click', '.load-all-replies', function() {
        var button = $(this);
        $(button).hide();
        $(button).removeClass('d-block');
        var commentId = button.attr('data-comment-id'); 
        axios({
				
            method: 'get',
            url: '/load-more/trade-comment-replies/'+commentId,
            responseType: 'json'
            
        }).then(function (response) {
            if(response.data.success) {
                $('#replies-'+commentId+'-wrapper').html(response.data.html);
                voteForComments();
                $('.comment-text').each(function() {
                    var text = $(this).html();
                    var output = wdtEmojiBundle.render(text);
                    $(this).html(output);
                });                  
            }
            button.hide();
            $(button).removeClass('d-block');
           
        });  
    });     
}

function markNotificationsAsReadOnBellClick() {
    $('#notifications-list').click(function() {
        document.title = title;        
        document.getElementById('favicon').href = normalFavicon;
        $('#unread-count').attr('data-count', 0);
        $('#unread-count').html(0);
        $('#unread-count').hide();
        axios({
				
            method: 'get',
            url: '/app/load-notifications',
            responseType: 'json'
            
        }).then(function (response) {
            if(response.data.success) {
                $('#notifications-list-items').html(response.data.notifications);
                axios({
                    
                    method: 'post',
                    url: '/app/read-notifications',
                    responseType: 'json'
                    
                }); 
            } 
        });        
  
    });
}

var likingTrade = false;

function voteForComments() {
    $('body').on('click', '.voteUp', function() {
        if(likingTrade == true) return;
        likingTrade = true;
        var userId = $(this).attr('data-user-id');
        var tradeId = $(this).attr('data-trade-id');
        var currentVotes = $(this).attr('data-current-votes');
        currentVotes++;
        $(this).attr('data-current-votes', currentVotes);
        $('.votes-'+tradeId).html(currentVotes);
        $(this).addClass('voteDown').removeClass('voteUp');
        $(this).find('i').removeClass('far').addClass('fas');
        axios({
				
            method: 'get',
            url: '/app/vote-up/'+userId+'/'+tradeId,
            responseType: 'json'
            
        }).then(function (response) {    
            likingTrade = false;  
        }).catch(function(error) {
            likingTrade = false;
        });  
    });

    $('body').on('click', '.voteDown', function() {
        if(likingTrade == true) return;     
        likingTrade = true;
        var userId = $(this).attr('data-user-id');
        var tradeId = $(this).attr('data-trade-id');
        var currentVotes = $(this).attr('data-current-votes');
        currentVotes--;
        $('.votes-'+tradeId).html(currentVotes);  
        $(this).attr('data-current-votes', currentVotes);
        $(this).addClass('voteUp').removeClass('voteDown');
        $(this).find('i').removeClass('fas').addClass('far');
        axios({
				
            method: 'get',
            url: '/app/vote-down/'+userId+'/'+tradeId,
            responseType: 'json'
            
        }).then(function (response) {   
            likingTrade = false;  
        }).catch(function(error) {
            likingTrade = false;
        });   
    });
    
    $('body').on('click', '.voteUpComment', function() {
        if(likingTrade == true) return;
        likingTrade = true;        
        var userId = $(this).attr('data-user-id');
        var commentId = $(this).attr('data-comment-id');
        var currentVotes = $(this).attr('data-current-votes');
        currentVotes++;
        $('.votes-comments-'+commentId).html(currentVotes);
        $(this).attr('data-current-votes', currentVotes);
        $(this).addClass('voteDownComment').removeClass('voteUpComment');
        $(this).find('i').removeClass('far').addClass('fas');
        axios({
				
            method: 'get',
            url: '/app/vote-up/trade-comment/'+userId+'/'+commentId,
            responseType: 'json'
            
        }).then(function (response) {  
            likingTrade = false;    
        }).catch(function(error) {
            likingTrade = false;
        });  
    });

    $('body').on('click', '.voteDownComment', function() {
        if(likingTrade == true) return;
        likingTrade = true;        
        var userId = $(this).attr('data-user-id');
        var commentId = $(this).attr('data-comment-id');
        var currentVotes = $(this).attr('data-current-votes');
        currentVotes--;
        $('.votes-comments-'+commentId).html(currentVotes);  
        $(this).attr('data-current-votes', currentVotes);
        $(this).addClass('voteUpComment').removeClass('voteDownComment');
        $(this).find('i').removeClass('fas').addClass('far');   
        axios({
				
            method: 'get',
            url: '/app/vote-down/trade-comment/'+userId+'/'+commentId,
            responseType: 'json'
            
        }).then(function (response) {    
            likingTrade = false;
        }).catch(function(error) {
            likingTrade = false;
        }); 
    });      
    
}

function replyComment() {

    $('body').on('click', '.comment-reply', function(e){

        e.preventDefault();
        var targetId = $(this).attr('data-id');
        $('form[data-reply-id="'+targetId+'"]').closest('.reply-block').show();
        $('form[data-reply-id="'+targetId+'"] textarea').focus();

    }); 

} 

var sendingComment = false;

function postComment() {

    $('body').on('keyup', '.commentForm textarea', function (e) {
      if (e.which == 13) {
        console.log('click enter');
        $(this).closest('form').submit();
        return false;    //<---- Add this line
      }
    }); 

    $('body').on('submit', '.commentForm', function(e) {
        e.preventDefault();
        if(sendingComment) return;
        sendingComment = true;
        $('#comment-post-error').html('');

        var form = $(this);
        var type = $(this)[0].hasAttribute('data-reply-id') ? 'reply' : 'trade';
        var id = type === 'reply' ? $(this).attr('data-reply-id') : $(this).attr('data-trade-id');
        var query = type === 'reply' ? 'replies-'+id+'-wrapper' : 'comments-'+id;
        var comment = $(this).find('textarea[name="comment"]').val();

        var gif = form.find('[name="gif"]').val();
        var gif_html = '';

        if(gif != ''){

            gif_html = `
                    <div class="gif-image-comment mt-3">
                        <img src="https://media.giphy.com/media/`+gif+`/giphy.gif">
                        <div class="giphy-attribution-holder">
                        <a href="https://media.giphy.com/media/`+gif+`/giphy.gif" class="giphy-attribution" target="_blank" rel="nofollow"><img src="/assets/images/giphy.png"  alt=""></a>
                        </div>
                    </div>
            `;
        }  

        if(comment != ''){
        if(type == 'reply') {
            $('#'+query).append('<div class="comment newly-added-comment"><div class="mb-3"><div class="comment-container comment-container-parent"><div class="comment-avatar d-none d-sm-block"><img class="user-avatar rounded-circle w-100" src="'+myAvatar+'" alt="User Avatar"></div><div class="comment-box p-3 mb-1"><a href="/'+myHandle+'"><img class="d-inline-block d-sm-none user-avatar-sm rounded-circle mr-1" src="'+myAvatar+'" alt="User Avatar"> <strong>'+myUsername+'</strong></a>  <span class="comment-text">'+comment+'</span>'+gif_html+'<div class="comment-meta text-muted mt-2"><span>0</span><span class="px-2">1 second ago</span></div></div></div></div></div>');
        }else{
            $('#'+query).prepend('<div class="comment newly-added-comment"><div class="mb-3"><div class="comment-container comment-container-parent"><div class="comment-avatar d-none d-sm-block"><img class="user-avatar rounded-circle w-100" src="'+myAvatar+'" alt="User Avatar"></div><div class="comment-box p-3 mb-1"><a href="/'+myHandle+'"><img class="d-inline-block d-sm-none user-avatar-sm rounded-circle mr-1" src="'+myAvatar+'" alt="User Avatar"> <strong>'+myUsername+'</strong></a>  <span class="comment-text">'+comment+'</span>'+gif_html+'<div class="comment-meta text-muted mt-2"><span>0</span><span class="px-2">1 second ago</span></div></div></div></div></div>');
        }
        }
 

        $('#'+query).show();
 
        axios({
				
            method: $(this).attr('method'),
            url: $(this).attr('action'),
            responseType: 'json',
            data: $(this).serialize()
            
        }).then(function (response) {
            if(response.data.success === true) { 
                $('.newly-added-comment').addClass('action-success');
                $('textarea').val('');
                wdtEmojiBundle.init('textarea'); 
                $('.comment-text').each(function() {
                    var text = $(this).html();
                    var output = wdtEmojiBundle.render(text);
                    $(this).html(output);
                });
                voteForComments();
                form.find('.gif-holder').addClass('d-none').removeClass('d-flex');
                form.find('[name="gif"]').val('');
                form.find('.gif-image').html('');
            } else {
                $('.newly-added-comment').addClass('action-failed');
                $(form).find('.comment-post-error').html(response.data.message);
                $('.newly-added-comment').addClass('d-none');
            }     
            sendingComment = false;   
        }).catch(function(error) {
            sendingComment = false;
        }); 
    });       

}

var sendingMessage = false;
var messageId = 0;

function sendChatMessage() {
    listenToMessages();


    $('#chat-form textarea[name="message"]').on('keypress', function(e) {
        if(e.which == 13 && !e.shiftKey) {
            //submit form via ajax, this is not JS but server side scripting so not showing here
            $('#chat-form').submit();
            e.preventDefault();
        }
    });  

    $('body').on('submit', '#chat-form', function(e) {
        e.preventDefault();
        if(sendingMessage || $('textarea[name="message"]').val().length === 0) return;
        sendingMessage = true;
        $('#message-post-error').html('');
        var data = $(this).serialize();
        messageId++
        var currentMessageId = messageId;
        appendMessage(currentMessageId);
        axios({
				
            method: $(this).attr('method'),
            url: $(this).attr('action'),
            responseType: 'json',
            data: data
             
        }).then(function (response) {
            if(response.data.success !== true) {  
                $('li[data-id="'+currentMessageId+'"]').addClass('failed');
            } else {
                $('#comment-post-error').html(response.data.message);
            }     

            $(".messages").scrollTop($(".messages")[0].scrollHeight);

            $('.messages').each(function() {
                var text = $(this).html();
                var output = wdtEmojiBundle.render(text);
                $(this).html(output);
            }); 

            sendingMessage = false;   
        }).catch(function(error) {
            sendingMessage = false;
        }); 
    }); 
    $('body').on('click', '#load-older-messages', function() {
        if(oldestMessageId) {
            axios({
                method: 'POST',
                url: window.location.href + '/load',
                responseType: 'json',
                data: {
                    lastMessageId: oldestMessageId
                }
            }).then(function (response) {
                if(response.data.success) {
                    var message = null;
                    var dataToPrepend = '';
                    for(var i = 0; i < response.data.messages.data.length; i++) {
                        message = response.data.messages.data[i];
                        if(i == 0) {
                            oldestMessageId = message['id'];
                        }
                        if(message['author'] == myRole) {
							dataToPrepend += '<li class="sent d-flex"><p class="ml-auto">'+message['message']+'</p><div class="pl-2"><img src="'+myAvatar+'" alt="" /></div></li>';
                        }else{
                            dataToPrepend += '<li class="replies d-flex"><div class="pr-2"><img src="'+otherAvatar+'" alt="" /></div><p class="">'+message['message']+'</p></li>';
                        }
                    } 

                   
                    if(!response.data.messages.hasMore) {
                        $('#load-older-messages').hide();
                    }
                    $('#load-older-messages').after(dataToPrepend);
                }else{
                    $('#load-older-messages').hide();
                }

                 $('.messages').each(function() {
                        var text = $(this).html();
                        var output = wdtEmojiBundle.render(text);
                        $(this).html(output);
                    }); 


            }).catch(function(error) {
                $('#load-older-messages').hide();
            });
        }
    });
}

function appendMessage(id) {
    $('.messages ul').append('<li data-id="'+id+'" class="sent d-flex"><p class="ml-auto">'+$('textarea[name="message"]').val()+'</p><div class="pl-2"><img src="'+myAvatar+'" alt="" /></div></li>');
    $('textarea[name="message"]').val(''); 
}

function listenToMessages()
{
    
    if(typeof conversationsToListen !== undefined && conversationsToListen.length > 0) {
        for(var i = 0; i < conversationsToListen.length; i++) {
            window.Echo.private('conversation.'+conversationsToListen[i])
            .listen('NewMessage', (e) => {
                if(e.conversation.id === currentConversationId) {
                    if(e.message.author !== myRole) {
                        $('.messages ul').append('<li class="replies"><img src="'+otherAvatar+'" alt="" /><p>'+e.message.message+'</p></li>');
                    }
                    var objDiv = $('.messages')[0];
                    objDiv.scrollTop = objDiv.scrollHeight;
                }else{
                    if($.inArray(e.conversation.id, unreadConversations) == -1) {
                        unreadConversations.push(e.conversation.id);
                        var currentCount = parseInt($('#conversations-unread-count').attr('data-count'));
                        currentCount++;
                        var newTitle = '(' + currentCount + ') ' + title;
                        document.title = newTitle;        
                        document.getElementById('favicon').href = activeFavicon;
                        $('#conversations-unread-count').attr('data-count', currentCount);
                        $('#conversations-unread-count').html(currentCount);      
                        $('#conversations-unread-count').show();
                        $('#conversation-'+e.conversation.id).addClass('new-message');
                    }
                }
            }); 
        } 
    } 
} 


/* refactored */  

$('.dropdown').on('show.bs.dropdown',function(e){
    $('body').addClass('shade-active');
});  

$('.dropdown').on('hide.bs.dropdown',function(e){
    $('body').removeClass('shade-active');
});

$(document).on('click', '.dropdown-menu', function (e) {
  e.stopPropagation();
});

$('#show-portfolio').on("click", function (e) {
    e.preventDefault();
    $('#new-card,#switch-card,#show-portfolio').addClass('d-none');      
    $('#portfolio-card,#show-new,#show-switch').removeClass('d-none');         
});
 
$('#show-new').on("click", function (e) {
    e.preventDefault();
    $('#portfolio-card,#switch-card,#show-new').addClass('d-none');      
    $('#new-card,#show-portfolio,#show-switch').removeClass('d-none');         
});

$('#show-switch').on("click", function (e) {
    e.preventDefault();
    $('#portfolio-card,#new-card,#show-switch').addClass('d-none');      
    $('#switch-card,#show-portfolio,#show-new').removeClass('d-none');      
});  

