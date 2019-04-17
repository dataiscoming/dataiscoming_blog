<html>
	<?php
		/*Create a connection to the database*/
		include('database/db_open.php');
		
		/*connecting to the database and get the state of the website*/
		$ident = 1;
		$eta = $con->prepare("SELECT eta FROM eta_web_sit WHERE id = :ident");
		$eta->bindValue('ident', $ident, PDO::PARAM_INT);
		$eta->execute();
		$status= $eta ->fetch(PDO::FETCH_ASSOC);
		echo $status['eta'];
		
		/* if status is equal to ".maint.", then the maintenance page is shown. Otherwise, the posts are shown*/
		if($status['eta']== ".MAINT."){
		header("Location: maintenance.php");}
		else {
		header("Location: ../users/index_users.php?page=posts");
		}
		
	?>
</html>