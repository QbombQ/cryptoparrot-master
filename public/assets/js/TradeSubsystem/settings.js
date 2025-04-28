$ = jQuery;

var cropper = null;
var avatarCropper = null;

$(document).ready(function() {

    var hash = window.location.hash;
    hash && $('ul.nav-tabs a[href="' + hash + '"]').tab('show');  

    $('#updateProfileForm, #updateSocialLinksForm, #updateNotificationsForm, #updatePasswordForm, #acceptPatrons').submit(function(e) {
        e.preventDefault();
        $('#success-alert, #error-alert').hide();

        var data = new FormData($(this)[0]);

        axios({
				
            method: $(this).attr('method'),
            url: $(this).attr('action'),
            responseType: 'json',
            data: data
            
        }).then(function (response) {
            if(response.data.success === true) {  
                $('#success-alert-text').html(response.data.message);
                $('.toast.success').toast({'delay':5000,'autohide':true}); 
                $('.toast.success').toast('show');  
                $('#success-alert').show();
            } else {
                $('#error-alert-text').html(response.data.message);
                $('.toast.error').toast({'delay':10000,'autohide':true}); 
                $('.toast.error').toast('show'); 
                $('#error-alert').show();
            }
            $('html, body').animate({
                scrollTop: $("main").offset().top
            }, 1000);            
        }).catch(function(error) {
            console.log(error);
        });             
    });   

    $("#avatar-drop-area").dmUploader({
        url: '/app/settings/upload/avatar',
        dataType: 'json',

        onUploadSuccess: function(id, data) {
            if(data.success) {
                $('#current-avatar, #side-avatar, #nav-avatar').attr('src', data.path.path+'?v='+Math.round(+new Date()/1000));
                $('#avatar-image-cropping').attr('src', data.path.fullSizePath +'?v='+Math.round(+new Date()/1000));
                $('#success-alert-text').html(data.message);
                $('.toast.success').toast({'delay':5000,'autohide':true}); 
                $('.toast.success').toast('show');  
                $('#success-alert').show(); 
                showCropAvatar(data.path.fullSizePath+'?v='+Math.round(+new Date()/1000));              
            }else{
                $('#error-alert-text').html(data.message);
                $('.toast.error').toast({'delay':10000,'autohide':true}); 
                $('.toast.error').toast('show'); 
                $('#error-alert').show();                
            }
            $('html, body').animate({
                scrollTop: $("main").offset().top
            }, 1000);              
        }

    }); 
 
    $("#cover-drop-area").dmUploader({
        url: '/app/settings/upload/temp/cover',
        dataType: 'json',

        onUploadSuccess: function(id, data) {
            if(data.success) {
                $('#cover-image-cropping').attr('src', data.path+'?v='+Math.round(+new Date()/1000));
                showCropCover(data.path);
            }else{
                $('#error-alert-text').html(data.message);
                $('.toast.error').toast({'delay':10000,'autohide':true}); 
                $('.toast.error').toast('show'); 
                $('#error-alert').show();
            }
            $('html, body').animate({
                scrollTop: $("main").offset().top
            });
        }

    });   


});

function showCropCover(path) {
    var cover = $('#cover-image-cropping')[0];
    if(cropper == null) {
        cropper = new Cropper(cover, {
            aspectRatio: 2.47524 / 1,
            viewMode: 3,
            dragMode: 'move',
            zoomable: true,
            rotatable: true,
            scalable: false, 
            crop: function(event) {
              }                        
        }); 

        $('.rotate-cover').on('click',function(){
            cropper.rotate(-90);
        }); 
 

    }else{
        cropper.replace(path);
    }     
    $('#crop-cover').on('click', function() {
        cropper.getCroppedCanvas({
            width: 1000,
            height: 400,            
            imageSmoothingEnabled: true,
            imageSmoothingQuality: 'high',            
        }).toBlob(function (blob) {
            var formData = new FormData();
        
            formData.append('file', blob);
        
            // Use `jQuery.ajax` method
            $.ajax('/app/settings/upload/cover', {
                method: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function (data) {
                    $('#cover-image-cropping').attr('src', data.path);
                    $('#current-cover').attr('src', data.path);
                    $('#success-alert-text').html(data.message);
                    $('.toast.success').toast({'delay':5000,'autohide':true}); 
                    $('.toast.success').toast('show');  
                    $('#success-alert').show();
                    $('#cover-crop-modal').modal('hide');
                },
                error: function () {
                    $('#cover-crop-modal').modal('hide');
                }   
            }); 
        });        

    });                
    $('#cover-crop-modal').modal({
        backdrop: 'static',
        keyboard: false
    });     
} 

function showCropAvatar(path) {
    var avatar = $('#avatar-image-cropping')[0];
    if(avatarCropper == null) {
        avatarCropper = new Cropper(avatar, {
            aspectRatio: 1 / 1,
            viewMode: 3,
            dragMode: 'move',
            minContainerWidth: 150,
            minContainerHeight: 150,
            minCropBoxWidth: 150,
            zoomable: false,
            rotatable: true,
            scalable: false,
            crop: function(event) {
              }                        
        });  

        $('.rotate-avatar').on('click',function(){
            avatarCropper.rotate(-90);
        }); 

    }else{
        avatarCropper.replace(path);
    }     
    $('#crop-avatar').on('click', function() {
        avatarCropper.getCroppedCanvas({
            width: 150,
            height: 150,            
            imageSmoothingEnabled: true,
            imageSmoothingQuality: 'high',            
        }).toBlob(function (blob) {
            var formData = new FormData();
        
            formData.append('file', blob);
        
            // Use `jQuery.ajax` method
            $.ajax('/app/settings/upload/avatar', {
                method: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function (data) {
                    console.log(data);
                    $('#current-avatar, #side-avatar, #nav-avatar, #avatar-image-cropping').attr('src', data.path.path);
                    $('#success-alert-text').html(data.message);
                    $('.toast.success').toast({'delay':5000,'autohide':true}); 
                    $('.toast.success').toast('show');  
                    $('#success-alert').show();
                    $('#avatar-crop-modal').modal('hide');
                },
                error: function () {
                    $('#avatar-crop-modal').modal('hide');
                }   
            });
        });        

    });                
    $('#avatar-crop-modal').modal({
        backdrop: 'static',
        keyboard: false
    });     
}