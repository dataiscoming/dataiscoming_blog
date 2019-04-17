 <div class='body-center-left'>
	<?php
	// Setting the variable search with words of the search
	$search = $_POST['search']; 

	/* Connection to the database */
	include('../database/db_open.php');
    
	// Query to select the searched posts that are published 
    $query = $con->prepare("SELECT * FROM posts where
    (title like :search or 
	corpus like :search) and 
    status_post = 'published' ");
	$query->bindValue('search', '%'.$search.'%', PDO::PARAM_STR);
	$query->execute();
    
	// Count of the number of posts
	$totalPosts = 1;
    $totalPosts = $query->rowCount();
	
	// Setting the number of posts shown per page and the number of page
    $PostPerPage = 5;
    $PageNumber = ceil($totalPosts / $PostPerPage);
    
	// Condition : The variables N for the page number must exist, otherwise the variable page must be 1
    if ($totalPosts >= 1) {
		if (isset($_GET['n'])){                    
			$page = $_GET['n'];
		}
		else{ 
			$page = 1;
		}			
						
		// Loop to show the posts
		while ($data= $query ->fetch(PDO::FETCH_ASSOC)){
		?>
						
			<div class="body-posts">
			<?php 
			// Title
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
			<p>". $mess_titre ."</p>
			</div>";
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
				echo 
                "<div class='body-post-corpus'>
				<a href='../users/index_users.php?&page=post&id_post=".$data['id']."'>Read more...</a></div>";
				?>
			</div>
			<?php
		}
					
		// The page number
		echo "<div class='body-posts'><center>";
		for ($i = 1 ; $i <= $PageNumber ; $i++){
			echo '<span class="lien"><a href="../users/index_users.php?page=posts&n=' . $i . '">' . $i . '</a></span> ';
		}
		echo "</center></div>";
	}
	
	// Error message : there was no posts found 
	else{
		echo '<div class="no-article">There is no posts corresponding to your search : " '.$search.' "</div>';
	}
	?>
</div>