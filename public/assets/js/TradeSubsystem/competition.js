$(document).ready(function(){

	initCompetitionsTable();
	
});

function initCompetitionsTable()
{

    $('#competition-leaders').DataTable({
        searching:false,
        pageLength:30,
        lengthChange:false
    });

    new ScrollHint('.js-scrollable');  

} 
