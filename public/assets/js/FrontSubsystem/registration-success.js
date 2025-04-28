$ = jQuery;

$(document).ready(function() {

    $('#shareWithFriendsForm').submit(function(e) {
        e.preventDefault();
        axios({
				
            method: $(this).attr('method'),
            url: $(this).attr('action'),
            responseType: 'json',
            data: $(this).serialize()
            
        }).then(function (response) {
            if(response.data.success === true) {          
                alert(response.data.message);
            } else {
                alert(response.data.message);
            }
        });             
    });

});