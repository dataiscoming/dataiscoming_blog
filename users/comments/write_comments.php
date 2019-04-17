<html>
  <div>
    <center>
	
	<?php
	// Conditions : receive the ID of the post
	if (isset($_GET['id']) 
	AND $_GET['id'] != NULL){
		
		// Connexion to the database 
        include('../../database/db_open.php');
        
		// Get the most recent ID of the comments
		$req = $con->prepare("select max(id_comment) as id from comments");
		$req->execute();
		$data1= $req ->fetchAll();
    
		// Setting the ID, and the timestamp of the new comment
		if($data1 == NULL){
			$id_comment_new = '1';}
		else {$id_comment_new = intval($data1['0']['0']) + 1;}
			$time = time();
	
		// Insert the new comment into the database
        $req = $con->prepare("INSERT INTO comments VALUES(:id_comment, :id_post, :pseudo, :comment,:time)");
  			$req->bindValue('id_comment', $id_comment_new, PDO::PARAM_STR);
  			$req->bindValue('id_post', $_GET['id'], PDO::PARAM_STR);
			  $req->bindValue('pseudo', $_POST['pseudo'], PDO::PARAM_STR);
			  $req->bindValue('comment',$_POST['comment'], PDO::PARAM_STR);
			  $req->bindValue('time', $time, PDO::PARAM_STR);
			  $req->execute();
  
		// Message send if the insert was done
        if($req == true){
			echo '<br /><br />Your comment has been published. <br /><br />[ <a href="#" onclick="window.close(); return false;">Close the window</a>]';
			$con =null;
		
		// Error message : no reception of the ID of the post		
		}else{echo "An error happened !";}
		
	}else{
		//Conditions : receive the ID of the post
		if(isset($_GET['id']) 
		AND $_GET['id'] != NULL){
			?><div id="bodycom">
				<div id="commentaire">
				
					<!-- Form to write a pseudo, a comment -->
					<form action="" method="post">
						<center>
						Pseudo :
						<input type="text" name="pseudo" size="30" /><br />
						Comment :<br />
						<textarea name="comment" cols="50" rows="6" id="com"></textarea><br />
						<input type="submit" value="Send" /> <!-- Submit button to send the comment to the database -->       
						</center>
					</form>
				</div>
			</div><?php
		}else{
		echo "No article selected.";
		}
	}
	?>
    </center>
  </div>
</html>