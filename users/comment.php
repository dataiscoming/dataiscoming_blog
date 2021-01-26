<?php 

// Code to send a new comment to the DB

	if($_POST['action']=="Send"){
		
		// Connection to the database
		include('../database/db_open.php');
			
		// Query to get the number of comments	
		$query = $con->prepare("SELECT count(*) as total FROM comments");
		$query->execute();
		$nbr_comment = $query->fetchColumn();
		
		// Query to get the number of comments	
		$query_max = $con->prepare("SELECT max(order_reply) as max_id FROM comments WHERE id_post = :id_post");
		$query_max->bindValue('id_post', $_POST['id_post'], PDO::PARAM_INT);
		$query_max->execute();
		$max_comment = $query_max->fetchColumn();
		
		// Preparing the variables to send to the database for new comment
		$id_comment = $nbr_comment+1;
		$id_post = $_POST['id_post'];
		$name_comment = $_POST['cName'];
		$email_comment = $_POST['cEmail'];
		$website_comment = $_POST['cWebsite'];
		$text_comment = htmlspecialchars($_POST['cMessage']);
		$date_comment = date('Y-m-d');
		$time_comment = date('H:i:s');
		
		// Important variables
		if(isset($_POST['level']) & isset($_POST['max']) & isset($_POST['order']) & isset($_POST['id_previous_comment'])){
			$level_reply_comment = $_POST['level']+1;
			$order_reply = $_POST['order']+1;
			if($_POST['max'] == $_POST['level']){
				$max_reply = $_POST['max']+1;
				
				$id_previous_comment = $_POST['id_previous_comment'];
				
				$query1 = $con->prepare("UPDATE comments SET max_reply = 1 WHERE id_comment = :id_previous_comment"); 
				$query1->bindValue('id_previous_comment', $id_previous_comment, PDO::PARAM_INT);
				$query1 -> execute();
				
			}else{
				$max_reply = $_POST['max'];
			}
		}else{
			$level_reply_comment = 1;
			$order_reply = $max_comment+1;
			$max_reply = 1;
		}

		// test 
		echo("<script>console.log('id_post: " . $id_post . "');</script>");
		echo("<script>console.log('id_comment: " . $id_comment . "');</script>");
		echo("<script>console.log('name_comment: " . $name_comment . "');</script>");
		echo("<script>console.log('email_comment: " . $email_comment . "');</script>");
		echo("<script>console.log('website_comment: " . $website_comment . "');</script>");
		echo("<script>console.log('website_comment: " . $text_comment . "');</script>");
		echo("<script>console.log('level_reply: " . $level_reply_comment . "');</script>");
		echo("<script>console.log('order: " . $order_reply . "');</script>");
		echo("<script>console.log('max_reply: " . $max_reply . "');</script>");
			
		// Sending the new comments into the table COMMENTS into the database
		$query = $con->prepare("INSERT INTO comments(id_comment, id_post, user_name, date_comment, time_comment, user_email, user_website, text_comment, level_reply, order_reply, max_reply) VALUES(:id_comment, :id_post, :name_comment, :date_comment, :time_comment, :email_comment, :website_comment, :text_comment, :level_reply_comment, :order_reply, :max_reply)"); 
		$query->bindValue('id_comment', $id_comment, PDO::PARAM_INT);
		$query->bindValue('id_post', $id_post, PDO::PARAM_INT);
		$query->bindValue('name_comment', $name_comment, PDO::PARAM_STR);
		$query->bindValue('date_comment', $date_comment, PDO::PARAM_STR);
		$query->bindValue('time_comment', $time_comment, PDO::PARAM_STR);
		$query->bindValue('email_comment', $email_comment, PDO::PARAM_STR);
		$query->bindValue('website_comment', $website_comment, PDO::PARAM_STR);
		$query->bindValue('text_comment', $text_comment, PDO::PARAM_STR);
		$query->bindValue('level_reply_comment', $level_reply_comment, PDO::PARAM_INT);
		$query->bindValue('order_reply', $order_reply, PDO::PARAM_INT);
		$query->bindValue('max_reply', $max_reply, PDO::PARAM_INT);
		$query->execute();
		
		// Update the order variable in the comments table
		$query2 = $con->prepare("UPDATE comments SET order_reply = order_reply +1 WHERE id_comment <> :id_comment AND order_reply >= :order_reply"); 
		$query2->bindValue('id_comment', $id_comment, PDO::PARAM_INT);
		$query2->bindValue('order_reply', $order_reply, PDO::PARAM_INT);
		$query2->execute();
		
		// If the queries are successful, the page go back to the post
		if($query == TRUE & $query2 == TRUE){
			echo("<script>console.log('OK');</script>");
			header("Location: ../users/single.php?id_post=".$id_post);
		}else{
			echo("<script>console.log('PB');</script>");
		}
		
		// Close the connexion to the DB
		include('../database/db_close.php');
	}

?>