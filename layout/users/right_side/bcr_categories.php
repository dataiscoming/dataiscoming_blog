<div class='categories'>
 
	<p>Category<p>
    <?php
	
	// Connexion to the database
	include('../database/db_open.php');
	
	// Select all the categories
	$query = $con->prepare("select * from categories");
	$query->execute();
	
	// Condition : the query above worked
	if($query==TRUE){
	
		// Loop to show every category name links
		while ($data= $query ->fetch(PDO::FETCH_ASSOC)){
			echo"<a href='../users/index_users.php?page=category&id=".$data['category']."'>".$data['category']."</a><br/>";
		}
	}else{
	echo '<p>No categories</p>';
	}

	?>
 </div><br/>