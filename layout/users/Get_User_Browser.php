<?php // Get the browser of the user
	function Get_User_Browser(){
    
		if(strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== FALSE)
			$browser =  'Internet explorer';
		elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Trident') !== FALSE) //For Supporting IE 11
			$browser = 'Internet explorer';
		elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox') !== FALSE)
			$browser = 'Mozilla Firefox';
		elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome') !== FALSE & strpos($_SERVER['HTTP_USER_AGENT'], 'Edge') == FALSE & strpos($_SERVER['HTTP_USER_AGENT'], 'Edg') == FALSE)
			$browser = 'Google Chrome';
		elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Mini') !== FALSE)
			$browser = "Opera Mini";
		elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Opera') !== FALSE)
			$browser = "Opera";
		elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Safari') !== FALSE & strpos($_SERVER['HTTP_USER_AGENT'], 'Edge') == FALSE & strpos($_SERVER['HTTP_USER_AGENT'], 'Edg') == FALSE)
			$browser = "Safari";
		elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Edge') !== FALSE | strpos($_SERVER['HTTP_USER_AGENT'], 'Edg') !== FALSE)
			$browser = "Microsoft Edge";
		else
			$browser = 'Other';

		return $browser;
	}
?>