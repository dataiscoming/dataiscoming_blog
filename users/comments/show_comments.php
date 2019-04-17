<html>
	<body>
	<?php
		// Conditions : receive the ID of the post
		if(isset($_GET['id']) AND 
		$_GET['id'] != NULL){
   
			// Connexion to the database
			include('../../database/db_open.php');
			
			// Query to select to comments from the selected post ordered by the ID
			$req = $con->prepare("SELECT * FROM comments where id_post=:id_post order by id_comment DESC"); 
			$req->bindValue('id_post', $_GET['id'], PDO::PARAM_STR);
			$req->execute();
			
			// Loop to publish every pseudo and comment
			while($data= $req -> fetch(PDO::FETCH_ASSOC)){
				echo '<h4>'.$data['pseudo'].'</h4>';
				echo '<p>'.$data['comment'].'</p><br/>';
			}
		
		// Error message : the ID received is not well
		}else{
			echo "<br/><br/><center>No article selected.</center>";
		}?>
    </body>
</html>
