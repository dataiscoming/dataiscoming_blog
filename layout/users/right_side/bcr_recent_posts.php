<div class='recent-post'>
	<p>Recent post<p>
	<?php
	// Connxion to the database
	include('../database/db_open.php');
  
	// Query to select the 10th most recent post published
	$query = $con->prepare("SELECT * FROM posts WHERE status_post='published' ORDER BY id DESC LIMIT 10");
	$query->execute();

	// Loop to show the title of the posts 
	while ($data= $query ->fetch(PDO::FETCH_ASSOC)){
		$title = stripslashes($data['title']);
 
	?>  
		<form id='post' action='../users/index_users.php?page=recent_posts' method='post'> 
			<input type='hidden' name='id_post' value=<?php echo $data['id'];?> /> 
		</form>
		<a href='#' onclick='document.getElementById("post").submit()'><?php echo $title; ?></a>
	<?php  
	}
	?>
</div>