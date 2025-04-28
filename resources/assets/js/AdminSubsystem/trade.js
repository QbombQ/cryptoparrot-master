$ = jQuery;

$(document).ready(function() {

    console.log("X");
    showImageAfterSelect();
    openFileSelectOnUploadImageIconClick();
    initSourceMetadataOnFocusOut();

}); 

function openFileSelectOnUploadImageIconClick()
{

    $('#upload-image-analysis-button').click(function() {

        $('#analysis-field').focus().trigger('click');

    });

}

function showImageAfterSelect()
{

    $("#analysis-field").change(function(){
        readURL(this);
    });

}

function readURL(input)
{
    
    if (input.files && input.files[0])
    {

        var reader = new FileReader();
        reader.onload = function (e) {
            $('.link-meta-info').html('<img src="'+e.target.result+'"/>');
            $('.link-meta-info').show();
            $('#analysis-field-wrapper').show();
            if($('input[name="source_type"]').length > 0)
            {
                $('input[name="source_type"]').val('image');
            }else{
                $('textarea[name="description"]').after('<input name="source_type" value="image">');
            }
        }

        reader.readAsDataURL(input.files[0]);
    }

}

function fetchMetadata()
{

    $('.link-meta-info').show();

    var field = $('textarea[name="description"]');

    axios({
        method: 'post',
        url: '/source-metadata/',
        data: {
            description: $(field).val()
        },
        responseType: 'json'
    }).then(function (response) {  

        console.log(response);
        if(response.data.success) {

            $('#analysis-field-wrapper').removeClass('active').hide();

            if(response.data.type == 'link') {

                if($('input[name="source_type"]').length > 0)
                {
                    $('input[name="source_type"]').val('link');
                }else{
                    $('textarea[name="description"]').after('<input name="source_type" value="link">');
                }
                if(response.data.meta_title !== null) {
                    var desc = response.data.meta_description;
                    var html = '<a href="'+response.data.link+'" target="_blank" rel="nofollow" class="link-thumbnail"><img src="'+response.data.og_image+'" class="" alt=""/></a><h6 class="mb-1">'+response.data.meta_title+'</h6><small>'+desc+'</small>';
                }else{
                    var desc = '';
                    var html = '';
                }
            
            }else if(response.data.type == 'video'){
              
                var html = response.data.iframe;
                if($('input[name="source_type"]').length > 0)
                {
                    $('input[name="source_type"]').val('video');
                }else{
                    $('textarea[name="description"]').after('<input name="source_type" value="video">');
                }
           
            }else{

                var html = response.data.html;
                if($('input[name="source_type"]').length > 0)
                {
                    $('input[name="source_type"]').val('trading_view');
                }else{
                    $('textarea[name="description"]').after('<input name="source_type" value="trading_view">');
                }

            }
            
            $('.link-meta-info').removeClass('failed empty').addClass('loaded').html(html); 
            //initTradingView();

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

    }).catch(function(error) {
        console.log(error);
        $('.link-meta-info').addClass('empty').removeClass('failed loaded').html('');
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