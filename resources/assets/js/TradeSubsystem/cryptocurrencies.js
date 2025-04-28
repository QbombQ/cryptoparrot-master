$ = jQuery;

$(document).ready(function() {

    $('#table-cryptocurrencies').DataTable( {
        scrollX:        true,
        paging:         false,
        fixedColumns:   {
            rightColumns: 1
        }
    }); 

    new ScrollHint('.js-scrollable');

}); 