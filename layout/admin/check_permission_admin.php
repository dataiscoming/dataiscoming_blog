<?php
	// display errors
	ini_set('display_errors', '1');
	
	//Login check (session variable) 
	if(!isset($_SESSION)){session_start();}
	if(!isset($_SESSION['login']) || ($_SESSION['login'] == '')){
		header('Location: login_admin_form.php');
		exit;
	}
?> 