<?php 
	// Header section for the admin
	include('../../layout/admin/header_admin.php');
	
	// Condition rejecting the empty pseudo
	if(isset($_POST) && !empty($_POST['new_pseudo'])){
		
		// Connextion to the database
		include("../../database/db_open.php");
		
		// Variables new and old pseudo
        $old_pseudo = $_POST['old_pseudo'];
        $new_pseudo = $_POST['new_pseudo'];
		
		// Getting the id of the last password from the database
        $sql = "select * from admin where username_admin='".$old_pseudo."'";
		$req = $con->query($sql);
		$data=$req->fetch(PDO::FETCH_ASSOC);
		$id = $data['id_admin'];
		
		// Updating the new pseudo to the database	
		$modifpseudo = "UPDATE admin SET username_admin='".$new_pseudo."' WHERE id_admin='".$id."'";
		$modif = $con->query($modifpseudo);
		
		// Condition about the succeed of the update
        if($modif == true){
			
			// Message about the new pseudo saved
			echo	"
			<div class='validation1'>
			<div class='validation2'>
			<p>Your pseudo is changed.</p>
			<p class='lien'>[ <a href=' ../../admin/login/login_admin_form.php'>Back to the admin panel.</a> ]</p>
			</div>
			</div>
			" ;
			$_SESSION = array();
			session_destroy();
			exit;
		}
        else{
			
			// Message about the new pseudo unsaved with a problem at the database
			echo	"
			<div class='validation1'>
			<div class='validation2'>
			<p>An error happened.</p>
			<p class='lien'>[ <a href=' ../../admin/index_admin.php'>Back to the admin panel.</a> ]</p>
			</div>
			</div>
		" ;}
		}else{
		
		// Message when the pseudo is unsaved because the pseudo is empty
		echo	"
		<div class='validation1'>
		<div class='validation2'>
		<p>An error happened.</p>
		<p class='lien'>[ <a href=' ../../admin/index_admin.php'>Back to the admin panel.</a> ]</p>
		</div>
		</div>
	" ;}
?>				