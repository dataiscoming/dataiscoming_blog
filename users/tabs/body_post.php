 <div class='body-center-left'>

	<?php
	// Connexion to the database
	include('../database/db_open.php');

	// Setting the variable to identify the post chosen
    $id_post = $_GET['id_post'];
          
	// Query to select the post identified thanks to the variable id_post
	$req = $con->prepare("SELECT * FROM posts WHERE ID=:id_post");
	$req->bindValue('id_post', $id_post, PDO::PARAM_STR);
	$req->execute();
	$data= $req ->fetch(PDO::FETCH_ASSOC);
    
	?>
    <!-- Title -->
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
							
		<!-- The date of creation and modification -->
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
								
		// The corpus of the posts 
		$mess = nl2br($data['corpus']);
		echo "<div class='body-post-corpus'>".htmlspecialchars_decode($mess)."
        <a href='../users/index_users.php?page=posts'>Back</a>
        </div>";
		?>
                      
        <div class="comments">
		
		<!-- Link to write a comment -->
        <a href="../users/comments/write_comments.php?id=<?php echo $data['id']; ?>" onclick="window.open(this.href, 'contact','width=641,height=240,left=100,top=100'); return false;">Add a comment</a><br/>
        <?php
		// Query to count the number of comments for this post
        $req = $con->prepare("SELECT * FROM comments WHERE id_post=:id_post");
        $req->bindValue('id_post', $id_post, PDO::PARAM_STR);
        $req->execute();
        $n = $req->rowCount();
		
		// Contidion depending if there is no post, one post or there are more to show the number of posts
        if($n !== false){
			if($n > 1){
				$s = "s";}
			else{
				$s = "";}
			if($n == 0){
				echo "[No comment]" ;
			}
			else{ ?>
			
			<!-- Link to show the posts written -->
			<a href="../users/comments/show_comments.php?id=<?php echo $data['id']; ?>" onclick="window.open(this.href, 'contact','width=400,height=600,left=150,top=25,scrollbars=1'); return false;"><strong><?php echo $n; ?></strong> comment<?php echo $s; ?></a>
			<?php }
			
		// Error message : N == false	
		}else{
			echo "There is a mistake!" ;
		}
		 ?>
		</div>          
	</div>         
</div>