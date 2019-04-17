<?php
	// Header section for the admin
	include('../../layout/admin/header_admin.php');
	
	// Session variables empty
	$_SESSION = array();
	
	// Destroy the session
	session_destroy(); 
	
	// Message to confirme the session was destroyed 
	echo "
	<div class='validation1'>
	<div class='validation2'>
    <p>You are well disconnected from the admin session.</p>
    <p class='lien'>[ <a href=' ../../users/index_users.php?page=posts&n=1'>Back to the admin panel.</a> ]</p>
	</div>
    </div>
    ";
?>