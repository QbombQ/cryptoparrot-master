$ = jQuery;

$(document).ready(function() {

    changeOrderStatus();

    $(".select2").select2();
   

    if($('textarea[name="content"]').length > 0) {

        CKEDITOR.replace('content');

    }   

    if($('textarea[name="asset_description"]').length > 0) {
        CKEDITOR.replace('asset_description');
    }

    if($('textarea.prize-desc').length > 0) {
        CKEDITOR.replaceAll('prize-desc');
    }

    $('#article-title').on('keyup', function() {
        var value = convertToSlug($(this).val());
        $('#article-slug').val(value);
    });
    $('#article-title').on('blur', function() {
        var value = convertToSlug($(this).val());
        $('#article-slug').val(value);
    });    

    $('#assign-badge-form').submit(function(e) {
        e.preventDefault();
        $('#success-alert, #error-alert').hide();
        var data = new FormData($(this)[0]);
        axios({
				
            method: $(this).attr('method'),
            url: $(this).attr('action'),
            responseType: 'json',
            data: data
            
        }).then(function (response) {
            console.log(response);
            if(response.data.success === true) {  
                $('#success-alert-text').html(response.data.message);
                $('#success-alert').show();
            } else {
                $('#error-alert-text').html(response.data.message);
                $('#error-alert').show();
            }           
        });         
    });

});

function convertToSlug(Text)
{
    return Text
        .toLowerCase()
        .replace(/ /g,'-')
        .replace(/[^\w-]+/g,'')
        ;
}

var previous = null;

function changeOrderStatus()
{

    $('.order-status-select').on('focus', function() {
        previous = this.value;
    });

    $('.order-status-select').on('change', function() {
        var form = $(this).parents('form')[0];
        var selectField = $(this);
        var data = new FormData(form);
        $(selectField).siblings('i').css('color', 'grey');
        axios({
            method: 'post',
            url: $(form).attr('action'),
            responseType: 'json',
            data: data
        }).then(function (response) {
            if(response.data.success == false)
            {
                alert(response.data.message);
                $(selectField).val(previous);
            }else{
                $(selectField).siblings('i').css('color', 'green');
            }
        });
    });

}