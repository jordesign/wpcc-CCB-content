jQuery(document).ready(function($){

	$('a.eventMore').click(function(e){

		e.preventDefault();
		$(this).parents('.wpccUpcomingEvent').find('.eventExtraInfo').slideToggle('fast');

	}); 

});

