<div class='body-center-left'>
	<?php
	// Connexion to the database and get all the posts
	include('../database/db_open.php');
	
	// Number of posts that will be shown in the page
	$PostPerPage = 3; 
	
	// Query to select the posts published from the selected category
	$query = $con->prepare("
		SELECT t1.*
		FROM 
		posts as t1,
		link_category_post as t2,
		categories as t3
		where 
		t1.status_post=:status and 
		t3.category =:cat and
		t3.id_cat = t2.id_postcat and 
		t2.id_post = t1.id
		ORDER BY id DESC");
		$query ->bindValue('status', 'published', PDO::PARAM_STR);
		$query ->bindValue('cat', $_GET["id"], PDO::PARAM_STR);
		$query ->execute();
	$totalPosts = $query ->rowCount();
	$PageNumber  = ceil($totalPosts / $PostPerPage);
					
	// Number of page to show the posts 
	if ($totalPosts >= 1) {
		if (isset($_GET['n'])){                    
			$page = $_GET['n'];
		}
		else{ 
			$page = 1;
		}
		$FirstMessage = ($page - 1) * $PostPerPage; 
		
		// Get the posts selected for a page
		$req = $con->prepare("
		SELECT t1.*
		FROM 
		posts as t1,
		link_category_post as t2,
		categories as t3
		where 
		t1.status_post=:status and 
		t3.category =:cat and
		t3.id_cat = t2.id_postcat and 
		t2.id_post = t1.id
		ORDER BY id DESC LIMIT :FirstMessage , :PostPerPage");
		$req->bindValue('status', 'published', PDO::PARAM_STR);
		$req->bindValue('cat', $_GET["id"], PDO::PARAM_STR);
		$req->bindValue('FirstMessage', $FirstMessage, PDO::PARAM_INT);
		$req->bindValue('PostPerPage', $PostPerPage, PDO::PARAM_INT);
		$req->execute();	
					
		// Loop to show the post
		while ($data= $req ->fetch(PDO::FETCH_ASSOC)){
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
							
            <!-- Date of creation and modification -->
			<div class='date-post'>
				<p>Created the
				<?php echo date('d/m/Y ', $data['timestamp']); ?> at
				<?php echo date('H\hi', $data['timestamp']); 
				if($data['timestamp_modif'] != 0){
					?> <br> Modified the
					<?php echo date('d/m/Y ', $data['timestamp_modif']); ?> at
					<?php echo date('H\hi', $data['timestamp_modif']); }
				else{
				}  ?></p>
			</div>
              
			<?php
								
			// The corpus of the posts with a link to read more
			$mess = nl2br($data['corpus']);      
			echo "<div class='body-post-corpus'>". "<p align='justify'>".substr($mess,19,strpos($mess, '.',1000)-18)."</p>"/*htmlspecialchars_decode($mess)*/."
            <a href='../users/index_users.php?&page=post&id_post=".$data['id']."'>Read more...</a></div>";
			?>
		</div>
        
		<?php
		}
					
		// The page number
		echo "<div class='body-posts'><center>";
		for ($i = 1 ; $i <= $PageNumber ; $i++){
			echo '<span class="lien"><a href="../user/index_article.php?page=category&id='.$_GET["id"].'&n=' . $i . '">' . $i . '</a></span> ';
		}
		echo "</center></div>";
	}
	// Error Message : variable total post is inferior to 1
	else{
		echo '<div class="no-article">There is no posts in this blog for this category.</div>';
	}
	?>
</div>     