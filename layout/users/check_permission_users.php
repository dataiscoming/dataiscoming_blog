<?php
	// display errors : 1 = on, 0 = off
	ini_set('display_errors', '1');
	
	// Connection to the database to get the status of the website 
	include('../database/db_open.php');
	$ident = 1;
	$eta = $con->prepare("SELECT eta FROM eta_web_sit WHERE id = :ident");
	$eta->bindValue('ident', $ident, PDO::PARAM_INT);
	$eta->execute();
	$eta_web_sit=$eta->fetch(PDO::FETCH_ASSOC);
	
	/*If the status of the website is ".Maint.", then the user will not access the
	website and the maintenance webpage will be shown*/
	if($eta_web_sit['eta'] == '.MAINT.'){
		header('Location: ../maintenance.php');
	}
?>