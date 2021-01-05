function fade_banner(){ 
	// JS function to set a cookie in order to not show anymore the banner 
		
	$.post(
	'fade_banner.php',
	{},
	return_string,
	'text');
		
	function return_string(data_result){
		if(data_result=='Success'){
			$('#js-cookie-box').fadeOut('slow');
		}
	}
}