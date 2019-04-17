<?php
	/* Setting the parameters to connect to the database*/
	$host='localhost'; /* Host of the server */
	$dbname='dataiscoming'; /* Database name */
	$user='root'; /* User */
	$pwd=''; /* Password */
	
	/* Establish the connection to the database */
	try{
		$con = new PDO('mysql:host='.$host.';dbname='.$dbname.';charset=utf8', $user, $pwd);
	}
	catch(Exception $e){
		die('Erreur : '.$e->getMessage());
	}
?>	