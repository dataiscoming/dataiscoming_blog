<?php 
	// Header section for the admin 
	include('../../layout/admin/header_admin.php');
	
	// Condition rejecting the empty post
	if(isset($_POST) && !empty($_POST['new_pwd'])) 
	{
		
		// Connextion to the database
		include("../../database/db_open.php");
		
		// Variables new and old password
        $new_pwd = $_POST['new_pwd'];
        $old_pwd = $_POST['old_pwd'];
		
		// Function to hash the password	
		function myhash($password, $unique_salt) {
    		return crypt($password, '$2a$10$'.$unique_salt);
		}
		
		// Function to salt the password
		function unique_salt() {
   		 	return substr(sha1(mt_rand()),0,22);
		}
		
		// Hashing the password
		$new_pwd = myhash($new_pwd, unique_salt());
		
		// Getting the id of the last password from the database
        $sql = "select * from admin where password_admin='".$old_pwd."'";
		$query = $con->query($sql);
		$data=$query->fetch(PDO::FETCH_ASSOC);
        $id = $data['id_admin'];
		
		// Sending the new password to the database	
        $modifpass = "UPDATE admin SET password_admin='".$new_pwd."' WHERE id_admin='".$id."'";
		$modif  = $con->query($modifpass);
		
		// Condition about the succeed of the sending
        if($modif == true){
			
			// Message about the new password saved 
			echo "
			<div class='validation1'>
			<div class='validation2'>
			<p>Your new password is saved.</p>
			<p class='lien'>[ <a href=' ../../admin/login/login_admin_form.php'>Back to the admin panel.</a> ]</p>
			</div>
			</div>
			" ;
			$_SESSION = array();
			session_destroy();
		}
        else{
			
			// Message about the new password unsaved with a problem at the database
			echo	"
			<div class='validation1'>
			<div class='validation2'>
			<p>An error happened.</p>
			<p class='lien'>[ <a href=' ../../admin/index_admin.php'>Back to the admin panel.</a> ]</p>
			</div>
			</div>
			" ;
		}
		} else{
		
		// Message when the password is unsaved because the password is empty
		echo	"
		<div class='validation1'>
		<div class='validation2'>
		<p>An error happened.</p>
		<p class='lien'>[ <a href=' ../../admin/index_admin.php'>Back to the admin panel.</a> ]</p>
		</div>
		</div>
		" ;
	}
?> 				