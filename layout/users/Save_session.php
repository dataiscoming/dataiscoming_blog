<?php
	
	// Import functions to get the IP adresse, the Device, the browser and the OS 
	include('Get_User_IP.php');
	include('Get_User_Device.php');
	include('Get_User_Browser.php');
	include('Get_User_Os.php');
	
	// Variable to start the sesion
	$now = time();
	$lifetime = 3600;//3600 prod // 15 test;
	$samesite = 'lax';
	
	// Creation of the session
	if(!isset($_SESSION)){
		// Set the cookie the life of the cookies
		session_set_cookie_params($lifetime,'/; samesite='.$samesite);
		
		// Start the session
		session_start();
		
		// Set the cookie of the session
		setcookie(session_name(), "",$now - $lifetime);
		if(!isset($_COOKIE['bottom_banner'])){
			// Set the cookie of the banner to show it
			setcookie("bottom_banner", "show", $now - $lifetime);
		}
	}
	
	// Change the IP adress to send it to DB https://www.geeksforgeeks.org/how-to-encrypt-and-decrypt-a-php-string/
	$ciphering = "AES-256-CBC"; 
	$iv_length = openssl_cipher_iv_length($ciphering); 
	$options = 0; 
	$encryption_iv = '1234567891011121'; 
	$encryption_key = "dataiscoming2020!"; 
	//$rep4 = openssl_decrypt($test4, $ciphering, $encryption_key, $options, $encryption_iv);
	
	// Variables of the session
	$ID = session_id();
	$IP = Get_User_IP();
	$IP = openssl_encrypt($IP, $ciphering, $encryption_key, $options, $encryption_iv); 
	$Date = date('Y:m:d');
	$Time = date('H:i:s');
	$Browser = Get_User_Browser();
	$OS = Get_User_Os();
	$Device = Get_User_Device();
	$Link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'] .  $_SERVER['REQUEST_URI'];
		
	// Connection to the database and get all the posts
	include('../database/db_open.php');
		
	// Get the session already saved
	$query = $con->prepare("SELECT distinct ID_PHP_SESSION as id FROM sessions");
	$query->execute();
	$data= $query ->fetchAll();	
	
	// Save another session only if it is not already saved
	if(!in_array($ID,array_column($data, 'id'))){
		// Send the session
		$query = $con->prepare("INSERT INTO sessions (ID_PHP_SESSION, IP_SESSION, DATE_SESSION, TIME_SESSION, BROWSER_SESSION, OS_SESSION, DEVICE_SESSION, LINK_SESSION) VALUES(:id_session, :ip_session, :date_session, :time_session, :browser_session, :os_session, :device_session, :link_session)");
		$query->bindValue('id_session', $ID, PDO::PARAM_STR);
		$query->bindValue('ip_session', $IP, PDO::PARAM_STR);
		$query->bindValue('date_session', $Date, PDO::PARAM_STR);
		$query->bindValue('time_session', $Time, PDO::PARAM_STR);
		$query->bindValue('browser_session', $Browser, PDO::PARAM_STR);
		$query->bindValue('os_session', $OS, PDO::PARAM_STR);
		$query->bindValue('device_session', $Device, PDO::PARAM_STR);
		$query->bindValue('link_session', $Link, PDO::PARAM_STR);
		$query->execute();
	}
	
	// Log to test
	/*echo("<script>console.log('PHP session: " . $ID . "');</script>");
	echo("<script>console.log('PHP session: " . $_SERVER['HTTP_USER_AGENT'] . "');</script>");
	echo("<script>console.log('PHP session: " . $IP . "');</script>");
	echo("<script>console.log('PHP session: " . $Date . "');</script>");
	echo("<script>console.log('PHP session: " . $Time . "');</script>");
	echo("<script>console.log('PHP session: " . $Browser . "');</script>");
	echo("<script>console.log('PHP session: " . $OS  . "');</script>");
	echo("<script>console.log('PHP session: " . $Device . "');</script>");
	echo("<script>console.log('PHP session: " . $Link . "');</script>");*/
	
	// Close the connexion to the DB
	include('../database/db_close.php');
?>