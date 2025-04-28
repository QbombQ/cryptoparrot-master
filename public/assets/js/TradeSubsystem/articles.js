$ = jQuery;

$(document).ready(function() {

    $('#tags-filter').select2({
         minimumResultsForSearch: -1,
    }); 

    $('#tags-filter').on('change', function(e) {
 
        var tag = $('#tags-filter').val();
        window.location = '/news?tag='+tag;

    });   

});