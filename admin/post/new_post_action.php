<?php
	
	// 
	if($_POST['action']=="Send"){
		
		// Header part for the admin
		include('../../layout/admin/header_admin.php');
		
		if (isset($_POST['title_new']) AND isset($_POST['corpus_new']) AND isset($_POST['status_post']) AND $_POST['title_new'] != NULL AND $_POST['corpus_new'] != NULL AND $_POST['status_post'] != NULL){
			
			// Connection to the database
			include('../../database/db_open.php');
			
			// Select the number max of post to add a post just in N+1
			$query = $con->prepare("select max(id) as id from posts");
			$query->execute();
			$data= $query ->fetchAll();
			
			// Preparing the variables to send to the database
			$corpus_new = htmlspecialchars($_POST['corpus_new']);
			$title_new = $_POST['title_new'];
			$time = time();
			$status_post = $_POST['status_post']; 
			if($data == NULL){
			$id_new = '1';}
			else {$id_new = intval($data['0']['0']) + 1;}
			
			// Sending the new post into the database
			$query = $con->prepare("INSERT INTO posts VALUES(:id_new, :title_new, :corpus_new, :time,'''',:status_post)");
			$query->bindValue('id_new', $id_new, PDO::PARAM_STR);
			$query->bindValue('title_new', $title_new, PDO::PARAM_STR);
			$query->bindValue('corpus_new', $corpus_new, PDO::PARAM_STR);
			$query->bindValue('time', $time, PDO::PARAM_STR);
			$query->bindValue('status_post', $status_post, PDO::PARAM_STR);
			$query->execute();
			
			for($i =0;$i < count($_POST['category']);$i++){ 
				$id_cat = $_POST['category'][$i];
				$query2 = $con->prepare("INSERT INTO link_category_post VALUES(:id_post, :id_cat, :dt)");
				$query2->bindValue('id_post', $id_new, PDO::PARAM_STR);
				$query2->bindValue('id_cat', $id_cat, PDO::PARAM_STR);
				$query2->bindValue('dt', time(), PDO::PARAM_STR);
				$query2->execute();
			}
			
			// Condition about the succeed of the update
			if($query==TRUE & $query2==TRUE){
				
				/* Message about the saving of the post */
				echo "   <div class='validation1'>
				<div class='validation2'>
				<p>New post saved</p>
				<p class='lien'>[ <a href='../../admin/index_admin.php'>Back to the admin panel.</a> ]</p>
				</div>
				</div>";
				$con =null;
				}else{
				
				/* Message about the modification of the post unsaved because of a problem at the database */
				echo	"
				<div class='validation1'>
				<div class='validation2'>
				<p>An error happened!</p>
				<p class='lien'>[ <a href='../../admin/post/new_post_form.php'>Back to the modify article panel.</a> ]</p>
				</div>
				</div>
			";}    
		}
		else{ 
			/* Message about the post unsaved */
			echo "
			<div class='validation1'>
			<div class='validation2'>
			<p>New post unsaved.</p>
			<p class='lien'>[ <a href='../../admin/post/new_post_form.php'>Go to new post panel.</a> ]</p>
			</div>
			</div>
		";}
		}else if($_POST['action']=="Preview"){
		
		include('preview.php');
		
		} else {
		echo "Error";
	}
?>