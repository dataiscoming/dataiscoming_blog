<div class='body-center-left'>
<?php
	// Connection to the database and get all the posts
	include('../database/db_open.php');
	
	// Number of posts in the pages 
	$PostPerPage = 3; 
	
	// Query to count the number of post with the status published
	$query="select * from posts where status_post='published' "; 
	$stmt = $con->query($query);				  
	$totalPosts = $stmt->rowCount();
	$PageNumber  = ceil($totalPosts / $PostPerPage);
					
	// Condition : Number of post must be superior to 1
	if ($totalPosts >= 1){
	
		// Condition : The variables N for the page number must exist, otherwise the variable page must be 1
		if (isset($_GET['n'])){                    
			$page = $_GET['n'];
		}else{ 
			$page = 1;
		}
		
		// 
		$FirstMessage = ($page - 1) * $PostPerPage; 
						
		// Get the posts selected
		$req = $con->prepare("SELECT * FROM posts where status_post=:status ORDER BY id DESC LIMIT :FirstMessage , :PostPerPage");
		$req->bindValue('status', 'published', PDO::PARAM_STR);
		$req->bindValue('FirstMessage', $FirstMessage, PDO::PARAM_INT);
		$req->bindValue('PostPerPage', $PostPerPage, PDO::PARAM_INT);
		$req->execute();
						
		// The posts are shown
		while ($data= $req ->fetch(PDO::FETCH_ASSOC)){
		?>
						
		<!-- Title of the post -->
		<div class="body-posts">
			<?php 
			$mess_titre = stripslashes($data['title']);
			$mess_titre = preg_replace('#\[i\]#','<i>', $mess_titre);
			$mess_titre = preg_replace('#\[\/i\]#','</i>', $mess_titre);
			$mess_titre = preg_replace('#\[s\]#','<u>', $mess_titre);
			$mess_titre = preg_replace('#\[\/s\]#','</u>', $mess_titre);
			$mess_titre = preg_replace('#\[strike\]#','<strike>', $mess_titre);
			$mess_titre = preg_replace('#\[\/strike\]#','</strike>', $mess_titre);
			$mess_titre = preg_replace('#&lt;#','<', $mess_titre);
			$mess_titre = preg_replace('#&quot;#','"', $mess_titre);
			$mess_titre = preg_replace('#&gt;#','>', $mess_titre);
			echo "<div class='body-title'>
			". $mess_titre ."</div>";
			
			?>				
        	<!-- The date of creation and modification of the post. The date of modification may not be shown if there is not some-->
			<div class='date-post'>
				<p>Created the
				<?php echo date('d/m/Y ', $data['timestamp']); ?> at
				<?php echo date('H\hi', $data['timestamp']); 
				if($data['timestamp_modif'] != 0){
					?> <br> Modified the
					<?php echo date('d/m/Y ', $data['timestamp_modif']); ?> at
					<?php echo date('H\hi', $data['timestamp_modif']); }
				else{}  ?></p>
			</div>
              
			<?php
			//The corpus of the posts 
			$mess = nl2br($data['corpus']);       
			echo "<div class='body-post-corpus'>"."<p align='justify'>".substr($mess,19,strpos($mess, '.',1000)-18)."</p>"/*htmlspecialchars_decode($mess)*/."
			<a href='../users/index_users.php?&page=post&id_post=".$data['id']."'>Read more...</a></div>";
			?>
		</div>
        
		<?php
		}
					
		// The page number
		echo "<div class='body-posts'><center>";
		for ($i = 1 ; $i <= $PageNumber ; $i++){
			echo '<span class="lien"><a href="../users/index_users.php?page=posts&n='.$i.'">'.$i.'</a></span> ';
		}
		echo "</center></div>";
	}else{// Error message : the variable that count the number of post is empty 
		echo '<div class="no-article">There is no posts in this page.</div>';
	}
	?>
</div>