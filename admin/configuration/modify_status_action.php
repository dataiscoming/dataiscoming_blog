<?php 
	// Header section for the admin 
	include('../../layout/admin/header_admin.php');
	
	// Condition rejecting the empty status
	if (isset($_POST['new_eta']) AND $_POST['new_eta'] != NULL){
		
		// Connextion to the database
		include('../../database/db_open.php');
		
		// Variables new and old pseudo
        $eta_modif = $_POST['new_eta'];
		
		// Updating the new status to the database	
		$req="UPDATE eta_web_sit SET eta='.$eta_modif.'WHERE id=1";
		$update = $con->query($req);
		
		// Condition about the succeed of the update	  
        if($update == true){
			
			// Message about the new status saved
			echo	"
			<div class='validation1'>
			<div class='validation2'>
			<p>Your update is saved.</p>
			<p class='lien'>[ <a href='../../admin/index_admin.php'>Back to the admin panel.</a> ]</p>
			</div>
			</div>
			" ;
			}else{
			
			// Message about the new status unsaved because of a problem at the database
			echo	"
			<div class='validation1'>
			<div class='validation2'>
			<p>An error happened!</p>
			<p class='lien'>[ <a href='modify_article_form.php'>Back to the modify article panel.</a> ]</p>
			</div>
			</div>
		";}    
		} else{
		
		// Message when the status is unsaved because of the status is empty
		echo	"
		<div class='validation1'>
		<div class='validation2'>
		<p>An error happened!</p>
		<p class='lien'>[ <a href='modify_article_form.php'>Back to the modify article panel.</a> ]</p>
		</div>
		</div>
	";}     
?>		