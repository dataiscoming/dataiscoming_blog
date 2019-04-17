<?php
	
	/* Condition rejecting the empty id */
	if(isset($_GET['id'])){
		
		/* Connextion to the database */
		include('../../database/db_open.php');
		
		/* Query to delete the post */
		$sql = 'DELETE FROM posts WHERE id='.$_GET['id'];
		$stmt = $con->query($sql);
		
		/* Condition about the succeed of the delete*/	
		if($stmt == true){
			
			/* Message about the deleted post saved */
			echo	"
			<link href='../../css/style_admin.css' media='all' rel='stylesheet' type='text/css'/>
			<div class='validation1'>
			<div class='validation2'>
			<p>Your delete is saved.</p>
			<p class='lien'>[ <a href=' ../../admin/index_admin.php'>Back to the admin panel.</a> ]</p>
			</div>
			</div>
			" ;
		}
		else{
		?>
		
		<html>
			<body>
				<?php
					/* Header and Menu parts for the admin */
					include('../../layout/admin/header_admin.php'); 
					include('../../layout/admin/menu_admin.php'); 
				?>
				<br /><br /><center>
					
					<!-- Delete unsaved -->
					<p>Error with the deleting !</p>
				</center>
			</body>
		</html>
		<?php
		}
	}
	else{
		echo "Thank to choose an article to supress";
	}
?>