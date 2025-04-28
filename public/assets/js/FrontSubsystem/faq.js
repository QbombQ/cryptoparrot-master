$(document).ready(function() {

	if(location.hash != null && location.hash != ""){

		$('.collapse').collapse('hide');
        	
		$('#accordion-getting-started').on('hidden.bs.collapse', function() {
 
		  	$(location.hash + '.collapse').collapse('show');
		  	
 
		}).on('shown.bs.collapse', function() {
		
			$('html, body').animate({
		        scrollTop: $( location.hash ).offset().top - 150
		    }, 500);

		});  
   
    }

});  