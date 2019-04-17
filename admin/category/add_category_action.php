<?php
	
	// Condition : the new category must has been sent from the form
	if($_POST['action']=="Send"){
		
		// Header Section for the admin
		include('../../layout/admin/header_admin.php');
		
		// Condition : the new category variable have to exist
		if (isset($_POST['category_new']) AND  $_POST['category_new'] != NULL){
			
			// Connection to the database
			include('../../database/db_open.php');
			
			// Select the number max of post to add a post just in N+1
			$req = $con->prepare("select max(id_cat) as id from categories");
			$req->execute();
			$data= $req ->fetchAll();
			
			// Preparing the variables to send to the database
			$category_new = $_POST['category_new'];
			if($data == NULL){
				$id_new = '1';
			}else {
				$id_new = intval($data['0']['0']) + 1;
			}
			
			// Sending the new post into the database
			$req = $con->prepare("INSERT INTO categories VALUES(:id_new, :category_new)");
			$req->bindValue('id_new', $id_new, PDO::PARAM_STR);
			$req->bindValue('category_new', $category_new, PDO::PARAM_STR);
			$req->execute();
			
			// Condition : the succeed of the update
			if($req==TRUE){
				
				// Message about the saving of the post
				echo "   <div class='validation1'>
				<div class='validation2'>
				<p>New category saved</p>
				<p class='lien'>[ <a href=' ../../admin/index_admin.php'>Back to the admin panel.</a> ]</p>
				</div>
				</div>";
				$con =null;
				}else{
				
				// Message about the modification of the post unsaved because of a problem at the database
				echo	"
				<div class='validation1'>
				<div class='validation2'>
				<p>An error happened!</p>
				<p class='lien'>[ <a href=' ../../admin/new_post_form.php'>Back to the category panel.</a> ]</p>
				</div>
				</div>
			";}    
		}
		else{ 
			// Message about the post unsaved
			echo "
			<div class='validation1'>
			<div class='validation2'>
			<p>New category unsaved.</p>
			<p class='lien'>[ <a href=' ../../admin/new_post_form.php'>Go to category panel.</a> ]</p>
			</div>
			</div>
		";}
		} /*else if($_POST['action']=="Preview"){
		
		include('../admin/preview.php');
		
		}*/ else {
		echo "Error";
	}
?>