<?php 
	
	if($_POST['action']=="Send"){
		
	/* Header parts for the admin */
	include('../../layout/admin/header_admin.php'); 
	
	/* Condition rejecting the empty post, title and id */
	if (isset($_POST['title_modif']) AND 
    isset($_POST['corpus_modif']) AND 
    isset($_POST['id_modif']) AND  isset($_POST['status_post']) AND
	isset($_POST['abstract_modif']) AND
    $_POST['title_modif'] != NULL AND
    $_POST['corpus_modif'] != NULL AND 
    $_POST['id_modif'] != NULL AND $_POST['status_post'] != NULL AND
	$_POST['abstract_modif'] != NULL){
		
		/* Connextion to the database */
		include('../../database/db_open.php');
		
		/* Variables new post, id, title */
		$title_modif = $_POST['title_modif'];
		$corpus_modif = $_POST['corpus_modif'];
		$id_modif = $_POST['id_modif'];
		$abstract_modif = $_POST['abstract_modif'];
		$time = time();
		$status_post = $_POST['status_post'];
		
		/* Query to update the post, title and date of modification */
		$req = $con->prepare("UPDATE posts SET title=:title_modif, corpus=:corpus_modif, timestamp_modif=:time, status_post=:status, abstract=:abstract_modif
		WHERE ID=:id_modif");
		$req->bindValue('title_modif', $title_modif, PDO::PARAM_STR);
		$req->bindValue('corpus_modif', $corpus_modif, PDO::PARAM_STR);
		$req->bindValue('time', $time, PDO::PARAM_STR);
		$req->bindValue('id_modif', $id_modif, PDO::PARAM_STR);
		$req->bindValue('status', $status_post, PDO::PARAM_STR);
		$req->bindValue('abstract_modif', $abstract_modif, PDO::PARAM_STR);
		$req->execute();
		
		$req2 = $con->prepare("DELETE FROM link_category_post WHERE id_post=:id_modif");
		$req2->bindValue('id_modif', $id_modif, PDO::PARAM_STR);
		$req2->execute();
		
		// Update the categories of the new post into the table LINK_CATEGORY_POST into the database
		for($i =0;$i < count($_POST['category']);$i++){ 
			$id_cat = $_POST['category'][$i];
			$req3 = $con->prepare("INSERT INTO link_category_post VALUES(:id_post, :id_cat, :dt)");
			$req3->bindValue('id_post', $id_modif, PDO::PARAM_STR);
			$req3->bindValue('id_cat', $id_cat, PDO::PARAM_STR);
			$req3->bindValue('dt', time(), PDO::PARAM_STR);
			$req3->execute();
		}
		
		/* Condition about the succeed of the update*/	
        if($req == TRUE & $req2==TRUE & $req3==TRUE){
			
			/* Message about the modification post saved */
			echo	"
			<div class='validation1'>
			<div class='validation2'>
			<p>Your update is saved.</p>
			<p class='lien'>[ <a href='../../admin/index_admin.php'>Back to the admin panel.</a> ]</p>
			</div>
			</div>
			" ;
			}else{
			
			/* Message about the modification of the post unsaved because of a problem at the database*/
			echo	"
			<div class='validation1'>
			<div class='validation2'>
			<p>An error happened!</p>
			<p class='lien'>[ <a href='../../admin/modify_article_form.php'>Back to the modify article panel.</a> ]</p>
			</div>
			</div>
		";}    
		}else{
		
		/* Message when the modification of the post is unsaved because of the post, title or id are empty*/	
		echo"
		<div class='validation1'>
		<div class='validation2'>
		<p>An error happened!</p>
		<p class='lien'>[ <a href='modify_article_form.php'>Back to the modify article panel.</a> ]</p>
		</div>
		</div>
	";}     
	
	} else if($_POST['action']=="Preview"){
	
	header("Location: http://localhost/users/index_users.php?page=preview&title_modif=".$_POST['title_modif']."&corpus_modif=".urlencode($_POST['corpus_modif']));
	
	}else {
	echo "Error";
	}
?>				