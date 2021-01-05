<?php // Get real visitor IP behind CloudFlare network
	function Get_User_Os(){
		$userAgent = strtolower($_SERVER['HTTP_USER_AGENT']); 
	
		if(strpos($userAgent, 'windows') !== FALSE)
			$os =  'Windows';
		elseif(strpos($userAgent, 'linux') !== FALSE & strpos($userAgent, 'android') == FALSE) 
			$os = 'Linux';
		elseif(strpos($userAgent, 'macintosh') !== FALSE | strpos($userAgent, 'mac os') !== FALSE | strpos($userAgent, 'iphone') !== FALSE)
			$os = "Mac os";
		elseif(strpos($userAgent, 'android') !== FALSE)
			$os = "Android";
		else
			$os = 'Other';

		return $os;
	}
?>