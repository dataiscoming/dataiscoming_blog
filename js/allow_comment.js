$(document).ready(function() {
	$('.group .required').keyup(function() {

		// The two ways to access the div of the button
		const activeDiv1 = document.getElementById('comment_form');
		const activeDiv2 = $('#comment_form');
					
		// Check if the input name and email are filled					
		var empty = false;
		$('.group input').each(function() {
			if ($(this).val().length == 0 ) {
				empty = true;
			}
		});
				
		// Check if the textarea message is filled					
		$('.group textarea').each(function() {
			if ($(this).val().length == 0) {
				empty = true;
			}
		});
					
		// if the earlier conditions are OK, then the click on the button submit is allowed				
		if (empty){
			activeDiv1.classList.replace("comment_form_abled", "comment_form_disabled"); // change the colour in changing the class
			activeDiv2.attr('disabled', 'disabled'); // change the attribute disabled to allow the click
		} else {
			activeDiv1.classList.replace("comment_form_disabled", "comment_form_abled");
			activeDiv2.removeAttr('disabled'); 
		}
		
	});
					
});