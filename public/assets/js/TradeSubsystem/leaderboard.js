$(document).ready(function(){

	$('#leaderboard-select').select2({
        minimumResultsForSearch: -1,
        closeOnSelect: true,
    });  

	$('#leaderboard-select').on('change',function(){

		val = $(this).val();
		$('.leaderboard-panel').removeClass('d-block').addClass('d-none');
		$('#'+val).addClass('d-block').removeClass('d-none'); 

	});
 
}); 